<?php

require APPPATH . 'libraries/REST_Controller.php';

class User extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('UserM');

    $headers = $this->input->request_headers();
    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
      $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
          return true;
        } 
        $response['status']=502;
        $response['error']=true;
        $response['message']='Unauthorised token.';
        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
    }

  }

  // method index untuk menampilkan semua data user method get
  public function index_get(){
    $response = $this->UserM->all_user();
    //$this->set_response($response);
    $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // untuk menambah user method post
  public function add_post(){
    $response = $this->UserM->add_user(
        $this->post('name'),
        $this->post('address'),
        $this->post('phone'),
        $this->post('email'),
        $this->post('gender'),
        $this->post('password'),
        1
      );
    $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // function login user method post
  public function login_post(){
    $response = $this->UserM->cek_login(
        $this->post('email'),
        $this->post('password')
      );

    $this->set_response($response);
  }

  // update data user method put
  public function update_put(){
    $response = $this->UserM->update_user(
        $this->put('id'),
        $this->put('name'),
        $this->put('address'),
        $this->put('phone'),
        $this->post('email'),
        $this->post('gender')
      );
    $this->set_response($response);
  }

  // change password user method put
  public function password_put(){
    $response = $this->UserM->update_user(
        $this->put('id'),
        $this->put('password')
      );
    $this->set_response($response);
  }

  // hapus data user method delete
  public function delete_delete(){
    $response = $this->UserM->delete_user(
        $this->delete('id')
      );
    $this->set_response($response);
  }

}

?>
