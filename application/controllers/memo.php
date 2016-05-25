<?php
	
class memo extends CI_Controller {
	
		private $cloud;
		
		public $status; 
        public $roles;
	
		public function __construct() {
			/**
			* Konstruktor
			*/
				parent::__construct();
				
				// User harus login untuk mengakses SAIMemo
				if($this->session->userdata('id') == NULL) {
					redirect(site_url('user_auth/signup'));
				}
				$this->load->model('Memo_model');
				$this->load->model('Userauth_model');
				$this->load->model('Log_model');
				$this->load->helper(array('form', 'path'));
				$this->load->library('form_validation');
				$config_file = fopen(APPPATH . 'config/cloud/config', "r+");
				$this->cloud = unserialize(fgets($config_file));
				fclose($config_file);
		}

		function alpha_numeric_dash_space($str)
		{
			return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
		} 
		
		private function _breadcrumbs($path_segments) 
		{
			$url = '';
			$breadcrumbs = array();
			$real_path_segments = $this->Memo_model->real_path_segments($path_segments);
			foreach($path_segments as $key=>$path){
				$url .= $path . '/';
				array_push($breadcrumbs, array('title'=> $real_path_segments[$key], 'url'=> site_url('memo/folder/' . $url)));
			}
			return $breadcrumbs;
		}

		public function index()
		{			
			if ($this->input->get('access_state') == 1) {
				redirect(site_url('memo/folder?access_state=1'));
			} else {
				redirect(site_url('memo/folder'));
			}
		}
		
		public function folder()
		{
			
			// jika user belum login/ sign up, redirect ke halaman signup 
			if ($this->session->userdata('id') == NULL) {
				redirect(site_url('user_auth/signup'));
			}
			
			$user_id = $this->session->userdata('id');
			$url_segments = $this->uri->segments;
			unset($url_segments[1], $url_segments[2]);

			$delete = $this->input->get('delete');
			$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
			$sort_asc = isset($_GET['asc']) ? $_GET['asc'] : 1;

			if($delete==1&&$this->Memo_model->delete_folder($user_id, $url_segments)){
				$delete_name = base64_decode(array_pop($url_segments));
				$path = $this->Memo_model->get_path(1, $url_segments);
				$this->Log_model->add_log($user_id, 'cloud', 'delete folder', $this->Memo_model->get_path(0, $url_segments).'/'.$delete_name);
				redirect(site_url('memo/folder'.$path.'?delete_success=1&delete_name='.$delete_name));
			}

			// Ambil data dari model
			$contents = $this->Memo_model->get_contents($user_id, $url_segments, $sort, $sort_asc);

			$data = array(
				'path' => $this->Memo_model->get_path(1, $url_segments),
				'real_path' => $contents['real_path'],
				'folders' => $contents['folders'],
				'files' => $contents['files'],
				'breadcrumbs' => $this->_breadcrumbs($url_segments),
				'sort' => $sort,
				'asc' => $sort_asc
			);
			
			$this->load->view('simplecloud/Memo/header', array('title'=>'SAIMemo'));
			$this->load->view('simplecloud/Memo/folder', $data);
			$this->load->view('simplecloud/Memo/footer');
		}
		
		/*
		public function folder()
		{
			// Olah data dari URL
			$user_id = $this->session->userdata('id');
			$url_segments = $this->uri->segments;
			unset($url_segments[1], $url_segments[2]);

			$delete = $this->input->get('delete');
			$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
			$sort_asc = isset($_GET['asc']) ? $_GET['asc'] : 1;

			if($delete==1 && $this->Memo_model->delete_folder($user_id, $url_segments)){
				$len = count($url_segments);
				$i = 0;
				foreach ($url_segments as $key=>$segment) {
					if ($i == $len-1) {
						$delete_name = base64_decode($segment);
						unset($url_segments[$key]);
					}
					$i++;
				}
				
				//$this->load->model('Userauth_model');
				$today = getdate();
				$today_date = $today[mday];
				$today_month = $today[mon];
				$today_year = $today[year];
				$today_jam = $today[hours];
				$today_menit = $today[minutes];
				$today_detik = $today[seconds];
				$username_value = $this->session->userdata('user_email');
				$data_type = 'delete_folder';
				$folder_deleted = $delete_name;
				
				$this->Userauth_model->tambah_trackrecord($today_date, $today_month, $today_year, $today_jam, $today_menit, $today_detik, $user_id, $username_value, $folder_deleted, $data_type);
				
				$path = $this->Memo_model->get_path(1, $url_segments);
				redirect('memo/folder'.$path.'?delete_success=1&delete_name='.$delete_name);
			}

			// Ambil data dari model
			$contents = $this->Memo_model->get_contents($user_id, $url_segments, $sort, $sort_asc);

			$data = array(
				'path' => $this->Memo_model->get_path(1, $url_segments),
				'real_path' => $contents['real_path'],
				'folders' => $contents['folders'],
				'files' => $contents['files'],
				'breadcrumbs' => $this->_breadcrumbs($url_segments),
				'sort' => $sort,
				'asc' => $sort_asc
			);
			
			if ($this->session->userdata('user_role') != 'admin')
			{
				$this->load->view('simplecloud/Memo/header', array('title'=>'SAIMemo'));
				$this->load->view('simplecloud/Memo/folder', $data);
				$this->load->view('simplecloud/Memo/footer');
			}
			else 
			{
				$this->load->view('admin/simplecloud/Memo/header', array('title'=>'SAIMemo'));
				$this->load->view('admin/simplecloud/Memo/folder', $data);
				$this->load->view('admin/simplecloud/Memo/footer');
			}
		}
		*/
		
