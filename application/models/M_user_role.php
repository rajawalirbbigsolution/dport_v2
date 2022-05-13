<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user_role extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getData($num, $offset)
  {
    $this->db->where('status');
    $query = $this->db->get("ms_role", $num, $offset);
    return $query->result();
  }

  function filterModel($value,$params,$num,$offset)
  {
  	$this->db->like($params,$value);
  	$query = $this->db->get("ms_role", $num, $offset);
  	return $query->result();
  }

}