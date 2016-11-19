<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_event extends MY_Model {

	protected $_table = "events";
	protected $primary_key = "id";
	protected $return_type = "array";
	public $before_create = array('prepare_data');

	protected function prepare_data($event){
			$id = $event['name'];
			$uri = "uploads/".$id.".png";
			$actual_uri = "localhost/aawazapi/".$uri;
			$event['img_uri'] = $actual_uri;
			file_put_contents($uri, $event['img']);
			
			return $event;
		}
}