		public function new_folder()
		{
			$this->form_validation->set_rules('foldername', 'New Folder','required|callback_alpha_numeric_dash_space');
			if($this->form_validation->run()) {
				$user_id = $this->session->userdata('id');
				$url_segments = $this->uri->segments;
				$folder_name = $this->input->post('foldername');
				unset($url_segments[1], $url_segments[2]);

				if($this->Memo_model->create_folder($user_id, $url_segments, $folder_name)){
					$this->Log_model->add_log($user_id, 'cloud', 'add folder', $this->Memo_model->get_path(0, $url_segments).'/'.$folder_name);
					redirect(site_url('memo/folder'.$this->Memo_model->get_path(1, $url_segments).'?create_success=1&create_name='.$folder_name));
				}
			}
			redirect(site_url('memo/folder'.$this->Memo_model->get_path(1, $url_segments)));
		}
		
		/*
		public function new_folder()
		{
			$user_id = $this->session->userdata('id');
			$url_segments = $this->uri->segments;
			$folder_name = $this->input->post('foldername');
			unset($url_segments[1], $url_segments[2]);

			if($this->Memo_model->create_folder($user_id, $url_segments, $folder_name))
				
				//mengambil data track record
				$today = getdate();
				$today_date = $today[mday];
				$today_month = $today[mon];
				$today_year = $today[year];
				$today_jam = $today[hours];
				$today_menit = $today[minutes];
				$today_detik = $today[seconds];
				$username_value = $this->session->userdata('user_email');
				$data_type = 'new_folder';
				
				$this->Userauth_model->tambah_trackrecord($today_date, $today_month, $today_year, $today_jam, $today_menit, $today_detik, $user_id, $username_value, $folder_name, $data_type);
				
				redirect('memo/folder'.$this->Memo_model->get_path(1, $url_segments).'?create_success=1&create_name='.$folder_name);
		}
		*/
		
		
		public function download_file($path)
		{
			$path_segments = explode('/', $path);
			$file = array_pop($path_segments);
			if (file_exists($path)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'. $file . '"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($path));
				readfile($path);
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function file()
		{
			$user_id = $this->session->userdata('id');
			$url_segments = $this->uri->segments;
			unset($url_segments[1], $url_segments[2]);

			$path = $this->Memo_model->get_path(1, $url_segments);
			$real_path = $this->Memo_model->get_path(0, $url_segments);

			$delete = $this->input->get('delete');

			if($delete==1&&$this->Memo_model->delete_file($user_id, $url_segments)){
				$delete_name = base64_decode(array_pop($url_segments));
				$path = $this->Memo_model->get_path(1, $url_segments);
				$this->Log_model->add_log($user_id, 'cloud', 'delete file', $real_path);
				redirect(site_url('memo/folder'.$path.'?delete_success=1&delete_name='.$delete_name));
			}

			$download = $this->input->get('download');

			if ($download == 1) {
				$file = $this->Memo_model->get_file($user_id, $real_path);
				$this->download_file($file);
				$this->Log_model->add_log($user_id, 'cloud', 'download', $real_path);
			}
		}
		
		/*
		public function file()
		{
			$this->load->helper('form');
			$user_id = $this->session->userdata('id');
			$url_segments = $this->uri->segments;
			unset($url_segments[1], $url_segments[2]);

			$delete = $this->input->get('delete');

			if($delete==1&&$this->Memo_model->delete_file($user_id, $url_segments)){
				$len = count($url_segments);
				$i = 0;
				foreach($url_segments as $key=>$segment){
					if($i==$len-1){
						$delete_name = base64_decode($segment);
						unset($url_segments[$key]);
					}
					$i++;
				}
				
				$today = getdate();
				$today_date = $today[mday];
				$today_month = $today[mon];
				$today_year = $today[year];
				$today_jam = $today[hours];
				$today_menit = $today[minutes];
				$today_detik = $today[seconds];
				$username_value = $this->session->userdata('user_email');
				$data_type = 'delete_file';
				$file_deleted = $delete_name;
				
				$this->Userauth_model->tambah_trackrecord($today_date, $today_month, $today_year, $today_jam, $today_menit, $today_detik, $user_id, $username_value, $file_deleted, $data_type);
				
				
				$path = $this->Memo_model->get_path(1, $url_segments);
				redirect('memo/folder'.$path.'?delete_success=1&delete_name='.$delete_name);
			}
		}
		*/
		
		public function upload()
		{
			$user_id = $this->session->userdata('id');
			$url_segments = $this->uri->segments;
			unset($url_segments[1], $url_segments[2]);

			$error = '';

			if(isset($_FILES['userfile'])){
				$this->cloud['upload_path'] .= '/' . $user_id . '/' . $this->Memo_model->get_path(0, $url_segments);
				if($this->input->post('filename') !== '') $this->cloud['file_name'] = $this->input->post('filename');
				$this->load->library('upload', $this->cloud);

				$file_data = $this->upload->data();
				$upload_success = $this->upload->do_upload();
				if ($upload_success)
				{
					$file_data = $this->upload->data();
					$this->Log_model->add_log($user_id, 'cloud', 'upload', $this->Memo_model->get_path(0, $url_segments).'/'.$this->cloud['file_name']);
					redirect(site_url('memo/folder'.$this->Memo_model->get_path(1, $url_segments).'?upload_success=1&upload_name='.$file_data['file_name']));
				}
				else
				{
					$error = 'File upload cancelled';
				}
			}
			$data_header = array(
				'title'=>'SAIMemo | Upload',
				'error'=>$error
			);
			$data = array(
				'path'=>$this->Memo_model->get_path(1, $url_segments),
				'max_size'=>$this->cloud['max_size'],
				'breadcrumbs' => $this->_breadcrumbs($url_segments)
			);
			$this->load->view('simplecloud/template/header', $data_header);
			$this->load->view('simplecloud/Memo/upload', $data);
			$this->load->view('simplecloud/template/footer');
		}
		
		/*
		public function upload()
		{
			$user_id = $this->session->userdata('id');
			$url_segments = $this->uri->segments;
			unset($url_segments[1], $url_segments[2]);

			//$config['upload_path']		= set_realpath($_SERVER['DOCUMENT_ROOT'] . '/../cloud/' . $user_id . $this->Cloud_model->get_path(0, $url_segments));
			$config['upload_path']		= set_realpath('C:/xampp/htdocs' . '/SimpleCloudv1.0/' . $user_id . $this->Memo_model->get_path(0, $url_segments));
			
			$config['allowed_types']	= '*';
			$config['overwrite']		= TRUE;
			$config['max_size']			= 3000;
			$config['remove_spaces']	= FALSE;

			$error = '';

			if(isset($_FILES['userfile'])){
				if($this->input->post('filename') !== '') $config['file_name'] = $this->input->post('filename');
				$this->load->library('upload', $config);

				$file_data = $this->upload->data();
				$upload_success = $this->upload->do_upload();
				if ($upload_success)
				{
					$file_data = $this->upload->data();
					
					//mengambil data track record
					$today = getdate();
					$today_date = $today[mday];
					$today_month = $today[mon];
					$today_year = $today[year];
					$today_jam = $today[hours];
					$today_menit = $today[minutes];
					$today_detik = $today[seconds];
					$username_value = $this->session->userdata('user_email');
					$data_type = 'upload_file';
					$file_name = $this->input->post('filename');
					$this->Userauth_model->tambah_trackrecord($today_date, $today_month, $today_year, $today_jam, $today_menit, $today_detik, $user_id, $username_value, $file_name, $data_type);
				
					redirect('memo/folder'.$this->Memo_model->get_path(1, $url_segments).'?upload_success=1&upload_name='.$file_data['file_name']);
				}
				else
				{
					$error = 'File upload cancelled';
				}
			}
			$data_header = array(
				'title'=>'SAIMemo | Upload',
				'error'=>$error
			);
			$data = array(
				'path'=>$this->Memo_model->get_path(1, $url_segments),
				'max_size'=>$config['max_size'],
				'breadcrumbs' => $this->_breadcrumbs($url_segments)
			);
			
			if ($this->session->userdata('user_role') != 'admin')
			{
				$this->load->view('simplecloud/Memo/header', $data_header);
				$this->load->view('simplecloud/Memo/upload', $data);
				$this->load->view('simplecloud/Memo/footer');
			}
			else 
			{
				$this->load->view('admin/simplecloud/Memo/header', $data_header);
				$this->load->view('admin/simplecloud/Memo/upload', $data);
				$this->load->view('admin/simplecloud/Memo/footer');
			}
		}
		*/
		
}

?>
		