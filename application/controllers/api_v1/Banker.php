<?php defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'core/AUTH_Controller.php';
require APPPATH . 'libraries/Format.php';

class Banker extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth();
        $this->load->model('M_api_home');
        $this->load->model('M_api_pasien');
        $this->load->library('CekToken');
        $this->load->library('HistoryBalancing');
        $this->load->helper(['authorization', 'encodedata']);
        $this->load->library('Inbox');
        $this->load->library('zend');
    }

    public function listDropPoint_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $zonasi = $profile->zonasi_id;
            $list = $this->M_api_home->listDropPontModel($zonasi);
            if ($list != null) {
                $this->Http_Ok(
                    $list
                );
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }
        }
    }

    public function getTitikSalur_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $drop_id = $this->post('drop_point_id');
            $data = $this->M_api_home->getTitikSalurModel($drop_id);
            if($data != null){
                $debit = $data->debit;
                $tanggal = $data->tanggal;
                $image_cast = base_url()."assets/upload/image_cast/".$data->image_cash;
                $image_count = base_url()."assets/upload/image_count/".$data->image_count;
                $this->Http_Ok([
                    "debit" => $debit,
                    "tanggal" => $tanggal,
                    "image_cast" => $image_cast,
                    "image_count" => $image_count
                ]
                );
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }



        }
    }

    public function addTitikSalur_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $config = array(
                'upload_path' => './assets/upload/image_cast/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '',
                'max_width' => '6000',
                'max_height' => '6000'
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('filefoto_cash')) {
               
                $this->Http_NotFound();
            } else {
                $file = $this->upload->data();
                $image = $file['file_name'];
                $images = str_ireplace('.', '_thumb.', $image);

                $config1 = array(
                    'upload_path' => './assets/upload/image_count/',
                    'allowed_types' => 'jpeg|jpg|png',
                    'max_size' => '',
                    'max_width' => '6000',
                    'max_height' => '6000'
                );
                $this->load->library('upload', $config1);
                $this->upload->initialize($config1);
                if (!$this->upload->do_upload('filefoto_count')) {
                    
                    $this->Http_NotFound();
                } else {
                    $file1 = $this->upload->data();
                    $image1 = $file1['file_name'];
                    $images1 = str_ireplace('.', '_thumb.', $image1);

                        $data = array(
                            'create_user' => $profile->id,
                            'debit' => $this->post('debit'),
                            'kredit' => 0,
                            'drop_point_id' => $this->post('drop_point_id'),
                            'image_cash' => $image,
                            'image_count' => $image1,
                            'description' => '',
                            'status' => 1

                    );

                    $insertData = $this->M_api_home->insertDataTitiKSalurModel($data);
                    if($insertData > 0){
                        $this->Http_Ok([
                            "message" => "suksess"
                        ]
                        );
                    }else{
                        $status = parent::HTTP_NO_CONTENT;
                         $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
                    }
                }

               


            }

        }
    }

    public function getCEOD_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $drop_id = $this->post('drop_point_id');
            $data = $this->M_api_home->getCEODModel($drop_id);
            if($data != null){
                $debit = $data->debit;
                $tanggal = $data->tanggal;
                $image_cast = base_url()."assets/upload/image_cast/".$data->image_cash;
                $image_count = base_url()."assets/upload/image_count/".$data->image_count;
                $this->Http_Ok([
                    "debit" => $debit,
                    "tanggal" => $tanggal,
                    "image_cast" => $image_cast
                ]
                );
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }

        }
    }

    public function inputCEOD_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            
                $drop_id = $this->post('drop_point_id');
                $input_sisa = $this->post('input_sisa');

               

                $data = $this->M_api_home->getTitikSalurModel($drop_id);
                if($data != null){
                    $debit = $data->debit;
                    $kredit = $data->kredit;
                    $hasil = (($debit - $kredit) + $input_sisa);
                    if($data->debit == $input_sisa){
                        $config = array(
                            'upload_path' => './assets/upload/image_cast/',
                            'allowed_types' => 'jpeg|jpg|png',
                            'max_size' => '',
                            'max_width' => '6000',
                            'max_height' => '6000'
                        );
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('filefoto_cash')) {
                           
                            $this->Http_NotFound();
                        } else {
                            $file = $this->upload->data();
                            $image = $file['file_name'];
                            $images = str_ireplace('.', '_thumb.', $image);
                            $updateDataCEOD = $this->M_api_home->updateDataCEODModel($data->id,$image);


                            $this->Http_Ok([
                                "message" => "suksess"
                            ]
                            );
                        }

                        
                    }else{
                        $status = parent::HTTP_CREATED;
                     $this->response(['debit' => $data->debit,
                                    'input_sisa' => $input_sisa,
                                     'message' => "list drop point kosong"], $status);
                    }
                }else{
                    $status = parent::HTTP_NO_CONTENT;
                     $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
                }



            

        }

    }

    public function inputBeritaSelisih_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
                $getCreated = $this->M_api_home->getNextCreated();
              
                $drop_id = $this->post('drop_point_id');
                $input_sisa = $this->post('input_sisa');
                $data = $this->M_api_home->getTitikSalurModel($drop_id);
                if($data != null){
                    $config = array(
                        'upload_path' => './assets/upload/image_cast/',
                        'allowed_types' => 'jpeg|jpg|png',
                        'max_size' => '',
                        'max_width' => '6000',
                        'max_height' => '6000'
                    );
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('filefoto_cash')) {
                       
                        $this->Http_NotFound();
                    } else {
                        $file = $this->upload->data();
                        $image = $file['file_name'];
                        $images = str_ireplace('.', '_thumb.', $image);
                        
                        $data = array(
                            'created_date' => $getCreated->created_date,
                            'create_user' => $profile->id,
                            'debit' => $input_sisa,
                            'image_cash' => $image,
                            'status' => 2,
                            'drop_point_id' => $drop_id,
                            'description' => $this->post('description'),
                            'nama_petugas' => $this->post('nama_petugas')

                        );
                        $insertData = $this->M_api_home->insertDataTitiKSalurModel($data);
                            if($insertData > 0){
                                $this->Http_Ok([
                                    "message" => "suksess"
                                ]
                                );
                            }else{
                                $status = parent::HTTP_NO_CONTENT;
                                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
                            }


                    }

                }else{
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
                }


        }
    }

    public function getDigitalBalance_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $drop = $this->post('drop_point_id');
            $data = $this->M_api_home->getDitigalBalanceModel($drop);
            $saldo = $this->M_api_home->getSaldoDropPoint($drop);
            $sisa = $saldo->debit - $saldo->kredit;
            $bundlesub = array();
            $dt = array();
            if($data != null){
                
                foreach($data as $dts){
                    $list = $this->M_api_home->getDtBalanceByTglModel($drop,$dts->tanggal);
                   
                    foreach($list as $ls){
                        unset($dt);
                        if( $ls->kredit == 0){
                            $ket = 'DEBIT';
                            $nominal = $ls->debit;
                        }else{
                            $ket = 'KREDIT';
                            $nominal = $ls->kredit;
                        }
                       
                        $dt[] = array(
                            'status' => $ket,
                            'nominal' => $nominal,
                            'nama' => $ls->nama_petugas,
                            'description' => $ls->description
                        );
                    }
                    
                    $sub['tanggal'] = $dts->tanggal;
                    $sub['list'] = $dt;
                    $bundlesub[] = $sub; 
                }
                $this->Http_Ok([
                    'saldo_awal' => $saldo->debit,
                    'saldo_akhir' => $sisa,
                    'balance'=> $bundlesub]);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }


        }
    }

    


    
}
