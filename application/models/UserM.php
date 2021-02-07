<?php

// extends class Model
class UserM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong!';
    return $response;
  }

  // function untuk insert data ke tabel tb_user
  public function add_user($name,$address,$phone,$email,$gender,$password,$role){

    if(empty($name) || empty($address) || empty($phone) || empty($email) || empty($gender) || empty($password) || empty($role)){
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
        "role"=>$role,
      );

      $insert = $this->db->insert("tb_user", $data);

      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data user ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data user gagal ditambahkan.';
        return $response;
      }
    }

  }

  // cek email user
  public function cek_email($email){
    $this->db->where("email",$email);
    $rows = $this->db->get("tb_user")->num_rows();
    return $rows;
  }

  // cek email handphone
  public function cek_phone($phone){
    $this->db->where("phone",$phone);
    $rows = $this->db->get("tb_user")->num_rows();

    return $response;
  }

  // cek email handphone
  public function cek_login($email,$password){
    $this->db->where("email",$email);
    $this->db->where("password",$password);
    $rows = $this->db->get("tb_user")->num_rows();
      if($rows > 0){
        $response['status']=200;
        $response['error']=true;
        $tokenData = array();
        $tokenData['id'] = "test123"; //TODO: Replace with data for token
        $response['message']['token']= AUTHORIZATION::generateToken($tokenData);   
      }else{
          $response['status']=502;
          $response['error']=true;
          $response['message']='User tidak ditemukan.';
          return $response;
      }
    return $response;
  }

  // mengambil semua data user
  public function all_user(){
    $all = $this->db->get("tb_user")->result();
    $response['status']=200;
    $response['error']=false;
    $response['user']=$all;
    return $response;
  }

  // hapus data user
  public function delete_user($id){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("tb_user");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data user dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data user gagal dihapus.';
        return $response;
      }
    }

  }

  // update user
  public function update_user($id,$name,$address,$phone,$email,$gender){

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
      $update = $this->db->update("tb_user",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data user diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data user gagal diubah.';
        return $response;
      }
    }

  }

  // change password user
  public function change_password_user($id,$password){

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
      $update = $this->db->update("tb_user",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data user diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data user gagal diubah.';
        return $response;
      }
    }

  }

}

?>
