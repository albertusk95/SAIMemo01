<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('id') == NULL) { 
			redirect(site_url('user_auth/signup'));
		}
		else if($this->session->userdata('user_role') != 'admin') {	
			redirect(site_url('user_auth/signup'));
		}
		$this->load->model('Userauth_model');
		$this->load->model('Memo_model');
		$this->load->model('Log_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	private function _date_modified($time){
		$second = time() - strtotime($time);
		$minute = intval($second/60);
		$hour = intval($second/3600);
		$day = intval($second/86400);
		if($second < 60) {
			$modified = $second . ' second';
			if($second > 1) $modified .= 's';
			$modified .= ' ago';
		}
		else if($second < 3600){
			$modified = $minute . ' minute';
			if($minute > 1) $modified .= 's';
			$modified .= ' ago';
		}
		else if($second < 86400){
			$modified = $hour . ' hour';
			if($hour > 1) $modified .= 's';
			$modified .= ' ago';
		}
		else if($second < 2592000){
			$modified = $day . ' day';
			if($day > 1) $modified .= 's';
			$modified .= ' ago';
		}
		else $modified = date('j F Y', strtotime($time));
		return $modified;
	}

	public function index()
	{
		redirect(site_url('admin/users'));
	}

	public function user($e_user_id = null)
	{
		$user_id = $this->session->userdata('id');
		
		if($e_user_id == null){
			redirect(site_url('admin/users'));
		}
		elseif($e_user_id == 'add'){

			$this->form_validation->set_rules('username', 'Username','required|alpha_numeric|is_unique[users.username]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

			// Jika validasi berhasil
			if($this->form_validation->run())
			{
				// Ambil data dari model
				$user = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
				);
				// Jika berhasil register, redirect ke halaman login
				if($this->Userauth_model->register_admin($user)){
					$created_user_id = $this->Userauth_model->check_user($user['username']);
					$this->Log_model->add_log($user_id, 'auth', 'add user', $created_user_id.'('.$user['username'].')');
					$this->Memo_model->create_folder('', '', $this->Userauth_model->check_user($user['username']));
					redirect(site_url('admin/users'));
				}

				// Jika tidak berhasil register

			}
			$header_data = array('title' => 'SAIMemo | User Management');
			$this->load->view('simplecloud/Admin/header', $header_data);

			$this->load->view('simplecloud/Admin/sidebar');

			$this->load->view('simplecloud/Admin/add-user');
		}
		else {
			$username = $this->Userauth_model->get_username($e_user_id);
			if($this->input->get('delete')){
				$delete_username = $this->Userauth_model->get_username($e_user_id);
				$this->Userauth_model->delete_user($e_user_id);
				$this->Log_model->add_log($user_id, 'auth', 'delete', $e_user_id.'('.$username.')');
				redirect(site_url('admin/users' . '?delete_success=1&delete_name=' . $delete_username));
			}
			if($this->input->get('edit')){
				if($this->input->post('modify') == 'username'){
					$this->form_validation->set_rules('username', 'Username','required|alpha_numeric|is_unique[users.username]');
					if($this->form_validation->run()){
						$modify_username = $this->input->post('username');
						if($this->Userauth_model->update_user($e_user_id, 'user_email', $modify_username)){
							$this->Log_model->add_log($user_id, 'auth', 'edit username', $e_user_id.'('.$username.'=>'.$modify_username.')');
							redirect(site_url('admin/users' . '?modify_success=1&old_name='.$username.'&new_name='.$modify_username));
						}
					}
					redirect(site_url('admin/users/' . $e_user_id));
				}
				else if($this->input->post('modify')=='password'){
					$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
					if($this->form_validation->run()){
						$modify_password = $this->input->post('password');
						if($this->Userauth_model->update_user($e_user_id, 'user_password', sha1($modify_password))){
							$this->Log_model->add_log($user_id, 'auth', 'edit password', $e_user_id.'('.$username.')');
							redirect(site_url('admin/users' . '?password_success=1&username='.$username));
						}
					}
				}
			}
			if($this->input->get('promote')){
				if($this->Userauth_model->update_user($e_user_id, 'user_role', 'admin')){
					$this->Log_model->add_log($user_id, 'auth', 'promote', $e_user_id.'('.$username.')');
					redirect(site_url('admin/users' . '?promote_success=1&username='.$username));
				}
			}
			if($this->input->get('demote')&&$user_id!=$e_user_id){
				if($this->Userauth_model->update_user($e_user_id, 'user_role', 'subscriber')){
					$this->Log_model->add_log($user_id, 'auth', 'demote', $e_user_id.'('.$username.')');
					redirect(site_url('admin/users' . '?demote_success=1&username='.$username));
				}
			}

			$header_data = array('title' => 'SAIMemo | Edit '.$username);
			$this->load->view('simplecloud/Admin/header', $header_data);

			$this->load->view('simplecloud/Admin/sidebar');

			$data =  array('id' => $e_user_id, 'username' => $username);
			$this->load->view('simplecloud/Admin/edit-user', $data);

			$this->load->view('simplecloud/Admin/footer');
		}
	}

	public function users($user_id = null)
	{
		$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
		$asc = isset($_GET['asc']) ? $_GET['asc'] : 1;

		$users = $this->Userauth_model->list_user(null,null,$sort,($asc)?'asc':'desc');
		foreach ($users as $key => $user) {
			$user->date_created = $this->_date_modified($user->date_created);
		}

		$header_data = array('title' => 'SAIMemo | User Management');
		$this->load->view('simplecloud/Admin/header', $header_data);

		$this->load->view('simplecloud/Admin/sidebar');

		$data =  array('users'=>$users, 'sort'=>$sort, 'asc'=>$asc);
		$this->load->view('simplecloud/Admin/list-user', $data);

		$this->load->view('simplecloud/Admin/footer');
	}

	public function settings()
	{
		$user_id=$this->session->userdata('id');
		$config_file = fopen(APPPATH . 'config/cloud/config', "r+");
		$cloud = unserialize(fgets($config_file));
		fclose($config_file);

		if($this->input->post('modify')=='settings'){
			$this->form_validation->set_rules('upload_path', 'Upload Path', 'required');
			if($this->form_validation->run()){
				$cloud = array(
						'upload_path' => $this->input->post('upload_path'),
						'allowed_types' => $this->input->post('allowed_types'),
						'overwrite' => ($this->input->post('overwrite')=='1')?TRUE:FALSE,
						'max_size' => $this->input->post('max_size'),
						'remove_spaces' => FALSE
				);
				$config_file = fopen(APPPATH . 'config/cloud/config', "w");
				fwrite($config_file, serialize($cloud));
				fclose($config_file);
				$this->Log_model->add_log($user_id, 'settings', 'modify', 'all');
				redirect(site_url('admin/settings?settings_success=1'));
			}
		}

		$header_data = array('title' => 'SAIMemo | Memo Settings');
		$this->load->view('simplecloud/Admin/header', $header_data);

		$this->load->view('simplecloud/Admin/sidebar');

		$this->load->view('simplecloud/Admin/settings', $cloud);

		$this->load->view('simplecloud/Admin/footer');
	}

	public function logs()
	{
		$s_id = isset($_GET['id'])?$_GET['id']:null;
		$type = isset($_GET['type'])?$_GET['type']:null;
		$sort = isset($_GET['sort'])?$_GET['sort']:'user_id';
		$asc = isset($_GET['asc'])?$_GET['asc']:1;

		$logs = $this->Log_model->get_logs($s_id, $type, $sort, $asc?'asc':'desc');


		$header_data = array('title' => 'SAIMemo | Logs');
		$this->load->view('simplecloud/Admin/header', $header_data);

		$this->load->view('simplecloud/Admin/sidebar');

		$data = array('logs' => $logs, 'sort' => $sort, 'asc' => $asc);
		$this->load->view('simplecloud/Admin/logs', $data);

		$this->load->view('simplecloud/Admin/footer');
	}
}