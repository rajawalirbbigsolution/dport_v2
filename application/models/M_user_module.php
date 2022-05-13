<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user_module extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getData($num, $offset)
  {
    $this->db->where('status', 1);
    $query = $this->db->get("ms_user_module", $num, $offset);

    return $query->result();
  }

  function getEditData($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get("ms_user_module");

    return $query->row();
  }

  function get_update_driver($datas, $id)
  {
    $this->db->set($datas);
    $this->db->where('id', $id);
    $this->db->update('ms_user_module');

    return $this->db->affected_rows();
  }

  function deleteUserModule($id, $user_id)
  {
    $this->db->set('update_user', $user_id);
    $this->db->set('updated_date', date('Y-m-d H:i:s'));
    $this->db->set('status', 0);
    $this->db->where('id', $id);
    $this->db->update('ms_user_module');
   
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function postAdd($data)
  {
    $this->db->insert('ms_user_module', $data);

    return $this->db->insert_id();
  }

  function search($title)
  {
    $this->db->like('name_product', $title, 'both');
    $this->db->where('delete_flag', 1);
    $this->db->order_by('name_product', 'ASC');
    $this->db->limit(10);

    return $this->db->get('zrn_product')->result();
  }

  function search_filter_name($role_name, $num, $offset)
  {
      $this->db->like('role_name', $role_name);
    $this->db->where('status', 1);
    $query = $this->db->get("ms_user_module", $num, $offset);
    return $query->result();
  }
  
  function getRoleID()
  {
      $this->db->where('status', 1);
      $query = $this->db->get('ms_role');
      
      return $query->result();
  }
  
  function getRoleParam($roleID)
  {
      $this->db->where('status', 1);
      $this->db->where('id', $roleID);
      $query = $this->db->get('ms_role');
      
      return $query->row();
  }
  
  function getModule()
  {
      $this->db->where('status', 1);
      $query = $this->db->get('ms_module');
      
      return $query->result();
  }
  
  function getModuleParam($moduleID)
  {
      $this->db->where('status', 1);
      $this->db->where('id', $moduleID);
      $query = $this->db->get('ms_module');
      
      return $query->row();
  }
}