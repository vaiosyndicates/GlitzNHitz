<?php

require APPPATH . 'libraries/REST_Controller.php';

class CategoryServices extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('CategoryServicesM');
  }

  // method index untuk menampilkan semua data category menggunakan method get
  public function index_get(){
    $response = $this->CategoryServicesM->all_category();
    $this->response($response);
  }

  // untuk menambah category menaggunakan method post
  public function add_post(){
    $response = $this->CategoryServicesM->add_category(
        $this->post('name'),
        $this->post('description'),
        $this->post('icon'),
        $this->post('priority'),
      );
    $this->response($response);
  }

  // update data category menggunakan method put
  public function update_put(){
    $response = $this->CategoryServicesM->update_category(
        $this->put('id'),
        $this->put('name'),
        $this->put('description'),
        $this->put('icon'),
        $this->put('priority'),
      );
    $this->response($response);
  }

  // hapus data category menggunakan method delete
  public function delete_delete(){
    $response = $this->CategoryServicesM->delete_category(
        $this->delete('id')
      );
    $this->response($response);
  }

}

?>
