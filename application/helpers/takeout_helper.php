<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('role')) {
        redirect('Login');
    } else {
        $role_id = $ci->session->userdata('role');
        $menu = $ci->uri->segment(1);
        if($menu == "marketplace"){
            $menu = $ci->uri->segment(1).'/'.$ci->uri->segment(2);;
        }
        $roleId = $ci->db->get_where('ms_role', ['id' => $role_id])->row_array();
        $role_id_new = $roleId['id'];

        $queryMenu = $ci->db->get_where('ms_module', ['module_link' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('ms_module_link', [
            'role_id' => $role_id_new,
            'module_id' => $menu_id,
            'status' => 1
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('Blocked');
        }
    }
}
function cek_akses($mod,$param)
{    
    $ci = get_instance();
    $akses_type = $param.'_access';
    $get_module_id = $ci->db->where('module_link',$mod)->get('ms_module')->row_array();
    $get_role = $ci->db
        ->where('role_id', $ci->session->userdata('role'))
        ->where('module_id', $get_module_id['id'])
        ->get('ms_module_link')
        ->row_array();
    if ($get_role[$akses_type]==1)
    {
        return TRUE;
    }
    else
    {
        redirect('AccessDenied/Error_403');
    }
}




