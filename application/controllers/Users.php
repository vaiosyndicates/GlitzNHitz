<?php

require APPPATH . 'libraries/REST_Controller.php';

class Users extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('UserM');
  }
  
  // function login user method post
  public function login_post(){
    $response = $this->UserM->cek_login(
        $this->post('email'),
        $this->post('password')
      );
    $this->response($response);
  }

}

?>
