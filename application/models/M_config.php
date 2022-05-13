<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_config extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getData($num, $offset)
  {
    $this->db->where('status', 1);
    $query = $this->db->get("ms_config", $num, $offset);

    return $query->result();
  }

  function getEditData($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get("ms_config");

    return $query->row();
  }

  function updateConfig($datas, $id)
  {
    $this->db->set($datas);
    $this->db->where('id', $id);
    $this->db->update('ms_config');

    return $this->db->affected_rows();
  }

  function deleteConfig($id, $user_id)
  {
    $this->db->set('update_user', $user_id);
    $this->db->set('updated_date', date('Y-m-d H:i:s'));
    $this->db->set('status', 0);
    $this->db->where('id', $id);
    $this->db->update('ms_config');

    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function postAdd($data)
  {
    $this->db->insert('ms_config', $data);
    return $this->db->insert_id();
  }

  function search_data($company_name, $num, $offset)
  {
    $this->db->like('company_name', $company_name);
    $this->db->where('status', 1);
    $query = $this->db->get("ms_config", $num, $offset);
    
    return $query->result();
  }
  
  function checkIp($ipAddress)
  {
      
      $this->db->where('ip', $ipAddress);
      
      $query = $this->db->get("ms_config");
      
      return $query->row();
  }
  
  function checkApiKey($apiKey, $id)
  {
      
      $this->db->where('api_key', $apiKey);
      $this->db->where('id', $id);
      
      $query = $this->db->get("ms_config");
      
      return $query->row();
  }
}
