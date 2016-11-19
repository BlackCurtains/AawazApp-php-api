<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_user extends MY_Model {

	protected $_table = "users";
	protected $primary_key = "id";
	protected $return_type = "array";

	public $after_get = array('remove_sensitive_data');
	public $before_create = array('prepare_data');
	public $before_update = array('prepare_update_data');


	protected function remove_sensitive_data($user){
		unset($user['password']);
		unset($user['ip_address']);
		return $user;
	}
	protected function prepare_data($user){
		$user['password'] = md5($user['password']);
		$user['ip_address'] = $this->input->ip_address();
		return $user;
	}
	protected function prepare_update_data($user){
		$user['password'] = md5($user['password']);
		return $user;
	}

}