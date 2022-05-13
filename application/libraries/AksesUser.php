<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AksesUser {
	public function __construct($params=NULL)
	{
		$this->CI =& get_instance();
        $this->mod = $params['module'];
	}
	public function cek_akses($param)
	{
		$role = $param.'_access';
		return $this->access($this->mod,$role);
	}

	public function access($module='', $role='')
	{
        $get_module_id = $this->CI->db->where('module_link',$module)->get('ms_module')->row_array();
        $get_role = $this->CI->db
            ->where('role_id', $this->CI->session->userdata('role'))
            ->where('module_id', $get_module_id['id'])
            ->get('ms_module_link')
            ->row_array();
        if ($get_role[$role]==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
	}
}