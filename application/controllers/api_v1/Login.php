<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->helper('jwt');
		$this->load->helper('authorization');
		$this->load->helper('encodedata');
		$this->load->helper('decodedata');
		$this->load->helper('generate_token');
        $this->load->model('M_api_login');
		$this->load->helper('update_token');
		$this->load->helper('update_tokenpasien');
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
	    //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Token");
    }

    public function loginAll_post()
	 {
		//  $captcha = $this->post('captcha');
		 
		// $secretKey = "6LfkRqgZAAAAAJq7bqYzr-UyqWd5eLUtawX3YQf5";
        // $ip = $_SERVER['REMOTE_ADDR'];
        // // post request to server
        // $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        // $response = file_get_contents($url);
		// $responseKeys = json_decode($response,true);
		
        // // should return JSON with success as true
        // if($responseKeys["success"]) {
			$cek = $this->M_api_login->login($this->post('email'));
		
			$pass = MD5($this->post('password'));
			
			if ($cek != null) {
				// if($cek->role_id == $this->post('role')){
					if ($pass == $cek->password) {
						$role = $this->M_api_login->getRoleModel($cek->role_id);
						$access_token = generate_token();
						
						$update_token = update_token($access_token, $cek->id);
						
						$timestamp = time();
						$expire = $timestamp + 86400;
						if ($update_token > 0) {
						   
							$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name, 'token' => $access_token, 'timestamp' => $expire]);
							$status = parent::HTTP_OK;
							$response = ['status' => $status,
										'username' => $cek->name,
										'role' => $role->role, 
										'token' => $token];
							$this->response($response, $status);
						}else{
							
							$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
						}
					}else{
						
						$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED);//405 password salah
					}
				// }else{
				// 	$this->response(['msg' => 'salah kamar!'], parent::HTTP_NOT_ACCEPTABLE);//406 salah kamar
				// }
				
			}else {
				$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND);//404
			}
        // } else {
		// 	$this->response(['msg' => 'captcha error !!'], parent::HTTP_NOT_ACCEPTABLE);//406
		// }

	 }

	 public function listGudangLogin_get()
		{
			$list = $this->M_api_login->listGudangLoginModel();
			if($list != null){
				$this->response(['data' => $list]);
			}else{
				$status = parent::HTTP_NO_CONTENT;
				$this->response(['message' => "list null"], $status);
			}
		}

		

		

	public function downloadApk_post()
	{
		$versi = $this->post('versi_apk');
		$type = $this->post('apk_type');
		$check = $this->M_api_login->checkVersiApk($versi,$type);
		
		if($check == NULL){
			$ambil = $this->M_api_login->ambilApk($type);
			
			$status = parent::HTTP_OK;
			$response = [
					'apk_version' => $ambil->apk_version,
					'url' => base_url().'assets/upload/apk/'.$ambil->apk_name
						];
			$this->response($response, $status);
		}else{
			$this->response(['msg' => 'versi android sama'], parent::HTTP_NO_CONTENT);
		}
	}



	public function forgotPassword_post()
	{
		$data = $this->M_api_login->cekDataUserModel($this->post('email'));
		if($data != null){
			$length = 5;
			$characters = '0123456789';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			

			$forget_date = $this->M_api_login->getTimeForgetDateModel();
				$dataNew = array (
									
								'forget_code' =>  $randomString,
								'forget_date' => $forget_date->forget_date
							);
                $dataForView = array (

                    'forget_code' =>  $dataNew['forget_code'],
                    'email' => $this->post('email')
                );
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

				$message = $this->load->view('layouts/forgot_password_view',$dataForView,TRUE);
				$this->email->from('admin@adacademy.id', 'DWS');

				$this->email->to($this->post('email'));


				$this->email->subject("Forgot password");
				$this->email->message($message);



				if($this->email->send()){
					$updateDate = $this->M_api_login->updateDateForgetUserModel($data->id,$dataNew);
					$status = parent::HTTP_OK;
							$response = ['email' => $this->post('email'),
										'forget_date' => $forget_date->forget_date];
							$this->response($response, $status);
				}else{
					$this->response(
							array('code' => 500,  
							'message' => 'failed')); 
					//echo $this->email->print_debugger();
				}
			
		}else{
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND);//404
		}
	}


	public function validationCode_post()
	{
		$data = $this->M_api_login->cekDataUserModel($this->post('email'));
		if($data != null){
			$forget_code = $this->post('forget_code');
			$timestamp = date('Y-m-d H:i:s');
			if($timestamp < $data->forget_date){
				if($data->forget_code == $forget_code){
					$status = parent::HTTP_OK;
					$response = ['email' => $this->post('email'),
								'mesagge' => 'success'];
					$this->response($response, $status);
				}else{
					$this->response(['msg' => 'code salah'], parent::HTTP_CREATED);//201
				}
				 
			}else{
				$this->response(['msg' => 'waktu habis'], parent::HTTP_ACCEPTED);//202
			}

		}else{
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND);//404
		}
	}


	public function changePasswordUser_post()
	{
		$data = $this->M_api_login->cekDataUserModel($this->post('email'));
		if($data != null){
			
			$dt = array(
				"password" => MD5($this->post('password_new')),
				'updated_date' => date('Y-m-d H:i:s'),
				'update_user' => $data->id
			);
			$updateDate = $this->M_api_login->updateDateForgetUserModel($data->id,$dt);
			if($updateDate){
				$status = parent::HTTP_OK;
					$response = ['email' => $this->post('email'),
								'mesagge' => 'success'];
					$this->response($response, $status);
			}else{
				$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND);//404
			}

		}else{
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND);//404
		}
	}

		
	 
	 
}