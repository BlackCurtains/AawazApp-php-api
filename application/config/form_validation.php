<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'user_put' => array(
		array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|valid_email'),
		array('field' => 'fullname', 'label' => 'username', 'rules' => 'trim|required|max_length[50]'),
		array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[8]'),
		array('field' => 'ip_address', 'label' => 'ip_address', 'rules' => 'trim'),
	),
	'user_post' => array(
		array('field' => 'email', 'label' => 'email', 'rules' => 'trim|valid_email'),
		array('field' => 'username', 'label' => 'username', 'rules' => 'trim|max_length[50]'),
		array('field' => 'password', 'label' => 'password', 'rules' => 'trim|min_length[8]'),
		array('field' => 'ip_address', 'label' => 'ip_address', 'rules' => 'trim'),
	),
	'event_put' => array(
		array('field' => 'name', 'label' => 'name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'description', 'rules' => 'trim|required|max_length[5000]'),
		array('field' => 'img', 'label' => 'img', 'rules' => 'trim|required'),
		array('field' => 'img_uri', 'label' => 'img_uri', 'rules' => 'trim|max_length[80]'),
		array('field' => 'author', 'label' => 'author', 'rules' => 'trim'),
	),
	'comment_put' => array(
		array('field' => 'comment', 'label' => 'comment', 'rules' => 'trim|required|max_length[1000]'),
		array('field' => 'user_id', 'label' => 'user_id', 'rules' => 'trim|required'),
		array('field' => 'forum_id', 'label' => 'forum_id', 'rules' => 'trim|required'),
	),
	'forum_put' => array(
		array('field' => 'topic', 'label' => 'topic', 'rules' => 'trim|required|max_length[100]'),
		array('field' => 'description', 'label' => 'description', 'rules' => 'trim|required|max_length[1000]'),
		array('field' => 'location', 'label' => 'location', 'rules' => 'trim|required|max_length[500]'),
		array('field' => 'photo', 'label' => 'photo', 'rules' => 'trim'),
		array('field' => 'category', 'label' => 'category', 'rules' => 'trim|required'),
	),

);