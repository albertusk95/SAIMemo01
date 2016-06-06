<?php
	
class user_auth extends CI_Controller {
	
		public $status; 
        public $roles;
		
		public function __construct() {
			/**
			* Konstruktor
			*/
				parent::__construct();
				$this->load->model('Memo_model');
				$this->load->model('Userauth_model');
				$this->load->model('Log_model');
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				$this->status = $this->config->item('status'); 
				$this->roles = $this->config->item('roles');
		}
		
		// signup tanpa parameter 
		public function signup() {
			/**
			* Mengecek validitas input dari registrasi user 
			*/
	
				// Jika user sudah sign up, redirect ke halaman utama SAIMemo 
				if($this->session->userdata('id') !== NULL) {
						
					redirect(site_url('memo'));
					
				}
			
				$this->form_validation->set_rules('form-first-name', 'First name', 'required');
				$this->form_validation->set_rules('form-last-name', 'Last name', 'required');
				$this->form_validation->set_rules('form-email', 'Email', 'required|valid_email');
				
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('simplecloud/signup');
				}
				else
				{
					if($this->Userauth_model->isDuplicate($this->input->post('form-email'))){
						
						$this->session->set_flashdata('flash_message', 'User email already exists');
						redirect(site_url('user_auth/signup'));
					
					} else{
						
						// menghapus isi dari form input jika registrasi berhasil
						$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
						
						// menambahkan informasi user ke dalam database
						$id = $this->Userauth_model->insertUser($clean);

						// membuat token baru untuk user yang baru terdaftar
						$token = $this->Userauth_model->insertToken($id);                                        
						
						$qstring = base64_encode($token);                    
						$url = site_url('user_auth/signup_complete/token/' . $qstring);
						$link = '<a href="' . $url . '">' . $url . '</a>'; 
								   
						$message = '';                     
						$message .= '<strong>You have signed up with our website</strong><br>';
						$message .= '<strong>Please click:</strong> ' . $link;                          
	 
						echo $message; //send this in email
						exit;
					}
				}
		}
		
		public function signup_complete() {                   
			/*
			* Menyelesaikan proses registrasi user dengan memasukkan password baru
			*/
			
			// Jika user sudah sign up, redirect ke halaman utama SAIMemo 
			if($this->session->userdata('id') !== NULL) {			
				redirect(site_url('memo'));
			}
			
            $token = base64_decode($this->uri->segment(4));       
            $cleanToken = $this->security->xss_clean($token);
            
            $user_info = $this->Userauth_model->isTokenValid($cleanToken); //either false or array();           
            
            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url('user_auth/signup'));
            }            
            $data = array(
                'firstName'=> $user_info->user_firstname, 
				'lastName'=> $user_info->user_lastname,
                'email'=> $user_info->user_email, 
                'user_id'=> $user_info->id, 
                'token'=> base64_encode($token)
            );
           
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');              
            
            if ($this->form_validation->run() == FALSE) {
				
                $this->load->view('simplecloud/signup_complete', $data);

			} else{
                
                $this->load->library('password');                 
                $post = $this->input->post(NULL, TRUE);
                
                $cleanPost = $this->security->xss_clean($post);
                
				//enkripsi password 
                $hashed = $this->password->create_hash($cleanPost['password']);                
                $cleanPost['password'] = $hashed;
				
                unset($cleanPost['passconf']);
                $userInfo = $this->Userauth_model->updateUserInfo($cleanPost, $data['user_id']);
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your record');
                    redirect(site_url('user_auth/signup'));
                }
                
                unset($userInfo->user_password);
                
                foreach($userInfo as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
				
				// membuat folder untuk user yang baru terdaftar sebagai tempat menyimpan data 
				$this->Memo_model->create_folder('', '', $this->Userauth_model->check_user($data['email']));
				
				// sign up berhasil, masuk ke SAIMemo 
                redirect(site_url('memo'));
				
            }
        }
			
		public function login() {
			/*
			* Mengecek validitas input untuk login 
			*/
			
			// Jika user sudah login, redirect ke halaman utama SAIMemo 
			if($this->session->userdata('id') !== NULL) {
				redirect(site_url('memo'));
			}
			
            $this->form_validation->set_rules('form-email-login', 'Email', 'required|valid_email');    
            $this->form_validation->set_rules('form-password', 'Password', 'required'); 
            
            if($this->form_validation->run() == FALSE) {
                $this->load->view('simplecloud/signup');
            }else{
                
                $post = $this->input->post();  
                $clean = $this->security->xss_clean($post);
                
                $userInfo = $this->Userauth_model->checkLogin($clean);
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'The login was unsucessful');
                    redirect(site_url('user_auth/signup'));
                }                
                foreach($userInfo as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
				
				// login berhasil, masuk ke dalam SAIMemo
                redirect(site_url('memo?access_state=1'));
            }
            
        }
		
		public function forgot_pass() {
            /*
			* Prosedur reset password 
			*/
			
			// Jika user sudah login, redirect ke halaman utama SAIMemo 
			if($this->session->userdata('id') !== NULL) {
				redirect(site_url('memo'));
			}
			
            $this->form_validation->set_rules('fp-email', 'Email', 'required|valid_email'); 
            
            if($this->form_validation->run() == FALSE) {
                $this->load->view('simplecloud/forgotpass');
            } else{
                $email = $this->input->post('fp-email');  
                $clean = $this->security->xss_clean($email);
                $userInfo = $this->Userauth_model->getUserInfoByEmail($clean);
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'We cant find your email address');
                    redirect(site_url('user_auth/signup'));
                }   
                
                if($userInfo->user_status != $this->status[1]){ //if status is not approved
                    $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                    redirect(site_url('user_auth/signup'));
                }
                
                //build token 
				
                $token = $this->Userauth_model->insertToken($userInfo->id);                    
                $qstring = base64_encode($token);                   
                $url = site_url('user_auth/reset_password/token/' . $qstring);
                
				$link = '<a href="' . $url . '">' . $url . '</a>'; 
                
                $message = '';                     
                $message .= '<strong>A password reset has been requested for this email account</strong><br>';
                $message .= '<strong>Please click:</strong> ' . $link;             
                echo $message; //send this through mail
                exit;
                
            }
            
        }
		
		public function reset_password() {
			/*
			* Mengecek validitas input untuk reset password 
			*/
			
			// Jika user sudah login, redirect ke halaman utama SAIMemo 
			if($this->session->userdata('id') !== NULL) {
				redirect(site_url('memo'));
			}
			
            $token = base64_decode($this->uri->segment(4));       
            $cleanToken = $this->security->xss_clean($token);
            
            $user_info = $this->Userauth_model->isTokenValid($cleanToken);               
            
            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url('user_auth/signup'));
            }            
            $data = array(
                'firstName'=> $user_info->user_firstname,
				'lastName'=> $user_info->user_lastname,
                'email'=>$user_info->user_email, 
                'user_id'=>$user_info->id, 
                'token'=>base64_encode($token)
            );
            
            $this->form_validation->set_rules('reset-password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('reset-passconf', 'Password Confirmation', 'required|matches[reset-password]');              
            
            if ($this->form_validation->run() == FALSE) {  
                $this->load->view('simplecloud/reset_password', $data);
			} else {
                                
                $this->load->library('password');                 
                $post = $this->input->post(NULL, TRUE);                
                $cleanPost = $this->security->xss_clean($post);                
                $hashed = $this->password->create_hash($cleanPost['password']);                
                $cleanPost['reset-password'] = $hashed;
                unset($cleanPost['reset-passconf']);                
                if (!$this->Userauth_model->updatePassword($cleanPost, $data)) {
					$succ_reset = -1;
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
				}else{
					$succ_reset = 1;
					$this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
				}
			
				// default value = 0 -> tidak menampilkan pesan alert
				redirect(site_url('user_auth/signup?reset_success=' . $succ_reset));                
            }
        }
		
		public function profile()
		{
			
			// Jika user belum login, redirect ke halaman signup  
			if($this->session->userdata('id') == NULL) {
				redirect(site_url('user_auth/signup'));
			}
			
			$user_id = $this->session->userdata('id');
			$username = $this->session->userdata('user_email');
			if($this->input->get('edit')) {
				
				if($this->input->post('modify')=='username'){
					$this->form_validation->set_rules('username', 'Username','required|is_unique[users.user_email]');
					if($this->form_validation->run()){
						$modify_username = $this->input->post('username');
						if($this->Userauth_model->update_user($user_id, 'user_email', $modify_username)){
							$this->session->set_userdata('user_email', $modify_username);
							$this->Log_model->add_log($user_id, 'auth', 'edit username', $user_id.'('.$username.'=>'.$modify_username.')');
							redirect(site_url('user_auth/profile' . '?modify_success=1&old_name='.$username.'&new_name='.$modify_username));
						} 
					}
					//else???
					redirect(site_url('admin/users/' . $user_id));
				}
				else if($this->input->post('modify')=='password'){
					
					$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
					if($this->form_validation->run()){
						
						$old_password = $this->input->post('old-password');
						$modify_password = $this->input->post('password');

						// enkripsi password lama dan baru dengan prosedur 
						// create_hash milik library Password 
						$this->load->library('password');                                 
						
						$hashed_mod = $this->password->create_hash($modify_password);                
						$modify_password = $hashed_mod;
							
						if($this->Userauth_model->change_password($user_id, $old_password, $modify_password)){
							$this->Log_model->add_log($user_id, 'auth', 'edit password', $user_id.'('.$username.')');
							redirect(site_url('user_auth/profile' . '?password_success=1&username='.$username));
						} 
						
					}
				}
			}
			$header_data = array('title' => 'SAIMemo | Edit Profile');
			$this->load->view('simplecloud/template/header', $header_data);

			$data =  array('id' => $user_id, 'username' => $username);
			$this->load->view('simplecloud/Auth/profile', $data);

			$this->load->view('simplecloud/template/footer');
		}

		public function logout()
		{
			// Jika user belum login, redirect ke halaman signup
			if($this->session->userdata('id') == NULL) {
				redirect(site_url('user_auth/signup'));
			}
			
			$user_id = $this->session->userdata('id');
			$username = $this->session->userdata('user_email');
			$this->Log_model->add_log($user_id, 'auth', 'logout', $user_id.'('.$username.')');
			$this->session->sess_destroy();

			redirect(site_url('user_auth/signup'));
		}
		
}

?>