<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends MY_Model {

	public function cloud_setting($config)
	{
		$this->cloud = $config;
	}

}