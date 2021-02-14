<?php

// extends class Model
class CategoryServicesM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong!';
    return $response;
  }

  // function untuk insert data ke tabel tb_category_services
  public function add_category($name,$description,$icon,$priority){

    if(empty($name) || empty($icon) || empty($priority)){
      return $this->empty_response();
    }else{

      $data = array(
        "name"=>$name,
        "description"=>$description,
        "icon"=>$icon,
        "priority"=>$priority,
      );

      $insert = $this->db->insert("tb_category_services", $data);

      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data category ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data category gagal ditambahkan.';
        return $response;
      }
    }

  }

  // mengambil semua data category
  public function all_category(){
    $all = $this->db->get("tb_category_services")->result();
    $response['status']=200;
    $response['error']=false;
    $response['category']=$all;
    return $response;
  }

  // hapus data category

  public function delete_category($id){
    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("tb_category_services");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data category dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data category gagal dihapus.';
        return $response;
      }
    }

  }

  // update category
  public function update_category($id,$name,$description,$icon,$priority){

    if($id == '' || empty($name) || empty($icon) || empty($priority)){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $set = array(
        "name"=>$name,
        "description"=>$description,
        "icon"=>$icon,
        "priority"=>$priority,
      );

      $this->db->where($where);
      $update = $this->db->update("tb_category_services",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data category diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data category gagal diubah.';
        return $response;
      }
    }

  }
}

?>
