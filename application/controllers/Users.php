<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()

    {
        parent::__construct();
        $this->load->model('M_users');
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

    public function index($offset = 0)
    {
        $data['title'] = 'MASTER USER';
        $data['content'] = 'users/index';
        $this->load->view('template/index', $data);
    }

    public function getIndex($rowno = 0)
    {
        $rowperpage = 10;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        $jml = $this->db->get('ms_user');

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
        $value['data'] = $this->M_users->getData($rowperpage, $rowno);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {
                $item[$i]['id']  = encodedata($value['data'][$i]->id);
                $item[$i]['name']           = $value['data'][$i]->name;
                $item[$i]['email']          = $value['data'][$i]->email;
                $item[$i]['role']           = $value['data'][$i]->role;
                $item[$i]['status']         = $value['data'][$i]->status;

                $data_record = $item;
            }
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['role'] = $this->session->userdata('role');
        $data['url'] = base_url() . 'Users/getIndex/';
        $data['params'] = '';
        echo json_encode($data);
    }

    public function filterUsers($rowno = 0)
    {
        $rowperpage = 10;
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }
        $value_filter = $this->input->get('value');
        $param = $this->input->get('param');
        $params = '';
        if ($param == 1) {
            $params = 'name';
        } else if ($param == 2) {
            $params = 'role';
        } else if ($param == 3) {
            $params = 'email';
        } else {
            $params = '';
        }

        $this->db->select('ms_user.*, ms_role.role');
        $this->db->from('ms_user');
        $this->db->join('ms_role','ms_user.role_id = ms_role.id');
        $this->db->like($params, $value_filter);

        $jml = $this->db->get();
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
        $value['data'] = $this->M_users->filterModel($rowperpage, $rowno, $params, $value_filter);
        $data_record = array();
        if (count($value['data']) > 0) {
            for ($i = 0; $i < count($value['data']); $i++) {
                $item[$i]['id']             = encodedata($value['data'][$i]->id);
                $item[$i]['name']           = $value['data'][$i]->name;
                $item[$i]['email']   = $value['data'][$i]->email;
                $item[$i]['role']           = $value['data'][$i]->role;
                $item[$i]['status']         = $value['data'][$i]->status;
                $data_record = $item;
            }
        }
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $data_record;
        $data['row'] = $rowno;
        $data['role'] = $this->session->userdata('role');
        $data['url'] = base_url() . 'Users/filterUsers/';
        $data['params'] = "value=" . $value_filter . "&param=" . $param;
        echo json_encode($data);
    }

    public function addUsers()
    {
        $role = $this->db->get('ms_role')->result();
        $warehouses = $this->db->get('c_warehouse')->result();
        $data['role'] = $role;
        $data['warehouses'] = $warehouses;
        $data['content'] = 'users/add';
        $this->load->view('template/index', $data);
    }

    public function getEdit()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $role = $this->db->get('ms_role')->result();
        $data['role'] = $role;
        $data['data'] = $this->M_users->getEditData($id);
        $data['content'] = 'users/edit';
        $this->load->view('template/index', $data);
    }

    public function changePassword()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        $data['data'] = $this->M_users->getEditData($id);
        $data['content'] = 'users/edit_password';
        $this->load->view('template/index', $data);
    }

    function addData()
    {
        $this->db->where('email', $this->input->post('email'));
        $user = $this->db->get('ms_user')->result();
        $cek_user = count($user);

        if ($cek_user > 0) {
            $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Sorry!</strong> Email sudah digunakan.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
        } else {
            $data = array(
                'name'          => $this->input->post('name'),
                'email'         => $this->input->post('email'),
                'role_id'       => $this->input->post('role_name'),
                'warehouse_id'  => $this->input->post('warehouse_id'),
                'password'      => md5($this->input->post('password')),
                'status'        => '1',
                'create_user'   => $this->session->userdata('userid'),
            );
            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Success!</strong> Add data succeed.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);
            $id = $this->M_users->postAddUser($data);

            $audit = [
                'user_id' => $this->session->userdata('userid'),
                'message' => 'Add new User, Detail [name : ' . $this->input->post('name') . ', email: '. $this->input->post('email') .', id : '.encodedata($id).' ]',
                'create_date' => date('Y-m-d H:i:s')
            ];

            $this->M_audit_trail->insertAuditTrail($audit);

        }
        redirect('Users');
    }

    function updateData()
    {
        $datas = array(
            'role_id'           => $this->input->post('role_name'),
            'email'             => $this->input->post('email'),
            'name'              => $this->input->post('name')
        );
        if ($datas != null) {
            $this->db->where('email', $this->input->post('email'));
            $this->db->where('id !=', $this->input->post('id'));
            $user = $this->db->get('ms_user')->result();
            $cek_user = count($user);
            if ($cek_user > 0) {
                $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">
                                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                        <p><strong>Sorry!</strong> Email sudah digunakan.</p>
                                    </div>';
                $this->session->set_flashdata('notice', $alert);

                redirect('Users');
            } else {
                $userDetail = $this->M_users->getEditData($this->input->post('id'));
                $alert = '
                    <div class="alert alert-success alert-success-style1 alert-st-bg">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                            <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                       <p><strong>Success!</strong> Update data succeed.</p>
                    </div>';
                $this->session->set_flashdata('notice', $alert);
                $this->M_users->postUpdateUser($datas, $this->input->post('id'));

                $audit = [
                    'user_id' => $this->session->userdata('userid'),
                    'message' => 'Edit User, Detail [name : ' . $userDetail->name . ', email: '. $userDetail->email .', id : '.encodedata($userDetail->id).' ]',
                    'create_date' => date('Y-m-d H:i:s')
                ];

                $this->M_audit_trail->insertAuditTrail($audit);

                redirect('Users');
            }
        } else {
            $alert = '
                <div class="alert alert-danger alert-success-style1 alert-st-bg">
                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                    </button>
                    <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                   <p><strong>Danger!</strong> Update data failed.</p>
                </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Users');
        }
    }

    function updatePassword()
    {
        $datas = array(
            'password'      => md5($this->input->post('password')),
        );
        $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                           <p><strong>Success!</strong> Update data succeed.</p>
                                    </div>';
        $this->session->set_flashdata('notice', $alert);
        $this->M_users->postUpdateUser($datas, $this->input->post('id'));

        $userDetail = $this->M_users->getEditData($this->input->post('id'));
        $audit = [
            'user_id' => $this->session->userdata('userid'),
            'message' => 'Edit User, Detail [name : ' . $userDetail->name . ', email: '. $userDetail->email .', id : '.encodedata($userDetail->id).' ]',
            'create_date' => date('Y-m-d H:i:s')
        ];

        $this->M_audit_trail->insertAuditTrail($audit);
        redirect('Users');
    }

    function changeStatusAktif()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        if ($id != "") {
            $this->db->set('status', '1');
            $this->db->where('id', $id);
            $this->db->update('ms_user');
            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                                </button>
                                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                               <p><strong>Success!</strong> Update Status : Aktif.</p>
                                        </div>';
            $this->session->set_flashdata('notice', $alert);

            $userDetail = $this->M_users->getEditData($id);
            $audit = [
                'user_id' => $this->session->userdata('userid'),
                'message' => 'Update Status User Aktif, Detail [name : ' . $userDetail->name . ', email: '. $userDetail->email .', id : '.encodedata($userDetail->id).' ]',
                'create_date' => date('Y-m-d H:i:s')
            ];

            $this->M_audit_trail->insertAuditTrail($audit);
            redirect('Users');
        } else {
            $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                           <p><strong>Danger!</strong> Update Status : Aktif Fail.</p>
                    </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Users');
        }
    }

    function changeStatusNonAktif()
    {
        $decode = $this->input->get('id');
        $id = decodedata(str_replace(' ', '+', $decode));
        if ($id != "") {
            $this->db->set('status', '0');
            $this->db->where('id', $id);
            $this->db->update('ms_user');
            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                                </button>
                                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                               <p><strong>Success!</strong> Update Status : Non Aktif.</p>
                                        </div>';
            $this->session->set_flashdata('notice', $alert);

            $userDetail = $this->M_users->getEditData($id);
            $audit = [
                'user_id' => $this->session->userdata('userid'),
                'message' => 'Update Status User Nonaktif, Detail [ name : ' . $userDetail->name . ', email: '. $userDetail->email .',  id : '.encodedata($userDetail->id).' ]',
                'create_date' => date('Y-m-d H:i:s')
            ];

            $this->M_audit_trail->insertAuditTrail($audit);
            redirect('Users');
        } else {
            $alert = '<div class="alert alert-danger alert-success-style1 alert-st-bg">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                           <p><strong>Danger!</strong> Update Status : Aktif Fail.</p>
                    </div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Users');
        }
    }
}
