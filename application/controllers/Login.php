<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
		$this->load->library('session');
		$this->load->helper('decodedata');
		$this->load->helper('encodedata');
	}

	public function index()
	{
		if (!$this->session->userdata('userid') || !$this->session->userdata('name')) {
			$this->load->view('login/login');
		} else {
			// redirect($this->session->userdata('menu')[0]);
			redirect('Dashboard');
		}
	}

	public function cek_data()
	{

//	    echo "<pre>";
//	    print_r($_POST);
//	    exit();

		$token = $this->input->post("g-recaptcha-response");

		$RECAPTCHA_URL = "https://www.google.com/recaptcha/api/siteverify";
		$RECAPTCHA_SECRET = "6LeI8Y0aAAAAAH2EUU76p9Mo_yCdgZJ-_ou-M96T";

		$recaptcha = file_get_contents($RECAPTCHA_URL . '?secret=' . $RECAPTCHA_SECRET . '&response=' . $token);
		$recaptcha = json_decode($recaptcha);

		if ($recaptcha->score >= 0.5) {
			$email = $this->input->post("email");
			$password = md5($this->input->post("password"));

			$user = $this->M_login->getUser($email);


			$alert = "";
			if (count($user) > 0) {
				if ($password == $user[0]->password) {

					// $menu = $this->M_login->getRole($user[0]->id);
					// if (count($menu) > 0) {

					$module = $this->M_login->getModuleRole($user[0]->role_id);
					//$firstRedirect = $this->M_login->getRoleRedirect($user[0]->role);

					$sessiondata = array(
						'userid' => $user[0]->id,
						'email' => $user[0]->email,
						'warehouse_id' => $user[0]->warehouse_id,
						'name' => $user[0]->name,
						'role' => $user[0]->role_id,
						'module' => $module,
					);


                    $this->session->set_userdata($sessiondata);
					$cookie = array(
						'name'   => 'id',
						'value'  => $user[0]->id,
						'expire' => '86500'
					);
					$this->input->set_cookie($cookie);


					if ($user[0]->role_id == 1) {
                        redirect('Landing');
                    } else {
                        redirect('Landing');
					}
				} else {
					$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%">
							<strong>Failed | </strong> Password Incorrect.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
				}
			} else {
				$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%">
							<strong>Failed | </strong> User Not Found.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
			}

			$this->session->set_flashdata('notice', $alert);
			redirect('Login');
		} else {
			$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%">
							<strong>Failed | </strong> Captcha invalid.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
			$this->session->set_flashdata('notice', $alert);
			redirect('Login');
		}
	}

	public function logout()
	{
		$sessiondata = array(
			'userid' => "",
			'name' => "",
			'role' => ""
		);
		$this->session->unset_userdata($sessiondata);
		$this->session->sess_destroy();
		redirect('Login');
	}
