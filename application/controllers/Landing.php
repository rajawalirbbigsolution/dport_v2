<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends MY_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('M_landing');
    }

    public function index()
    {
        $id = $this->session->userdata('userid');
        $this->db->select('name');
        $this->db->where('id', $id);
        $nama_user = $this->db->get('ms_user')->row();

        if ($nama_user != null) {
            $data['title'] = 'Landing Page';
            $data['content'] = 'landing/index';
            $data['user'] = $nama_user;
            $this->load->view('template/index', $data);
        } else {
            $this->load->view('404/404');
        }
    }
}
