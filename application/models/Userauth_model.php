<?php

class Userauth_model extends CI_Model {

		public $status; 
		public $roles;    
		
		public function __construct(){
			
			parent::__construct();        
			$this->status = $this->config->item('status');
			$this->roles = $this->config->item('roles');
		
		}
	
		public function check_user($username)
		{
			// Ambil data dari database
			$q = $this
					->db
					->where('user_email', $username)
					->limit(1)
					->get('users');

			// Jika ditemukan
			if($q->num_rows() > 0){
				return $q->row()->id;
			}

			// Jika tidak ditemukan
			return false;
		}
	
		public function get_username($id)
		{
			$q = $this
					->db
					->where('id', $id)
					->limit(1)
					->get('users');

			// Jika ditemukan
			if($q->num_rows() > 0){
				return $q->row()->user_email;
			}

			// Jika tidak ditemukan
			return false;
		}

		public function count_user()
		{
			return $this->db->count_all('users');
		}

		public function list_user($start = 0, $limit = 10, $sort = 'id', $asc = 'asc')
		{
			$this
					->db
					->limit($limit, $start)
					->select('id, user_email, user_firstname, user_lastname, user_role, user_lastlogin, user_status')
					->order_by('LOWER(' . $sort . ')', $asc);
			$q = $this->db->get('users');

			return $q->result();
		}
	
		public function insertUser($d)
		{  
            $string = array(
                'user_firstname'=>$d['form-first-name'],
                'user_lastname'=>$d['form-last-name'],
                'user_email'=>$d['form-email'],
                'user_role'=>$this->roles[0], 
                'user_status'=>$this->status[0]
            );
            $q = $this->db->insert_string('users',$string);             
            $this->db->query($q);
            return $this->db->insert_id();
		}
	
		public function isDuplicate($email)
		{     
			$this->db->get_where('users', array('user_email' => $email), 1);
			return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
		}
    
		public function insertToken($user_id)
		{   
			$token = substr(sha1(rand()), 0, 30); 
			$date = date('Y-m-d');
			
			$string = array(
					'token'=> $token,
					'user_id'=> $user_id,
					'created'=> $date
				);
			$query = $this->db->insert_string('tokens',$string);
			$this->db->query($query);
			return $token;
		}
		
		public function isTokenValid($token)
		{
			$q = $this->db->get_where('tokens', array('token' => $token), 1);        
			if ($this->db->affected_rows() > 0) {
				$row = $q->row();             
				
				$created = $row->created;
				$createdTS = strtotime($created);
				$today = date('Y-m-d'); 
				$todayTS = strtotime($today);
				
				if($createdTS != $todayTS) {
					return false;
				}
				
				$user_info = $this->getUserInfo($row->user_id);
				return $user_info;
				
			} else { 
				return false;
			}	
		}

		public function getUserInfo($id)
		{
			$q = $this->db->get_where('users', array('id' => $id), 1);  
			if($this->db->affected_rows() > 0){
				$row = $q->row();
				return $row;
			}else{
				error_log('no user found getUserInfo('.$id.')');
				return false;
			}
		}
		
		public function updateUserInfo($post, $user_ID)
		{
			$data = array(
				   'user_password' => $post['password'],
				   'user_lastlogin' => date('Y-m-d h:i:s A'), 
				   'user_status' => $this->status[1]
				);
			$this->db->where('id', $user_ID);
			$this->db->update('users', $data); 
			$success = $this->db->affected_rows(); 
			
			if(!$success){
				error_log('Unable to updateUserInfo('.$post['user_id'].')');
				return false;
			}
			
			$user_info = $this->getUserInfo($post['user_id']); 
			return $user_info; 
		}
		
		public function checkLogin($post)
		{
			$this->load->library('password');       
			$this->db->select('*');
			$this->db->where('user_email', $post['form-email-login']);
			$query = $this->db->get('users');
			$userInfo = $query->row();
			
			//cek kesamaan password 
			if(!$this->password->validate_password($post['form-password'], $userInfo->user_password)){
				error_log('Unsuccessful login attempt('.$post['form-email-login'].')');
				return false; 
			}
			
			$this->updateLoginTime($userInfo->id);
			
			unset($userInfo->user_password);
			return $userInfo; 
		}
		
		public function updateLoginTime($id)
		{
			$this->db->where('id', $id);
			$this->db->update('users', array('user_lastlogin' => date('Y-m-d h:i:s A')));
			return;
		}
		
		public function updatePassword($passdata, $userdata) 
		{
			/** 
			* Mengubah password yang dikontrol dari session di luar login memo.
			* Contoh: reset password 
			*/
			$data = array(
				   'user_password' => $passdata['reset-password']
				);
			$this->db->where('id', $userdata['user_id']);
			$this->db->update('users', $data); 
			$success = $this->db->affected_rows(); 
			
			if(!$success){
				return false;
			}
			
			return true;
		}
		
		public function getUserInfoByEmail($email)
		{
			$q = $this->db->get_where('users', array('user_email' => $email), 1);  
			if($this->db->affected_rows() > 0){
				$row = $q->row();
				return $row;
			} else{
				error_log('no user found getUserInfo('.$email.')');
				return false;
			}
		}
		
		public function tambah_trackrecord($today_date, $today_month, $today_year, $today_jam, $today_menit, $today_detik, $user_id, $username_value, $file_folder_name, $data_type)
		{
			$data = array (
				'id' => $user_id,
				'username' => $username_value,
				'file_folder' => $file_folder_name,
				'tanggal' => $today_date,
				'bulan' => $today_month,
				'tahun' => $today_year,
				'jam' => $today_jam,
				'menit' => $today_menit,
				'detik' => $today_detik,
				'tipe_data' => $data_type
			);
			$this->db->insert('track_record',$data);
		}
		
		public function update_user($id, $field, $content)
		{
			$data = array($field => $content);
			$this
				->db
				->where('id', $id)
				->update('users', $data);
			return true;
		}

		public function change_password($id, $old_password, $new_password)
		{
			/**
			* Mengubah password yang dikontrol dari change profile pada session login memo 
			*/
			$q = $this
					->db
					->where('id', $id)
					//->where('user_password', $old_password)
					->limit(1)
					->get('users');
		
			if($q->num_rows() > 0) {
				
				//cek kesamaan password 
				$this->load->library('password');
				if(!$this->password->validate_password($old_password, $q->row()->user_password)){
					error_log('Unsuccessful change password attempt');
					return false; 
				}
				
				$this
					->db
					->where('id', $id)
					->update('users', array('user_password' => $new_password));
				return true;
			}
			return false;
		}

		public function delete_user($id)
		{
			$this
				->db
				->where('id', $id)
				->delete('users');
			return true;
		}
		
		public function register_adduser($usr_data) {
			
			//enkripsi password 
			$this->load->library('password');                 
            $hashed = $this->password->create_hash($usr_data['password']);                
            $usr_data['password'] = $hashed;
			
			//info tambahan
			$usr_data['role'] = 'subscriber';
			$usr_data['status'] = 'approved';
			
			// Input data ke database
			$data_in = array (
						'user_email' => $usr_data['username'],
						'user_firstname' => $usr_data['firstname'],
						'user_lastname' => $usr_data['lastname'],
						'user_role' => $usr_data['role'],
						'user_password' => $usr_data['password'],
						'user_status' => $usr_data['status']
					);
			
			$this->db->insert('users', $data_in);

			// Cek jika data berhasil dimasukkan
			if($this->check_user($usr_data['username']) !== false) return true;
			return false;
			
		}

}

?>