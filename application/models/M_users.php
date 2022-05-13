<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_users extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function getData($num, $offset)
	{
		$this->db->select('ms_user.*, ms_role.role');
		$this->db->join('ms_role','ms_user.role_id = ms_role.id');
		$this->db->order_by('role_id','ASC');
		$query = $this->db->get("ms_user", $num, $offset);
		return $query->result();
	}

	function getEditData($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get("ms_user");
		return $query->row();
	}

	function deleteUser($id)
	{
		$this->db->set('status','0');
		$this->db->delete('ms_user');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function postAddUser($data)
	{
		$this->db->insert('ms_user', $data);
		return $this->db->insert_id();
	}

	function postUpdateUser($datas, $id)
	{
		$this->db->set($datas);
		$this->db->where('id', $id);
		$this->db->update('ms_user');
		return $this->db->affected_rows();
	}

	function filterModel($num, $offset, $params, $value_filter)
    {
		$this->db->select('ms_user.*, ms_role.role');
		$this->db->join('ms_role','ms_user.role_id = ms_role.id');    	
        $this->db->like($params, $value_filter);
        $query = $this->db->get("ms_user", $num, $offset);
        return $query->result();
    }
	

}

