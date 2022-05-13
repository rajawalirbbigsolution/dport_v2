<?php

	defined('BASEPATH') or exit('No direct script access allowed');

	class Audit extends MY_Controller
	{
		public function __construct()

		{
			parent::__construct();
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
			if (!$this->session->userdata('userid')) {
				redirect(base_url('login'));
				exit;
			}
		}

		public function index($offset = 0)
		{
			$data['title'] = 'AUDIT TRAIL';
			$data['content'] = 'audit/index';
			$this->load->view('template/index', $data);
		}

		public function getIndex($rowno = 0)
		{
		    $params = [
                'mu.name' => isset($_GET['user']) && $this->input->get('user') != "" ? $this->input->get('user') : "",
                'at.message' => isset($_GET['keterangan']) && $this->input->get('keterangan') != "" ? $this->input->get('keterangan') : "",
            ];

		    foreach ($params as $param => $v_param){
		        if ($v_param == ""){
		            unset($params[$param]);
                }
            }

			$rowperpage = 10;
				if ($rowno != 0) {
					$rowno = ($rowno - 1) * $rowperpage;
				}
			
			$config['use_page_numbers']     = TRUE;
			$config['total_rows']           = $this->M_audit_trail->getDataCount($params);
			$config['per_page']             = $rowperpage;
			$config['first_link']           = 'First';
			$config['last_link']            = 'Last';
			$config['next_link']            = 'Next';
			$config['prev_link']            = 'Prev';
			$config['full_tag_open']        = "<ul class='pagination text-center justify-content-center'>";
			$config['full_tag_close']       = "</ul>";
			$config['num_tag_open']         = '<li>';
			$config['num_tag_close']        = '</li>';
			$config['cur_tag_open']         = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close']        = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open']        = "<li>";
			$config['next_tagl_close']      = "</li>";
			$config['prev_tag_open']        = "<li>";
			$config['prev_tagl_close']      = "</li>";
			$config['first_tag_open']       = "<li>";
			$config['first_tagl_close']     = "</li>";
			$config['last_tag_open']        = "<li>";
			$config['last_tagl_close']      = "</li>";
			$this->pagination->initialize($config);

			$value['data'] = $this->M_audit_trail->getData($params, $rowperpage, $rowno);
			$data_record = array();
			if (count($value['data']) > 0) {
			    for ($i = 0; $i < count($value['data']); $i++) {
//                    $user = $this->M_audit_trail->checkUser($value['data'][$i]->user_id);
			        $item[$i]['id']           		= $value['data'][$i]->id;
					$item[$i]['user_id']      	= $value['data'][$i]->user_id;
					$item[$i]['name']    		= $value['data'][$i]->name;
                    $item[$i]['message']    			= $value['data'][$i]->message;
                    $item[$i]['create_date']    			= $value['data'][$i]->create_date;
					$data_record = $item;
				}
			}

			$data['pagination'] = $this->pagination->create_links();
			$data['result'] = $data_record;
			$data['row'] = $rowno;
			$data['role'] = $this->session->userdata('role');
			$data['module'] = $this->session->userdata('module');
			$data['url'] = base_url() . 'Audit/getIndex/';
			$data['params'] = '';
			echo json_encode($data);
		}


		public function notificationWeb()
		{
			$count = $this->M_audit_trail->countNotifikasiWeb();
			$data = count($count);
			echo json_encode($data);
		}

		public function listNotificationWeb()
		{
			$count = $this->M_audit_trail->listNotifikasiWebModel();
			$data = $count;
			echo json_encode($data);
		}

		public function listNotificationWeb1222()
		{
			$count = $this->M_audit_trail->listNotifikasiWebModel();
			$data = $count;
			echo json_encode($data);
		}


		


	}

