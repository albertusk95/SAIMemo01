<?php

class Sc extends CI_Controller {
		
        public function __construct() {
		
				parent::__construct();
				$this->load->helper('url');
		
		}
		
		public function schome() {
			
				$this->load->view('simplecloud/schome');
		
		}
		
}

?>