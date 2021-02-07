<?php

require APPPATH . 'libraries/REST_Controller.php';

class User extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('MitraM');
  }

  // method index untuk menampilkan semua data user menggunakan method get
  public function index_get(){
    $response = $this->MitraM->all_mitra();
    $this->response($response);
  }

  // untuk menambah user menaggunakan method post
  public function add_post(){
    $response = $this->MitraM->add_mitra(
        $this->post('name'),
        $this->post('address'),
        $this->post('phone'),
        $this->post('email'),
        $this->post('gender'),
        $this->post('password'),
        $this->post('no_ktp'),
        $this->post('ktp'),
      );
    $this->response($response);
  }

  // update data user menggunakan method put
  public function update_put(){
    $response = $this->MitraM->update_mitra(
        $this->put('id'),
        $this->put('name'),
        $this->put('address'),
        $this->put('phone'),
        //$this->post('email'),
        $this->post('gender'),
      );
    $this->response($response);
  }

  // change password user menggunakan method put
  public function password_put(){
    $response = $this->MitraM->update_mitra(
        $this->put('id'),
        $this->put('password'),
      );
    $this->response($response);
  }

  // hapus data user menggunakan method delete
  public function delete_delete(){
    $response = $this->MitraM->delete_mitra(
        $this->delete('id')
      );
    $this->response($response);
  }

}

?>
