<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AccessDenied extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $data['content'] = ('404/405');
        $this->load->view('template/index', $data);
    }

    public function Error_403()
    {
        $data['content'] = ('404/403');
        $this->load->view('template/index', $data);
    }
    
}
