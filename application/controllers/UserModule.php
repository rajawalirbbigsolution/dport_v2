 	<?php

		defined('BASEPATH') or exit('No direct script access allowed');

		class UserModule extends MY_Controller
		{
			public function __construct()

			{
				parent::__construct();
				$this->load->model('M_user_module');
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
			    $data['title'] = 'USER MODUL';
				$data['content'] = 'user-module/index';
				$this->load->view('template/index', $data);
			}

			public function getIndex($rowno = 0)
			{
				$rowperpage = 10;
				if ($rowno != 0) {
					$rowno = ($rowno - 1) * $rowperpage;
				}
				$this->db->where('status', 1);
				$jml = $this->db->get('ms_user_module');
				
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
				$value['data'] = $this->M_user_module->getData($rowperpage, $rowno);
				$data_record = array();
				if (count($value['data']) > 0) {
				    for ($i = 0; $i < count($value['data']); $i++) {
				        $role = $this->M_user_module->getRoleParam($value['data'][$i]->role_id);
				        $module = $this->M_user_module->getModuleParam($value['data'][$i]->module_id);
				        
				        
				        $item[$i]['id']           = encodedata($value['data'][$i]->id);
						$item[$i]['role_id']      = $value['data'][$i]->role_id;
						$item[$i]['role_name']    = $role->role_name;
						$item[$i]['module_id']    = $value['data'][$i]->module_id;
						$item[$i]['module_name']  = $value['data'][$i]->module_name;
						$item[$i]['module_url']   = $value['data'][$i]->module_url;
						$item[$i]['status']       = $value['data'][$i]->status;
						$item[$i]['create_user']  = $value['data'][$i]->create_user;
						$item[$i]['created_date'] = $value['data'][$i]->created_date;
						$item[$i]['update_user']  = $value['data'][$i]->update_user;
						$item[$i]['updated_date'] = $value['data'][$i]->updated_date;
						$data_record = $item;
					}
				}

				$data['pagination'] = $this->pagination->create_links();
				$data['result'] = $data_record;
				$data['row'] = $rowno;
				$data['role'] = $this->session->userdata('role');
				$data['module'] = $this->session->userdata('module');
				$data['url'] = base_url() . 'UserModule/getIndex/';
				$data['params'] = '';
				echo json_encode($data);
			}

			public function add()
			{
			
			    $data['roleID'] = $this->M_user_module->getRoleID();
			    $data['module'] = $this->M_user_module->getModule();
			    
			    $data['content'] = 'user-module/add';
				$this->load->view('template/index', $data);
				
				
			}

			public function edit()
			{
			    
			    $data['roleID'] = $this->M_user_module->getRoleID();
			    $data['module'] = $this->M_user_module->getModule();
			    
				$decode = $this->input->get('id');
				$id = decodedata(str_replace(' ', '+', $decode));
				$data['data'] = $this->M_user_module->getEditData($id);
				if ($data['data'] != null) {

					$data['content'] = 'user-module/edit';

					$this->load->view('template/index', $data);
				} else {

					$data['content'] = '404/404';

					$this->load->view('template/index', $data);
				}
			}

			public function add_data()
			{
				$this->form_validation->set_rules('role_id', 'role_id', 'required|callback_role_id');

				    $save = "";
				    $checkbox = $this->input->post('module_chk');
				    foreach($checkbox as $chk1)
				    {
				        $data = array(
				            'role_id' 			=> $this->input->post('role_id'),
				            'role_name'	    	=> $this->M_user_module->getRoleParam($this->input->post('role_id'))->role_name,
				            'module_id'			=> $chk1,
				            'module_name'		=> $this->M_user_module->getModuleParam($chk1)->module_name,
				            'module_url'		=> $this->M_user_module->getModuleParam($chk1)->module_url,
				            'status' 			=> 1,
				            'created_date'      => date('Y-m-d H:i:s'),
				            'create_user'       => $this->session->userdata('userid')
				        );
				        
				        $save = $this->M_user_module->postAdd($data);

				    }  
				    
				        if ($save != null) {

							$alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">

                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

            								    <span class="icon-sc-cl" aria-hidden="true">&times;</span>

            								</button>

                                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>

                                            <p><strong>Success!</strong> Tambah data berhasil.</p>

                                        </div>';

							$this->session->set_flashdata('notice', $alert);

							redirect('UserModule');
				    }
			}


			public function deleteUserModule()

			{

				$decode = $this->input->get('id');

				$id = decodedata(str_replace(' ', '+', $decode));

				$result = $this->M_user_module->deleteUserModule($id, $this->session->userdata('userid'));

				if ($result != null) {
					$alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">

                                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                        							<span class="icon-sc-cl" aria-hidden="true">&times;</span>

                        						</button>

                                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>

                                               <p><strong>Success!</strong> Delete Data Successfuly.</p>

                                        </div>';

					$this->session->set_flashdata('notice', $alert);

					redirect('UserModule');
				} else {

					$alert = '<div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3">

                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                								<span class="icon-sc-cl" aria-hidden="true">&times;</span>

                							</button>

                                            <i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3" aria-hidden="true"></i>

                                            <p><strong>Danger!</strong> Delete Data Failed.</p>

                                     </div>';

					$this->session->set_flashdata('notice', $alert);

					redirect('UserModule');
				}
			}



			function search()
			{

			    
				$result = $this->M_user_module->search($this->input->get('term'));

				if (count($result) > 0) {

					foreach ($result as $row)

						$arr_result[] = array(

							'label'			=> $row->name_product,

							'id'	=> $row->id,

						);

					echo json_encode($arr_result);
				}
			}



			public function search_data($rowno = 0)

			{
			    $module_name = $this->input->get('module_name');
				
				$rowperpage = 10;
				if ($rowno != 0) {
					$rowno = ($rowno - 1) * $rowperpage;
				}

				$this->db->like('role_name', $module_name);
				$this->db->where('status', 1);
				$jml = $this->db->get('ms_user_module');

				$config['use_page_numbers'] = TRUE;
				$config['total_rows'] = $jml->num_rows();
				$config['per_page'] = $rowperpage;
				$config['first_link']       = 'First';
				$config['last_link']        = 'Last';
				$config['next_link']        = 'Next';
				$config['prev_link']        = 'Prev';
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

				$value['data'] = $this->M_user_module->search_filter_name($module_name, $rowperpage, $rowno);
				$data_record = array();
				if (count($value['data']) > 0) {
					for ($i = 0; $i < count($value['data']); $i++) {
					    
					    $item[$i]['id']           = encodedata($value['data'][$i]->id);
					    $item[$i]['role_id']      = $value['data'][$i]->role_id;
					    $item[$i]['role_name']    = $value['data'][$i]->role_name;
					    $item[$i]['module_id']    = $value['data'][$i]->module_id;
					    $item[$i]['module_name']  = $value['data'][$i]->module_name;
					    $item[$i]['module_url']   = $value['data'][$i]->module_url;
					    $item[$i]['status']       = $value['data'][$i]->status;
					    $item[$i]['create_user']  = $value['data'][$i]->create_user;
					    $item[$i]['created_date'] = $value['data'][$i]->created_date;
					    $item[$i]['update_user']  = $value['data'][$i]->update_user;
					    $item[$i]['updated_date'] = $value['data'][$i]->updated_date;
					    
						$data_record = $item;
					}
				}
				$data['pagination'] = $this->pagination->create_links();
				$data['result'] = $data_record;
				$data['row'] = $rowno;
				$data['role'] = $this->session->userdata('role');
				$data['module'] = $this->session->userdata('module');
				$data['url'] = base_url() . 'UserModule/search_data/';
				$data['params'] = 'role_name=' . $this->input->get('module_name');
				echo json_encode($data);
			}
		}
