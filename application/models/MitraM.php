<?php

// extends class Model
class MitraM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong!';
    return $response;
  }

  // function untuk insert data ke tabel tb_mitra
  public function add_mitra($name,$address,$phone,$email,$gender,$password,$no_ktp,$ktp){

    if(empty($name) || empty($address) || empty($phone) || empty($email) || empty($gender) || empty($password) || empty($no_ktp) || empty($ktp)){
      return $this->empty_response();
    }else if($this->cek_email($email) > 0){
      $response['status']=502;
      $response['error']=true;
      $response['message']='Email sudah terdaftar!';
      return $response;
    }else if($this->cek_phone($phone) > 0){
      $response['status']=502;
      $response['error']=true;
      $response['message']='Nomor Handphone sudah terdaftar!';
      return $response;
    }else{

      $data = array(
        "name"=>$name,
        "address"=>$address,
        "phone"=>$phone,
        "email"=>$email,
        "gender"=>$gender,
        "password"=>$password,
        "no_ktp"=>$no_ktp,
        "ktp"=>$ktp,
      );

      $insert = $this->db->insert("tb_mitra", $data);

      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data mitra ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data mitra gagal ditambahkan.';
        return $response;
      }
    }

  }

  // cek email mitra
  public function cek_email($email){
    $this->db->where("email",$email);
    $rows = $this->db->get("tb_mitra")->num_rows();
    return $rows;
  }

  // cek email handphone
  public function cek_phone($phone){
    $this->db->where("phone",$phone);
    $rows = $this->db->get("tb_mitra")->num_rows();
    return $rows;
  }

  // mengambil semua data mitra
  public function all_mitra(){
    $all = $this->db->get("tb_mitra")->result();
    $response['status']=200;
    $response['error']=false;
    $response['mitra']=$all;
    return $response;
  }

  // hapus data mitra
  public function delete_mitra($id){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("tb_mitra");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data mitra dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data mitra gagal dihapus.';
        return $response;
      }
    }

  }

  // update mitra
  public function update_mitra($id,$name,$address,$phone,$email,$gender){

    if($id == '' || empty($name) || empty($address) || empty($phone) || empty($email) || empty($gender)){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $set = array(
        "name"=>$name,
        "address"=>$address,
        "phone"=>$phone,
        "email"=>$email,
        "gender"=>$gender,
      );

      $this->db->where($where);
      $update = $this->db->update("tb_mitra",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data mitra diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data mitra gagal diubah.';
        return $response;
      }
    }

  }

  // change password mitra
  public function change_password_mitra($id,$password){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $set = array(
        "password"=>$password,
      );

      $this->db->where($where);
      $update = $this->db->update("tb_mitra",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data mitra diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data mitra gagal diubah.';
        return $response;
      }
    }

  }

}

?>
