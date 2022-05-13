<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('M_customer');
        $this->load->model('M_sales_order');
        $this->load->model('M_delivery_order');
        $this->load->model('M_audit_trail');
        $this->load->helper('cookie');
        $this->load->helper('decodedata');
        $this->load->helper('encodedata');
        $this->load->library('session');
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('form', 'url'));
        $this->load->helper('access');
        is_logged_in();
	}	

	public function index()
	{
		$id = $this->session->userdata('userid');
        $this->db->select('name');
        $this->db->where('id', $id);
        $nama_user = $this->db->get('ms_user')->row();

		if ($nama_user != null) {
            $data['title'] = 'Dashboard';
			$data['content'] = 'dashboard/dashboard';
			$data['user'] = $nama_user;
			$data['dashboard'] = 1;
			$this->load->view('template/index', $data);
		} else {
            $this->load->view('404/404');
        }


	}

	
}
