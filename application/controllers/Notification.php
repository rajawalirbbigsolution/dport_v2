<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends MY_Controller
{
	public function __construct()

	{
		parent::__construct();
		
		$this->load->model('M_notif');
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

	// public function index($offset = 0)
	// {
	// 	$data['title'] = 'NOTIFIKASI';
	// 	$data['content'] = 'notif/index';
	// 	$this->load->view('template/index', $data);
	// }

	public function index($offset = 0)
	{
		$data['title'] = 'NOTIFIKASI';
		$data['page'] = 'min';
		$data['content'] = 'notif/template';
		// $data['record2'] = $this->M_stock_transfer->cari12();
		$this->load->view('template/index', $data);
	}

	public function safeNotif($offset = 0)
    {
        $data['title'] = 'STORAGE';
        $data['page'] = 'safe';
        $data['content'] = 'notif/template';
        $this->load->view('template/index', $data);
    }

    public function maxNotif($offset = 0)
    {
        $data['title'] = 'STORAGE';
        $data['page'] = 'max';
        $data['content'] = 'notif/template';
        $this->load->view('template/index', $data);
    }

	public function outletNotif($offset = 0)
    {
        $data['title'] = 'STORAGE';
        $data['page'] = 'outlet';
        $data['content'] = 'notif/template';
        $this->load->view('template/index', $data);
    }

	public function expNotif($offset = 0)
    {
        $data['title'] = 'STORAGE';
        $data['page'] = 'exp';
        $data['content'] = 'notif/template';
        $this->load->view('template/index', $data);
    }

	public function getIndex($rowno = 0)
	{
		$rowperpage = 8;
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $rowperpage;
		}

		// $jml = $this->db->get('view_report_selisih_lmd');

		$config['use_page_numbers']     = TRUE;
		$config['total_rows']           = $this->M_notif->getCountData();
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

		$value['data'] = $this->M_notif->getData($rowperpage, $rowno);
		$data_record = array();
		if (count($value['data']) > 0) {
			for ($i = 0; $i < count($value['data']); $i++) {
				$item[$i]['id'] = encodedata($value['data'][$i]->id);
                $item[$i]['number'] = $value['data'][$i]->number;
                $item[$i]['warehouse'] = $value['data'][$i]->warehouse;
                $item[$i]['rt_date'] = $value['data'][$i]->rt_date;
                $item[$i]['status_transfer'] = $value['data'][$i]->status_transfer;
                $item[$i]['rt_dateline'] = $value['data'][$i]->rt_dateline;
                $item[$i]['exp_date'] = $value['data'][$i]->exp_date;
                $data_record = $item;;
			}
		}

		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $data_record;
		$data['row'] = $rowno;
		$data['role'] = $this->session->userdata('role');
		$data['module'] = $this->session->userdata('module');
		$data['url'] = base_url() . 'Notification/getIndex/';
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

	public function kirimUlang()
	{
		$id = $this->input->get('id');
		$update = $this->M_notif->updateDataNotif($id);
		if ($update) {
			$alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
											<button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
												<span class="icon-sc-cl" aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
										   <p><strong>Success!</strong> Send Data successfuly.</p>
									</div>';
			$this->session->set_flashdata('notice', $alert);
			redirect('Notification');
		} else {
			$alert = '<div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3">
										<button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
											<span class="icon-sc-cl" aria-hidden="true">&times;</span>
										</button>
										<i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3" aria-hidden="true"></i>
										<p><strong>Danger!</strong> Send data failed.</p>
								 </div>';
			$this->session->set_flashdata('notice', $alert);
			redirect('Notification');
		}
	}


	public function getMin($rowno = 0)
	{
		$rowperpage = 8;
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $rowperpage;
		}
		$sql = "SELECT aa.*,bb.min_stock,bb.product_h_name,bb.sku_number from (
			select tis.product_d_id,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name 
					from tr_inv_storage tis 
					join d_location dl on tis.location_id = dl.location_id 
					group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
				join	
			(select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock from d_product_d dpd
				join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
			where aa.stock <= bb.min_stock";
		$jml = $this->db->query($sql);

		$config['use_page_numbers']     = TRUE;
		$config['total_rows']           = $jml->num_rows();
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

		$value['data'] = $this->M_notif->getDataStockMin($rowperpage, $rowno);
		$data_record = array();
		if (count($value['data']) > 0) {
			for ($i = 0; $i < count($value['data']); $i++) {
				 $item[$i]['product_d_id']  			= $value['data'][$i]->product_d_id;
                $item[$i]['stock']  	= $value['data'][$i]->stock;
                $item[$i]['location_name']  	= $value['data'][$i]->location_name;
                $item[$i]['product_h_name']  	= $value['data'][$i]->product_h_name;
                $item[$i]['sku_number']    = $value['data'][$i]->sku_number;
                $item[$i]['min_stock'] 	= $value['data'][$i]->min_stock;
				$data_record = $item;
			}
		}

		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $data_record;
		$data['row'] = $rowno;
		$data['role'] = $this->session->userdata('role');
		$data['module'] = $this->session->userdata('module');
		$data['url'] = base_url() . 'Notification/getMin/';
		$data['params'] = '';
		echo json_encode($data);
	}

	public function getSafe($rowno = 0)
	{
		$rowperpage = 8;
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $rowperpage;
		}
		$sql = "SELECT aa.*,bb.safety_stock,bb.product_h_name,bb.sku_number from (
			select tis.product_d_id,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name 
					from tr_inv_storage tis 
					join d_location dl on tis.location_id = dl.location_id 
					group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
				join	
			(select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock from d_product_d dpd
				join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
			where aa.stock >= bb.min_stock and aa.stock <= bb.safety_stock";
		$jml = $this->db->query($sql);

		$config['use_page_numbers']     = TRUE;
		$config['total_rows']           = $jml->num_rows();
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

		$value['data'] = $this->M_notif->getDataStockSafe($rowperpage, $rowno);
		$data_record = array();
		if (count($value['data']) > 0) {
			for ($i = 0; $i < count($value['data']); $i++) {
				 $item[$i]['product_d_id']  			= $value['data'][$i]->product_d_id;
                $item[$i]['stock']  	= $value['data'][$i]->stock;
                $item[$i]['location_name']  	= $value['data'][$i]->location_name;
                $item[$i]['product_h_name']  	= $value['data'][$i]->product_h_name;
                $item[$i]['sku_number']    = $value['data'][$i]->sku_number;
                $item[$i]['safety_stock'] 	= $value['data'][$i]->safety_stock;
				$data_record = $item;
			}
		}

		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $data_record;
		$data['row'] = $rowno;
		$data['role'] = $this->session->userdata('role');
		$data['module'] = $this->session->userdata('module');
		$data['url'] = base_url() . 'getMax/';
		$data['params'] = '';
		echo json_encode($data);
	}

	public function getMax($rowno = 0)
	{
		$rowperpage = 8;
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $rowperpage;
		}
		$sql = "SELECT aa.*,bb.max_stock,bb.product_h_name,bb.sku_number from (
			select tis.product_d_id,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name 
					from tr_inv_storage tis 
					join d_location dl on tis.location_id = dl.location_id 
					group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
				join	
			(select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock,dpd.max_stock from d_product_d dpd
				join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
			where aa.stock >= bb.max_stock ";
		$jml = $this->db->query($sql);

		$config['use_page_numbers']     = TRUE;
		$config['total_rows']           = $jml->num_rows();
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

		$value['data'] = $this->M_notif->getDataStockMax($rowperpage, $rowno);
		$data_record = array();
		if (count($value['data']) > 0) {
			for ($i = 0; $i < count($value['data']); $i++) {
				 $item[$i]['product_d_id']  			= $value['data'][$i]->product_d_id;
                $item[$i]['stock']  	= $value['data'][$i]->stock;
                $item[$i]['location_name']  	= $value['data'][$i]->location_name;
                $item[$i]['product_h_name']  	= $value['data'][$i]->product_h_name;
                $item[$i]['sku_number']    = $value['data'][$i]->sku_number;
                $item[$i]['max_stock'] 	= $value['data'][$i]->max_stock;
				$data_record = $item;
			}
		}

		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $data_record;
		$data['row'] = $rowno;
		$data['role'] = $this->session->userdata('role');
		$data['module'] = $this->session->userdata('module');
		$data['url'] = base_url() . 'getMax/';
		$data['params'] = '';
		echo json_encode($data);
	}

	public function getExp($rowno = 0)
	{
		$rowperpage = 8;
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $rowperpage;
		}
		$sql = "SELECT aa.*,bb.max_stock,bb.product_h_name,bb.sku_number from (
			select tis.product_d_id,tis.inv_storage_exp_date,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name 
					from tr_inv_storage tis 
					join d_location dl on tis.location_id = dl.location_id 
					group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
				join	
			(select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock,dpd.max_stock from d_product_d dpd
				join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
			where aa.inv_storage_exp_date <= CURDATE()  ";
		$jml = $this->db->query($sql);

		$config['use_page_numbers']     = TRUE;
		$config['total_rows']           = $jml->num_rows();
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

		$value['data'] = $this->M_notif->getDataStockExp($rowperpage, $rowno);
		$data_record = array();
		if (count($value['data']) > 0) {
			for ($i = 0; $i < count($value['data']); $i++) {
				 $item[$i]['product_d_id']  			= $value['data'][$i]->product_d_id;
                $item[$i]['stock']  	= $value['data'][$i]->stock;
                $item[$i]['location_name']  	= $value['data'][$i]->location_name;
                $item[$i]['product_h_name']  	= $value['data'][$i]->product_h_name;
                $item[$i]['sku_number']    = $value['data'][$i]->sku_number;
                $item[$i]['max_stock'] 	= $value['data'][$i]->max_stock;
				$data_record = $item;
			}
		}

		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $data_record;
		$data['row'] = $rowno;
		$data['role'] = $this->session->userdata('role');
		$data['module'] = $this->session->userdata('module');
		$data['url'] = base_url() . 'getExp/';
		$data['params'] = '';
		echo json_encode($data);
	}

	public function getTotalNotif()
	{
		$total = $this->M_notif->getTotalNotifModel();
		echo json_encode($total);
	}

	public function listWebNotif()
	{
		$data = $this->M_notif->listWebNotifModel();
		echo json_encode($data);
	}



}
