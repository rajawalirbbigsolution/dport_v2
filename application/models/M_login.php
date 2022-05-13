<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function getUser($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('ms_user');
        return $query->result();
    }

    function getMenu($user_id)
    {
        $this->db->select('name_menu');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('v_access');
        return $query->result();
    }

    function getModuleRole($role)
    {
        $condition = "role_id='" . $role . "' and status=1";
        $this->db->where($condition);
        $query = $this->db->get('ms_module_link');

        return $query->result();
    }

    function getRoleRedirect($role)
    {
        $this->db->where('role_name', $role);
        $query = $this->db->get('ms_role');

        return $query->result();
    }

    function getRole($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('v_access');
        return $query->result();
    }

    function getTimeForgetDateModel()
    {
        $sql = "SELECT DATE_ADD(NOW(), INTERVAL 5 MINUTE) as forget_date";
        $query = $this->db->query($sql);
        return $query->row();
    }

    function updateDateForgetUserModel($id, $datas)
    {
        $this->db->set($datas);
        $this->db->where('id', $id);
        $this->db->update('ms_user');
        return $this->db->affected_rows();
    }

    function checkUserForgotPassword($email, $forgot_code){
        $this->db->where('email', $email);
        $this->db->where('forget_code', $forgot_code);
        $query = $this->db->get('ms_user');
        return $query->row();
    }

    function postUpdateUser($datas, $id)
    {
        $this->db->set($datas);
        $this->db->where('id', $id);
        $this->db->update('ms_user');
        return $this->db->affected_rows();
    }
}
