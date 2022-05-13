<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_api_login extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  function login($name){
      
    $this->db->select('*');
    $this->db->from('ms_user');
    $this->db->where('email', $name);
    $this->db->where('status',1);
    $query = $this->db->get();
   
    return $query->row();
  }

  function getRoleModel($id)
  {
    $this->db->where('id',1);
    $query = $this->db->get('ms_role');
    return $query->row();
  }
  
  function postRegister($data)
	{
	  $this->db->insert('ms_user', $data);
	  return $this->db->insert_id();
    }
    
    

    function listGudangLoginModel()
      {
        $this->db->select('id,name_warehouse,CAST(mid(name_warehouse,3,6) as SIGNED) as squen');
        $this->db->order_by('3','asc');
        $query = $this->db->get('ms_warehouse');
        return $query->result();
      }

      function loginKoordinator($name){
      
        $this->db->select('*');
        $this->db->from('ms_user');
        $this->db->where('name', $name);
        $this->db->where('role', 'TRUK-KOORDINATOR');
        $query = $this->db->get();
       
        return $query->row();
      }

      

      function checkVersiApk($versi,$type)
      {
        $this->db->where('apk_version',$versi);
        $this->db->where('apk_type',$type);
        $query = $this->db->get('ms_apk_version');
        return $query->row();
      }

      function ambilApk($type)
      {
        $this->db->where('apk_type',$type);
        $query = $this->db->get('ms_apk_version');
        return $query->row();
      }

      function cekDataUserModel($email)
      {
        $this->db->where('email',$email);
        $query = $this->db->get('ms_user');
        return $query->row();
      }

      function getTimeForgetDateModel()
      {
        $sql = "SELECT DATE_ADD(NOW(), INTERVAL 5 MINUTE) as forget_date";
        $query = $this->db->query($sql);
        return $query->row();
      }

      function updateDateForgetUserModel($id,$datas)
      {
        $this->db->set($datas);
        $this->db->where('id', $id);
        $this->db->update('ms_user');
        return $this->db->affected_rows();
      }

      



     
	
  
  

}
