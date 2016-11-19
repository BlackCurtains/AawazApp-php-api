<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require APPPATH."/libraries/REST_Controller.php";

class api extends REST_Controller
{
  public function __construct(){
  	parent::__construct();
    $this->load->helper('my_api');
  }
   public function user_get(){
   	$id = $this->uri->segment(3);
   	$this->load->model('model_user');

   	$user = $this->model_user->get_by(array("id"=> $id));
   	if(isset($user['id'])){
   		$this->response(array('status' => 1, 'message' => $user));
   	}else{
   		$this->response(array('status' => 0, 'message' => 'Error in Request.'));
   	}
   	
   }

   public function user_put(){
    $this->load->library('form_validation');
    $data = remove_unknown_fields($this->put(), $this->form_validation->get_field_names('user_put'));
    $this->form_validation->set_data($data);
    if($this->form_validation->run('user_put') !== FALSE) {
      $this->load->model('model_user');

      $email_exists = $this->model_user->get_by(array('email'=> $this->put('email')));
      if($email_exists){
        $this->response(array('status'=>'failure', 'message' => 'The specified email address already exists.'));
      }
      $id = $this->model_user->insert($data);
      if(!$id){
        $this->response(array('status'=> 'failure', 'message' => 'Unexpected error occured'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>'success', 'message' =>'created'));
      }

    } else {
     $this->response(array('status'=>'failure', 'message'=> $this->form_validation->get_errors_as_array() ), REST_Controller::HTTP_BAD_REQUEST);
    }

   }

   public function user_post(){
    $id = $this->uri->segment(3);
    $this->load->model('model_user');

    $user = $this->model_user->get_by(array("id"=> $id));
    if(isset($user['id'])){
        $this->load->library('form_validation');
        $data = remove_unknown_fields($this->post(), $this->form_validation->get_field_names('user_post'));
        $this->form_validation->set_data($data);
        if($this->form_validation->run('user_post') !== FALSE) {
            $this->load->model('model_user');

            $email_safe = !isset($data['email']) || $data['email'] == $user['email']  || !$this->model_user->get_by(array('email'=> $data['email']));
            if(!$email_safe){
              $this->response(array('status'=>'failure', 'message' => 'The specified email address is already in use.'));
            }
            $updated = $this->model_user->update($id, $data);
            if(!$updated){
              $this->response(array('status'=> 'failure', 'message' => 'Unexpected error occured'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else{
              $this->response(array('status'=>'Updated', 'message' =>'created'));
            }

          } else {
           $this->response(array('status'=>'failure', 'message'=> $this->form_validation->get_errors_as_array() ), REST_Controller::HTTP_BAD_REQUEST);
          }
    }else{
      $this->response(array('status' => 'Failure', 'message' => 'Error in Request.'));
    }
    
   }

   //delete method
  public function user_delete(){
    $id = $this->uri->segment(3);
    $this->load->model('model_user');

    $user = $this->model_user->get_by(array("id"=> $id));
    if(isset($user['id'])){
      $data['status'] = 'deleted';
      $deleted = $this->model_user->update($id, $data);
      if(!$deleted){
              $this->response(array('status'=> 'failure', 'message' => 'Unexpected error occured'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status' => 'success', 'message' => 'deleted'));
      }        
      
    }else{
      $this->response(array('status' => 'Failure', 'message' => 'Error in Request.'));
    }
    
   }


/*================================
** Events
**============================*/
// Get single event
   public function event_get(){
    $id = $this->uri->segment(3);
    $this->load->model('model_event');

    $event = $this->model_event->get_by(array("id"=> $id));
    if(isset($event['id'])){
      $this->response(array('status' => 1, 'message' => $event));
    }else{
      $this->response(array('status' => 0, 'message' => 'Error in Request.'));
    }
    
   }

// Get all Events as array
   public function events_get(){
    $this->load->model('model_event');

    $event = $this->model_event->get_all();
    if(isset($event)){
      $this->response(array('status' => 1, 'message' => $event));
    }else{
      $this->response(array('status' => 0, 'message' => 'Error in Request.'));
    }

}
// Create an event by put method
   public function event_put(){
    $this->load->library('form_validation');
    $data = remove_unknown_fields($this->put(), $this->form_validation->get_field_names('event_put'));
    $this->form_validation->set_data($data);
    if($this->form_validation->run('event_put') !== FALSE) {
      $this->load->model('model_event');

      $inserted = $this->model_event->insert($data);
      if(!$inserted){
        $this->response(array('status'=> 'failure', 'message' => 'Unexpected error occured'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>'success', 'message' =>'created'));
      }

    } else {
     $this->response(array('status'=>'failure', 'message'=> $this->form_validation->get_errors_as_array() ), REST_Controller::HTTP_BAD_REQUEST);
    }

   }


/* =============================
Forums
**=========================*/

// Get all Forum Topics as array
   public function forums_get(){
    $this->load->model('model_forum');

    $event = $this->model_forum->get_all();
    if(isset($event)){
      $this->response(array('status' => 1, 'message' => $event));
    }else{
      $this->response(array('status' => 0, 'message' => 'Error in Request.'));
    }

}
// Create comment by put method
   public function forum_put(){
    $this->load->library('form_validation');
    $data = remove_unknown_fields($this->put(), $this->form_validation->get_field_names('forum_put'));
    $this->form_validation->set_data($data);
    if($this->form_validation->run('forum_put') !== FALSE) {
      $this->load->model('model_forum');

      $inserted = $this->model_forum->insert($data);
      if(!$inserted){
        $this->response(array('status'=> 'failure', 'message' => 'Unexpected error occured'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>'success', 'message' =>'created'));
      }

    } else {
     $this->response(array('status'=>'failure', 'message'=> $this->form_validation->get_errors_as_array() ), REST_Controller::HTTP_BAD_REQUEST);
    }

   }




/* =============================
Comments
**=========================*/

// Get all Comments as array
   public function comments_get(){
    $this->load->model('model_comment');

    $event = $this->model_comment->get_all();
    if(isset($event)){
      $this->response(array('status' => 1, 'message' => $event));
    }else{
      $this->response(array('status' => 0, 'message' => 'Error in Request.'));
    }

}
// Create comment by put method
   public function comment_put(){
    $this->load->library('form_validation');
    $data = remove_unknown_fields($this->put(), $this->form_validation->get_field_names('comment_put'));
    $this->form_validation->set_data($data);
    if($this->form_validation->run('comment_put') !== FALSE) {
      $this->load->model('model_comment');

      $inserted = $this->model_comment->insert($data);
      if(!$inserted){
        $this->response(array('status'=> 'failure', 'message' => 'Unexpected error occured'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>'success', 'message' =>'created'));
      }

    } else {
     $this->response(array('status'=>'failure', 'message'=> $this->form_validation->get_errors_as_array() ), REST_Controller::HTTP_BAD_REQUEST);
    }

   }

}