//	public function ForgotPassword()
//	{
//		$this->load->view('login/forgotpwd');
//	}

	function send()
	{
		$token = $this->input->post("g-recaptcha-response");
		$RECAPTCHA_URL = "https://www.google.com/recaptcha/api/siteverify";
		$RECAPTCHA_SECRET = "6LeFJP0UAAAAADYRqbz9kTBWk9JueAbgmxKVN9Sa";
		$recaptcha = file_get_contents($RECAPTCHA_URL . '?secret=' . $RECAPTCHA_SECRET . '&response=' . $token);
		$recaptcha = json_decode($recaptcha);
		if ($recaptcha->score >= 0.5) {
			$email_penerima = $this->input->post('email_penerima');
			$this->db->where('email', $email_penerima);
			$query = $this->db->get('ms_user');
			if (count($query->result()) > 0) {
				$this->load->library('mailer');
				$random_char = '0123456789abcdefghijklmnopqrstuvwxyzACDEFGHIJKLMNOPQRSTUVWXYZ';
				$rand = substr(str_shuffle($random_char), 0, 6);

				$password1 = $rand;
				$password = md5($password1);
				$subjek = 'Forget Password DNR BANSOS';
				$content = $this->load->view('login/template_email', array('password' => $password1), true);

				$sendmail = array(
					'email_penerima' => $email_penerima,
					'subjek' => $subjek,
					'content' => $content,
				);

				$send = $this->mailer->send($sendmail);
				$update = date("d/m/Y h:i:s");
				$this->db->set('password', $password);
				$this->db->set('updated_date', $updated_date);
				$this->db->where('email', $email_penerima);
				$this->db->update('ms_user');

				$alert = '<div class="alert alert-success alert-dismissible fade show" role="alart">
							<strong>Berhasil | </strong> Silahkan Cek Email Anda.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
				$this->session->set_flashdata('notice', $alert);
				redirect('Login');
				echo "<b>" . $send['status'] . "</b><br />";
				echo $send['message'];
			} else {
				$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Failed | </strong>Email tidak ditemukan.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
				$this->session->set_flashdata('notice', $alert);
				redirect('Login/ForgotPassword');
			}
		} else {
			$alert =
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Failed | </strong> Captcha invalid.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
					</div>';
			$this->session->set_flashdata('notice', $alert);
			redirect('Login/ForgotPassword');
		}
	}

	public function forgotPassword(){

        $email = $this->input->post("forgot_email");
        $user = $this->M_login->getUser($email);


        if (count($user) > 0) {
            $length = 5;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $forget_date = $this->M_login->getTimeForgetDateModel();
            $dataNew = array (

                'forget_code' =>  $randomString,
                'forget_date' => $forget_date->forget_date
            );

            $emailData = array(
                'forget_code' => $dataNew['forget_code'],
                'email' => $email
            );
//            $this->load->view('layouts/forgot_password_view_web',$emailData);

            $this->load->library('email');

            $config = array();
            $config['charset'] = 'utf-8';
            $config['useragent'] = 'Codeigniter';
            $config['protocol']= "smtp";
            $config['mailtype']= "html";
            $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
            $config['smtp_port']= "465";
            $config['smtp_timeout']= "5";
            $config['smtp_user']= "send.adacademy@gmail.com"; // isi dengan email kamu
            $config['smtp_pass']= "bisnisintegrasiglobal"; // isi dengan password kamu
            $config['crlf']="\r\n";
            $config['newline']="\r\n";
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $message = $this->load->view('layouts/forgot_password_view_web',$emailData,TRUE);
            $this->email->from('admin@dws.id', 'Digital Warehouse & Supply Chain');

            $this->email->to($email);


            $this->email->subject("Forgot password");
            $this->email->message($message);


            if($this->email->send()){
                $updateDate = $this->M_login->updateDateForgetUserModel($user[0]->id,$dataNew);

                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alart">
							<strong>Success | </strong> Please Check your email.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
                $this->session->set_flashdata('notice', $alert);
                redirect('Login');
            }else{
                $alert =
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Failed | </strong> Please try again.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
					</div>';
                $this->session->set_flashdata('notice', $alert);
                redirect('Login');
            }

        }else{
            $alert =
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Failed | </strong> User email not found.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
					</div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Login');
        }
    }

    public function resetPassword(){

	    $email = $this->input->get('e');
	    $forgot_code = $this->input->get('ref');

	    if($email != "" && $forgot_code != ""){
	        $checkUser = $this->M_login->checkUserForgotPassword($email, $forgot_code);

            $data = [
                'user' => $checkUser
            ];

            if($checkUser){
	            $this->load->view('login/reset-password', $data);
            } else {
                redirect('Login');
            }
        } else {
            redirect('Login');
        }
    }

    public function changePassword(){

	    $reset_password = $this->input->post('reset_password');
	    $reset_password_confirmation = $this->input->post('reset_password_confirmation');
	    $id = $this->input->post('user_id');

	    if(!$reset_password || !$reset_password_confirmation || !$id){
            $alert =
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Failed | </strong> Gagal Reset Password.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
					</div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Login');
        } else if($reset_password !== $reset_password_confirmation) {
	        echo "here";exit;
            $alert =
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Gagal Reset Password | </strong> Password Baru dan Konfirmasi Tidak Sesuai.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
					</div>';
            $this->session->set_flashdata('notice', $alert);
            redirect('Login');
        } else {
            $datas = array(
                'password'      => md5($reset_password),
            );
            $this->M_login->postUpdateUser($datas, $id);

            $alert = '<div class="alert alert-success alert-success-style1 alert-st-bg">
                                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr" aria-hidden="true"></i>
                                           <p><strong>Success!</strong> Reset Password succeed.</p>
                                    </div>';
            $this->session->set_flashdata('notice', $alert);

            redirect('Login');
        }
    }

    public function redirect_bukalapak()
    {
        echo "<pre>";
        print_r($_REQUEST);
        exit();
    }
}
