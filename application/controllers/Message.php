<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Message extends MY_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_message');
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

    public function index()
    {
        $data['title'] = 'MESSAGES STATION';
        $data['content'] = 'message/index';
        $this->load->view('template/index', $data);
    }

    public function getIndex($rowno = 0)
    {
        $rowperpage = 10;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        $m_message = new M_message();

        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $m_message->getCountData();
        $config['per_page'] = $rowperpage;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = "<ul class='pagination text-center justify-content-center'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);
        $value['data'] = $m_message->getData($rowperpage, $rowno);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {

                $date = date('d-F-Y', strtotime($value['data'][$i]->date_transaction));

                $replaceMonth = [
                    'Januari'   => 'January',
                    'Februari'  => 'February',
                    'Maret' => 'March',
                    'Mei'   => 'May',
                    'Juni'  => 'June',
                    'Juli'  => 'July',
                    'Agustus'   => 'August',
                    'Oktober'   => 'October',
                    'Desember'  => 'December'
                ];

                $dateEdit = "";

                foreach ($replaceMonth as $monthKey => $month) {
                    $dateBeforeEdit = explode("-", $date);
                    if($dateBeforeEdit[1] && $dateBeforeEdit[1] == $month){
                        $dateBeforeEdit[1] = $monthKey;
                        $dateEdit = implode(' ', $dateBeforeEdit);
                    }
                }

                $item[$i]['id'] = encodedata($value['data'][$i]->id);
                $item[$i]['nik'] = $value['data'][$i]->nik;
                $item[$i]['nama'] = $value['data'][$i]->nama;
                $item[$i]['time_transaction'] = $value['data'][$i]->time_transaction;
                $item[$i]['date_transaction'] = $dateEdit;
                $item[$i]['no_handphone'] = $value['data'][$i]->no_handphone;
                $item[$i]['is_send'] = $value['data'][$i]->is_send;
                $item[$i]['status'] = $value['data'][$i]->status;
//                $item[$i]['nama'] = $value['data'][$i]->nama;
//                $item[$i]['nama'] = $value['data'][$i]->nama;
//                $item[$i]['count_queue'] = $this->M_schedule->getCountQueue($value['data'][$i]->id);

                $data_record = $item;
            }
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['count'] = $config['total_rows'];
        $data['page'] = (int)$rowno;
        $data['last_page'] = floor((int)$data['count'] / (int)$rowperpage);
        $data['data_per_page'] = (int)$rowperpage;
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['role'] = $this->session->userdata('role');
        $data['url'] = base_url() . 'Message/getIndex/';
        $data['params'] = '';

        echo json_encode($data);
    }

    public function filterMessage($rowno = 0)
    {
        $rowperpage = 10;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        $m_message = new M_message();

        $value_filter = [
            'mz.provinsi' => isset($_GET['provinsi']) && $this->input->get('provinsi') != "" ? $this->input->get('provinsi') : "",
            'mz.kabupaten' => isset($_GET['kabupaten']) && $this->input->get('kabupaten') != "" ? $this->input->get('kabupaten') : "",
            'mz.kecamatan' => isset($_GET['kecamatan']) && $this->input->get('kecamatan') != "" ? $this->input->get('kecamatan') : "",
            'mz.kelurahan' => isset($_GET['kelurahan']) && $this->input->get('kelurahan') != "" ? $this->input->get('kelurahan') : "",
            'ts.drop_point_id' => isset($_GET['drop_point']) && $this->input->get('drop_point') != "" ? $this->input->get('drop_point') : "",
        ];

        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $m_message->getCountFilterData();
        $config['per_page'] = $rowperpage;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = "<ul class='pagination text-center justify-content-center'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);

        $value['data'] = $m_message->getFilterData($rowperpage, $rowno, $value_filter);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {

                $date = date('d-F-Y', strtotime($value['data'][$i]->date_transaction));

                $replaceMonth = [
                    'Januari'   => 'January',
                    'Februari'  => 'February',
                    'Maret' => 'March',
                    'Mei'   => 'May',
                    'Juni'  => 'June',
                    'Juli'  => 'July',
                    'Agustus'   => 'August',
                    'Oktober'   => 'October',
                    'Desember'  => 'December'
                ];

                $dateEdit = "";

                foreach ($replaceMonth as $monthKey => $month) {
                    $dateBeforeEdit = explode("-", $date);
                    if($dateBeforeEdit[1] && $dateBeforeEdit[1] == $month){
                        $dateBeforeEdit[1] = $monthKey;
                        $dateEdit = implode(' ', $dateBeforeEdit);
                    }
                }

                $item[$i]['id'] = encodedata($value['data'][$i]->id);
                $item[$i]['nik'] = $value['data'][$i]->nik;
                $item[$i]['nama'] = $value['data'][$i]->nama;
                $item[$i]['time_transaction'] = $value['data'][$i]->time_transaction;
                $item[$i]['date_transaction'] = $dateEdit;
                $item[$i]['no_handphone'] = $value['data'][$i]->no_handphone;;
                $item[$i]['is_send'] = $value['data'][$i]->is_send;
                $item[$i]['status'] = $value['data'][$i]->status;

                $data_record = $item;
            }
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['count'] = $config['total_rows'];
        $data['page'] = (int)$rowno;
        $data['last_page'] = floor((int)$data['count'] / (int)$rowperpage);
        $data['data_per_page'] = (int)$rowperpage;
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['role'] = $this->session->userdata('role');
        $data['url'] = base_url() . 'Message/filterMessage/';
        $data['params'] = "";
        if($value_filter['mz.provinsi'] != ""){
            $data['params'] .= "provinsi=".$value_filter['mz.provinsi'];
            if($value_filter['mz.kabupaten'] != "" && $value_filter['mz.kecamatan'] != "" && $value_filter['mz.kelurahan'] != "" ){
                $data['params'] .= "&";
            }
        }
        if($value_filter['mz.kabupaten'] != ""){
            $data['params'] .= "kabupaten=".$value_filter['mz.kabupaten'];
            if($value_filter['mz.kecamatan'] != "" && $value_filter['mz.kelurahan'] != "" ){
                $data['params'] .= "&";
            }
        }
        if($value_filter['mz.kecamatan'] != ""){
            $data['params'] .= "kecamatan=".$value_filter['mz.kecamatan'];
            if($value_filter['mz.kelurahan'] != "" ){
                $data['params'] .= "&";
            }
        }
        if($value_filter['mz.kelurahan'] != ""){
            $data['params'] .= "kelurahan=".$value_filter['mz.kelurahan'];
        }
        if($value_filter['ts.drop_point_id'] != ""){
            $data['params'] = "drop_point=".$value_filter['ts.drop_point_id'];
        }
        echo json_encode($data);
    }

    public function add()
    {
        $data['title'] = 'DISTRIBUTION SCHEDULE';
        $data['content'] = 'schedule/add';
        $this->load->view('template/index', $data);
    }

    public function edit()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $data['data_edit'] = $this->M_schedule->getDataEdit($id);
        $data['title'] = 'DISTRIBUTION SCHEDULE';
        $data['content'] = 'schedule/edit';

        $this->load->view('template/index', $data);
    }

    public function addData()
    {
        $this->form_validation->set_rules('drop_point_id', 'Drop Point ID', 'required');
        $this->form_validation->set_rules('date_transaction', 'Tanggal Penyaluran', 'required');
        $this->form_validation->set_rules('time_transaction', 'Waktu Penyaluran', 'required');

        if ($this->form_validation->run() == FALSE) {
            $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Sorry!</strong> Add Data Failed.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Schedule');
        } else {

            $replaceMonth = [
                'Januari'   => 'January',
                'Februari'  => 'February',
                'Maret' => 'March',
                'Mei'   => 'May',
                'Juni'  => 'June',
                'Juli'  => 'July',
                'Agustus'   => 'August',
                'Oktober'   => 'October',
                'Desember'  => 'December'
            ];

            $dateEdit = "";

            foreach ($replaceMonth as $monthKey => $month) {
                $date = explode(" ", $this->input->post('date_transaction'));
                if($date[1] && $date[1] == $monthKey){
                    $date[1] = $month;
                    $dateEdit = implode('-', $date);
                }
            }

            $dataSchedule = [
                'create_user' => $this->session->userdata('userid'),
                'created_date' => date('Y-m-d H:i:s'),
                'drop_point_id' => $this->input->post('drop_point_id'),
                'date_transaction' => date('Y-m-d', strtotime($dateEdit)),
                'time_transaction' => $this->input->post('time_transaction')
            ];

            $this->M_schedule->postAddSchedule($dataSchedule);

            $namaDropPoint = $this->M_schedule->getDropPointName($this->input->post('drop_point_id'));

            $data_audit = [
                'user_id' => $this->session->userdata('userid'),
                'message' => 'Edit Data Schedule, Detail [Nama Drop Point : '.$namaDropPoint. ', Tanggal Penyaluran : ' . $this->input->post('date_transaction')  . ' , Jam Penyaluran : '. $this->input->post('time_transaction') .' ]',
                'create_date' => date('Y-m-d H:i:s')
            ];

            $this->M_audit_trail->insertAuditTrail($data_audit);

            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Success!</strong> Add data succeed.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Schedule');
        }

    }

    public function editData()
    {
        $this->form_validation->set_rules('schedule_id', 'Schedule ID', 'required');
        $this->form_validation->set_rules('drop_point_id', 'Drop Point ID', 'required');
        $this->form_validation->set_rules('date_transaction', 'Tanggal Penyaluran', 'required');
        $this->form_validation->set_rules('time_transaction', 'Waktu Penyaluran', 'required');

        if ($this->form_validation->run() == FALSE) {

            $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Sorry!</strong> Edit Data Failed.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Schedule');
        } else {

            $id = $this->input->post('schedule_id');

            $replaceMonth = [
                'Januari'   => 'January',
                'Februari'  => 'February',
                'Maret' => 'March',
                'Mei'   => 'May',
                'Juni'  => 'June',
                'Juli'  => 'July',
                'Agustus'   => 'August',
                'Oktober'   => 'October',
                'Desember'  => 'December'
            ];

            $dateEdit = "";

            foreach ($replaceMonth as $monthKey => $month) {
                $date = explode(" ", $this->input->post('date_transaction'));
                if($date[1] && $date[1] == $monthKey){
                    $date[1] = $month;
                    $dateEdit = implode('-', $date);
                }
            }

            $dataSchedule = [
                'update_user' => $this->session->userdata('userid'),
                'updated_date' => date('Y-m-d H:i:s'),
                'drop_point_id' => $this->input->post('drop_point_id'),
                'date_transaction' => date('Y-m-d', strtotime($dateEdit)),
                'time_transaction' => $this->input->post('time_transaction')
            ];

            $this->M_schedule->postEditSchedule($dataSchedule, $id);

            $namaDropPoint = $this->M_schedule->getDropPointName($this->input->post('drop_point_id'));


            $data_audit = [
                'user_id' => $this->session->userdata('userid'),
                'message' => 'Edit Data Schedule, Detail [Nama Drop Point : '.$namaDropPoint. ', Tanggal Penyaluran : ' . $this->input->post('date_transaction') . ' , Jam Penyaluran : '. $this->input->post('time_transaction') .' ]',
                'create_date' => date('Y-m-d H:i:s')
            ];

            $this->M_audit_trail->insertAuditTrail($data_audit);

            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Success!</strong> Edit data succeed.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Schedule');
        }

    }

    public function deleteData()
    {
        $this->form_validation->set_rules('delete_id', 'Schedule ID', 'required');

        if ($this->form_validation->run() == FALSE) {

            $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Sorry!</strong> Edit Data Failed.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Schedule');
        } else {

            $decode = $this->input->post('delete_id');
            $id = decodedata(str_replace(' ', '+', $decode));

            $detailSchedule = $this->M_schedule->getDataEdit($id);
            $dataSchedule = [
                'update_user' => $this->session->userdata('userid'),
                'updated_date' => date('Y-m-d H:i:s'),
                'status' => 0
            ];

            $this->M_schedule->postEditSchedule($dataSchedule, $id);

            $namaDropPoint = $this->M_schedule->getDropPointName($detailSchedule->drop_point_id);

            $dateData = date('d-F-Y', strtotime($detailSchedule->date_transaction));
            $replaceMonth = [
                'Januari'   => 'January',
                'Februari'  => 'February',
                'Maret' => 'March',
                'Mei'   => 'May',
                'Juni'  => 'June',
                'Juli'  => 'July',
                'Agustus'   => 'August',
                'Oktober'   => 'October',
                'Desember'  => 'December'
            ];
            $dateEdit = "";
            foreach ($replaceMonth as $monthKey => $month) {
                $date = explode("-", $dateData);
                if($date[1] && $date[1] == $month){
                    $date[1] = $monthKey;
                    $dateEdit = implode(' ', $date);
                }
            }

            $data_audit = [
                'user_id' => $this->session->userdata('userid'),
                'message' => 'Delete Data Schedule, Detail [Nama Drop Point : '.$namaDropPoint. ', Tanggal Penyaluran : ' . $dateEdit . ' , Jam Penyaluran : '.$detailSchedule->time_transaction.' ]',
                'create_date' => date('Y-m-d H:i:s')
            ];

            $this->M_audit_trail->insertAuditTrail($data_audit);

            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Success!</strong> Edit data succeed.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Schedule');
        }

    }

    public function getDropPoint()
    {
        header('Content-Type: application/json');

        $filter = [
            'mz.provinsi' => $this->input->post('provinsi'),
            'mz.kabupaten' => $this->input->post('kabupaten'),
            'mz.kecamatan' => $this->input->post('kecamatan'),
            'mz.kelurahan' => $this->input->post('kelurahan'),
        ];

        foreach ($filter as $k => $v) {
            if ($v == "" || is_null($v)) {
                unset($filter[$k]);
            }
        }

        $data = $this->M_schedule->getDataDropPoint($filter);

        echo json_encode([
            'result' => $data
        ]);

        exit;

    }

}

