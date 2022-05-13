<?php defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'core/AUTH_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pasien extends AUTH_Controller
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

    public function listPrinter_post()
    {

        $profile = $this->M_api_pasien->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $list = $this->M_api_pasien->listPrinterModel($limit, $offset);

            if ($list != null) {
                $this->Http_Ok(
                    $list
                );
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list printer"], $status);
            }
        }
    }


    public function bookingPcr_post()
    {
        $profile = $this->M_api_pasien->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $tgl_booking = $this->post('tgl_booking');
            $asd = date('md', strtotime($tgl_booking));
            $anu = str_pad(($this->post('printer_id')), 2, '0', STR_PAD_LEFT);
            $ssb = substr($anu, 0, 2);

            $event_id = $this->post('initialevent_id');
            $cek_event = $this->M_api_pasien->typeEventModel($event_id);

            $count = $this->M_api_home->getCount2($this->post('printer_id'), $tgl_booking);

            $count_number_queue = str_pad(($count + 1), 3, '0', STR_PAD_LEFT);


            $no_ktp = $this->post('no_ktp');
            $cekData = $this->M_api_pasien->cekDataPasienModel($no_ktp, $this->post('no_handphone'));
            if ($cekData == null) {
                $config = array(
                    'upload_path' => './assets/upload/register/',
                    'allowed_types' => 'jpeg|jpg|png',
                    'max_size' => '',
                    'max_width' => '6000',
                    'max_height' => '6000'
                );
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('filefoto')) {

                    $this->Http_NotFound();
                } else {
                    $file = $this->upload->data();
                    $image = $file['file_name'];
                    $images = str_ireplace('.', '_thumb.', $image);

                    $new = array(
                        'no_handphone' => $this->post('no_handphone'),
                        'nama_lengkap' => $this->post('nama_lengkap'),
                        'alamat' => $this->post('alamat'),
                        'no_ktp' => $no_ktp,
                        'jenis_kelamin' => $this->post('jenis_kelamin'),
                        'tanggal_lahir' => $this->post('tanggal_lahir'),
                        'email' => $this->post('email'),
                        'password' => md5('123456'),
                        'filename_ktp' => $image,
                        'status' => 1,
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id,
                    );

                    $insertPasien = $this->M_api_pasien->insertPasienModel($new);

                    $queue = array(
                        'nomor_antrian' => $ssb . '.' . $asd . '.' . $count_number_queue,
                        'pasien_id' => $insertPasien,
                        'initialevent_id' => $event_id,
                        'printer_id' => $this->post('printer_id'),
                        'create_date' => date('Y-m-d H:i:s'),
                        'tgl_checkin_pemeriksaan' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id,
                        'status' => 1
                    );

                    $insertQueue = $this->M_api_home->insertQueueModel($queue);
                    if ($insertQueue > 0) {
                        $regis = array(
                            'kategori_id' => 2,
                            'is_pic_grup' => 0,
                            'jumlah_anggota' => 0,
                            'ref_no_transfer' => null,
                            'alokasi_printer_id' => $this->post('printer_id'),
                            'booking_jadwal_test' => $tgl_booking,
                            'estimasi_jadwal_test' => null,
                            'antrian_id' => $insertQueue,
                            'url_hasil' => null,
                            'status_release_hasil' => 0,
                            'status_gugus_covid' => 0,
                            'registrasi_via' => 'Website',
                            'create_date' => date('Y-m-d H:i:s'),
                            'create_user' => $profile->id,
                            'update_date' => null,
                            'update_user' => null,
                            'status' => 1
                        );
                        $insertRegister = $this->M_api_home->insertRegisterModel($regis);
                        if ($insertRegister > 0) {
                            $type = $this->M_api_pasien->typeEventModel($event_id);
                            // if ($type->type_id != 1) {
                            //     $sph = array(
                            //         'initialevent_id' => $event_id,
                            //         'antrian_id' => null,
                            //         'nama_referensi' => $this->post('nama_referensi'),
                            //         'nomor_sph' => null,
                            //         'create_date' => date('Y-m-d H:i:s'),
                            //         'create_user' => $profile->id,
                            //         'status' => 1
                            //     );
                            //     $insertSph = $this->M_api_pasien->insertSphModel($sph);
                            // } else {
                            //     $sph = array(
                            //         'initialevent_id' => null,
                            //         'antrian_id' => $insertQueue,
                            //         'nama_referensi' => $this->post('nama_referensi'),
                            //         'nomor_sph' => null,
                            //         'create_date' => date('Y-m-d H:i:s'),
                            //         'create_user' => $profile->id,
                            //         'status' => 1
                            //     );
                            //     $insertSph = $this->M_api_pasien->insertSphModel($sph);
                            // }
                            $printer = $this->M_api_home->printerById($this->post('printer_id'));

                            $this->Http_Ok([
                                'antrian_id' => $insertQueue,
                                'printer_code' => $printer->printer_code,
                                'jam' => date('H:i'),
                                'no_ktp' => '' . $this->post('no_ktp') . '',
                                'nama_lengkap' => $this->post('nama_lengkap'),
                                'alamat' => $cek_event->alamat,
                                'nomor_antrian' => $ssb . '.' . $asd . '.' . $count_number_queue
                            ]);
                        } else {
                            $status = parent::HTTP_NO_CONTENT;
                            $this->response(['status' => $status, 'message' => "gagal"], $status);
                        }
                    } else {
                        $status = parent::HTTP_NO_CONTENT;
                        $this->response(['status' => $status, 'message' => "gagal insert"], $status);
                    }
                }
            } else {
                $getInitial = $this->M_api_home->getInitialEventModel($this->post('printer_id'));
                $queue = array(
                    'nomor_antrian' => $ssb . '.' . $asd . '.' . $count_number_queue,
                    'pasien_id' => $profile->id,
                    'initialevent_id' => $event_id,
                    'printer_id' => $this->post('printer_id'),
                    'create_date' => date('Y-m-d H:i:s'),
                    'tgl_checkin_pemeriksaan' => date('Y-m-d H:i:s'),
                    'create_user' => $profile->id,
                    'status' => 1
                );

                $insertQueue = $this->M_api_home->insertQueueModel($queue);
                if ($insertQueue > 0) {
                    $regis = array(
                        'kategori_id' => 2,
                        'is_pic_grup' => 0,
                        'jumlah_anggota' => 0,
                        'ref_no_transfer' => null,
                        'alokasi_printer_id' => $this->post('printer_id'),
                        'booking_jadwal_test' => date('Y-m-d H:i:s'),
                        'estimasi_jadwal_test' => null,
                        'antrian_id' => $insertQueue,
                        'url_hasil' => null,
                        'status_release_hasil' => 0,
                        'status_gugus_covid' => 0,
                        'registrasi_via' => 'Mobile',
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id,
                        'update_date' => null,
                        'update_user' => null,
                        'status' => 1
                    );
                    $insertRegister = $this->M_api_home->insertRegisterModel($regis);
                    if ($insertRegister > 0) {
                        $type = $this->M_api_pasien->typeEventModel($event_id);
                        // if ($type->type_id != 1) {
                        //     $sph = array(
                        //         'initialevent_id' => $event_id,
                        //         'antrian_id' => null,
                        //         'nama_referensi' => $this->post('nama_referensi'),
                        //         'nomor_sph' => null,
                        //         'create_date' => date('Y-m-d H:i:s'),
                        //         'create_user' => $profile->id,
                        //         'status' => 1
                        //     );
                        //     $insertSph = $this->M_api_pasien->insertSphModel($sph);
                        // } else {
                        //     $sph = array(
                        //         'initialevent_id' => null,
                        //         'antrian_id' => $insertQueue,
                        //         'nama_referensi' => $this->post('nama_referensi'),
                        //         'nomor_sph' => null,
                        //         'create_date' => date('Y-m-d H:i:s'),
                        //         'create_user' => $profile->id,
                        //         'status' => 1
                        //     );
                        //     $insertSph = $this->M_api_pasien->insertSphModel($sph);
                        // }
                        $printer = $this->M_api_home->printerById($this->post('printer_id'));

                        $this->Http_Ok([
                            'antrian_id' => $insertQueue,
                            'printer_code' => $printer->printer_code,
                            'jam' => date('H:i'),
                            'no_ktp' => '' . $this->post('no_ktp') . ' ',
                            'nama_lengkap' => $this->post('nama_lengkap'),
                            'alamat' => $cek_event->alamat,
                            'nomor_antrian' => $ssb . '.' . $asd . '.' . $count_number_queue
                        ]);
                    } else {
                        $status = parent::HTTP_NO_CONTENT;
                        $this->response(['status' => $status, 'message' => "gagal"], $status);
                    }
                } else {
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['status' => $status, 'message' => "gagal insert"], $status);
                }
            }
        }
    }


    public function riwayatTestPcr_post()
    {
        $profile = $this->M_api_pasien->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $param = $this->post('param');
            $pasien = $profile->id;
            $list = $this->M_api_pasien->riwayatTestPcrModel($pasien, $limit, $offset, $param);
            if ($list != null) {
                $this->Http_Ok($list);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "gagal insert"], $status);
            }
        }
    }


    public function detailRiwayat_post()
    {
        $profile = $this->M_api_pasien->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $antrian_id = $this->post('antrian_id');
            $pasien = $profile->id;
            $regiter_id = $this->post('id_registrasi');
            $cek_url_hasil = $this->M_api_pasien->cek_url_hasil($antrian_id);
            $data = $this->M_api_pasien->detailRiwayatModel($pasien, $antrian_id, $regiter_id);
            $data->url = base_url() . 'ResultHasil/index?result=' . $cek_url_hasil->url_hasil;
            if ($data != null) {
                $this->Http_Ok($data);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "gagal insert"], $status);
            }
        }
    }

    public function profilePasien_post()
    {
        $profile = $this->M_api_pasien->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $this->Http_Ok([
                'nama_lengkap' => $profile->nama_lengkap,
                'tanggal_lahir' => date('d F Y', strtotime($profile->tanggal_lahir)),
                'no_handphone' => '' . $profile->no_handphone . ' ',
                'email' => $profile->email,
                'alamat' => $profile->alamat,
                'image_profile' => base_url() . 'assets/upload/profile/' . $profile->image_user
            ]);
        }
    }


    public function antrianPasien_post()
    {
        $profile = $this->M_api_pasien->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $pasien = $profile->id;

            $chkAntrian = $this->M_api_pasien->chckAntrianPasienModel($pasien);

            if ($chkAntrian != null) {
                $listAntrian = $this->M_api_pasien->listAntrianPasienModel($chkAntrian->printer_id);
                $this->Http_ok([
                    'nama_lengkap' => $profile->nama_lengkap,
                    'nomor_antrian' => $chkAntrian->nomor_antrian,
                    'printer_code' => $chkAntrian->printer_code,
                    'list' => $listAntrian
                ]);
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "gagal insert"], $status);
            }
        }
    }



    public function updatePassword_post()
    {
        $profile = $this->M_api_pasien->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $pasien = $profile->id;
            $password_old = md5($this->post('password_old'));
            $password_new = md5($this->post('password_new'));
            $pasienCheck = $this->M_api_pasien->pasienCheckModel($pasien);
            if ($pasienCheck != null) {
                if ($pasienCheck->password == $password_old) {
                    $updatePassword = $this->M_api_pasien->updatePasswordPasienModel($pasien, $password_new);
                    if ($updatePassword) {
                        $this->Http_ok([
                            'message' => 'update password sukses'
                        ]);
                    }
                } else {
                    $status = parent::HTTP_CREATED;
                    $this->response(['message' => "password lama tidak sama"], $status);
                }
            } else {
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "data tidak di temukan"], $status);
            }
        }
    }
}
