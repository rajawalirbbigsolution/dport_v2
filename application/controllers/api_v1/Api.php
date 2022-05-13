<?php defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'core/AUTH_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth();
        $this->load->model('M_api_home');
        $this->load->model('M_stock_movement');
        $this->load->library('CekToken');
        $this->load->library('HistoryBalancing');
        $this->load->helper(['authorization', 'encodedata']);
        $this->load->library('Inbox');
        $this->load->library('zend');
    }

    public function getGrList_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $value = $this->post('value');
            $param = $this->post('param');
            $params = '';
            if ($param == 1) {
                $params = 'bb.po_header_number';
            }elseif($param == 2){
                $params = 'aa.gr_header_number';
            }else{
                $params = '';
            }

            $zonasi = $profile->warehouse_id;
            $list = $this->M_api_home->getGrListModel($limit,$offset,$value,$params);
           
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

    public function getGrProductSelection_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $po_header_id = $this->post('po_header_id');
            $zonasi = $profile->warehouse_id;
            $list = $this->M_api_home->getGrProductSelection($po_header_id);
           
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

    public function getReviewProductGr_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $detail = $this->post('detail');
            $var1 = json_encode($detail);
            $var2 = json_decode($var1);
           
           
            $data = array();
           foreach ($var2 as $key) {
               
               $dt = $this->M_api_home->detailProductGr($key->po_detail_id);
            //    var_dump($dt);
            //    exit;
               $data[] = array(
                   'po_detail_id' => $dt->po_detail_id,
                    'sku_number' => $dt->sku_number,
                    'upc_number' => $dt->upc_number,
                    'product_name' => $dt->product_h_name,
                    'product_category' => $dt->category,
                    'category_sub' => $dt->category_sub,
                    'category_class'=> $dt->category_class,
                    'category_class_sub' => $dt->category_class_sub,
                    'colour' => $dt->colour,
                    'weight' => $dt->weight,
                    'size' => $dt->size,
                    'po_qty' => $dt->po_qty,
                    'uom_name' =>$dt->uom_name,
                    'product_d_id' => $dt->product_d_id
               );
             
           }

           $this->Http_Ok(
            $data
        );


        }

    }

    public function postInspection_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {

            $po_header_id = $this->post('po_header_id');
            $detail = $this->post('detail');

            $headGr = array(
                'gr_header_desc' => 'desc',
                'gr_header_date' => date('Y-m-d H:i:s'),
                'gr_header_status' => 2,
                'po_header_id' => $po_header_id,
                'receiving_type_id' => 12,
                'created_date' => date('Y-m-d H:i:s'),
                'create_user' => $this->auth(),
                'gr_header_number' => 'GR-'.time(),
                'receive_date' => date('Y-m-d')
            );
            $insertGrHead = $this->M_api_home->insertGrHeadModel($headGr);
            if ($insertGrHead > 0) {
                $var1 = json_encode($detail);
                $var2 = json_decode($var1);
                for ($i=0; $i < count($var2); $i++) { 
                     // $po_detail_id = $this->post('po_detail_id');
                    // $qty = $this->post('qty');
                    // $more_qty = $this->post('more_qty');
                    // $less_qty = $this->post('less_qty');
                    // $damage = $this->post('damage');
                    // $reason = $this->post('reason');
                    $dataDetailPo = $this->M_api_home->CheckData($var2[$i]->po_detail_id);
                    $dt = array(
                        'gr_detail_qty' => $var2[$i]->qty,
                        'gr_detail_damaged_qty' => $var2[$i]->damage,
                        'gr_detail_confirmed_qty' => $var2[$i]->less_qty,
                        'gr_detail_more_qty' => $var2[$i]->more_qty,
                        'gr_header_id' => $insertGrHead,
                        'status' => 1,
                        'create_user' => $profile->id,
                        'gr_detail_reason' => $var2[$i]->reason,
                        'product_d_id' => $dataDetailPo->product_d_id,
                        'sisa_po' => $dataDetailPo->po_detail_qty
                    );
                    $insert = $this->M_api_home->insertGrDetail($dt);
                    $update = $this->M_api_home->updateStatusPoModel($var2[$i]->po_detail_id);
                }
                $this->Http_Ok([
                    'message' => 'success'
                ] );
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }
        }

           
    }

    public function getListInventory_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');
            $param = $this->post('param');

            $data = $this->M_api_home->getListInventory($param,$limit,$offset);
            
            if($data != null){
                $this->Http_Ok($data
                );
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }



        }
    }


    public function getLocation_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $list = $this->M_api_home->getLocationModel();
            if($list != null){
                $this->Http_Ok($list);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }
        }

    }

    public function getProductByLocationId_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $location = $this->post('location_id');
            $data = $this->M_api_home->getProductByLocationIdModel($location);
            $qw = array();
            if($data != null){

                foreach ($data as $key) {

                    $getUom = $this->M_api_home->getUom($key->product_h_id);
                        $qw[] = array(
                            'location_id' => $key->location_id,
                            'product_d_id' => $key->product_d_id,
                            'qty' => $key->qty,
                            'sku_number' => $key->sku_number,
                            'product_h_name' => $key->product_h_name,
                            'inv_storage_exp_date' => $key->inv_storage_exp_date,
                            'inv_storage_batch' => $key->inv_storage_batch,
                            'inv_storage_serial' => $key->inv_storage_serial,
                            'qty_move' => $key->qty_move,
                            'product_d_supplier_id' => $key->product_d_supplier_id,
                            'uom_id' => $key->uom_id,
                            'uom_name' => $key->uom_name,
                            'confirmed_quantity' => $key->confirmed_quantity,
                            'uom' => $getUom
                        );
                    # code...
                }
                $this->Http_Ok($qw);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }

        }

    }

    public function postAddStockMovement_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $location_from = $this->post('location_id_from');
            $location_to = $this->post('location_id_to');
            $data = $this->post('data');
           
            $var1 = json_encode($data);
            $var2 = json_decode($var1);
            for ($i=0; $i < count($var2); $i++) { 
                //$chekUom = $this->M_api_home->checkDetailUom($var2[$i]->product_h_id,$var2[$i]->uom_id);
                
               // if ($chekUom != null) {
                    $min = array(
                        'location_id' => $location_from,
                        'product_d_id' => $var2[$i]->product_d_id,
                        'inventory_type' => "STOCK MOVEMENT MOBILE",
                        'qty' => 0,
                        'inv_storage_exp_date' => $var2[$i]->inv_storage_exp_date,
                        'inv_storage_batch'=> $var2[$i]->inv_storage_batch,
                        'inv_storage_serial' => $var2[$i]->inv_storage_serial,
                        'product_d_supplier_id' => $var2[$i]->product_d_supplier_id,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id,
                        'qty_out' => $var2[$i]->confirmed_quantity
                    );
                    $insertMin = $this->M_api_home->insertStorageModel($min);
                    $plus = array(
                        'location_id' => $location_to,
                        'product_d_id' => $var2[$i]->product_d_id,
                        'inventory_type' => "STOCK MOVEMENT MOBILE",
                        'qty' => $var2[$i]->confirmed_quantity,
                        'inv_storage_exp_date' => $var2[$i]->inv_storage_exp_date,
                        'inv_storage_batch'=> $var2[$i]->inv_storage_batch,
                        'inv_storage_serial' => $var2[$i]->inv_storage_serial,
                        'product_d_supplier_id' => $var2[$i]->product_d_supplier_id,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id,
                        'qty_out' => 0
                    );
                    $insertPlus = $this->M_api_home->insertStorageModel($plus);
    
                    $rand = rand();
                    $move = array(
                        'location_storage_id' => $insertMin,
                        'new_location_storage_id' => $insertPlus,
                        'created_date' => date('Y-m-d H:i:s'),
                        'create_user' => $profile->id,
                        'status' => 1,
                        'inv_move_number' => $rand
                    );
                    $insertMove = $this->M_api_home->insertMovementModel($move);
                // }else{
                //     $getDetailProduct = $this->M_api_home->getDetailProductDmodel($var2[$i]->product_d_id);

                //     $dProduct = array(
                //         'product_h_id' => $var2[$i]->product_h_id,
                //         'product_d_uom_id' => $var2[$i]->uom_id,
                //         'created_date' => date('Y-m-d H:i:s'),
                //         'create_user' => $profile->id,
                //         'status' => 1,
                //         'colour' => $getDetailProduct->colour,
                //         'wieght' => $getDetailProduct->weight,
                //         'size' => $getDetailProduct->size
                //     );
                //     $insertDetailProduct = $this->M_api_home->insertDetailProductModel($dProduct);

                //     $min = array(
                //         'location_id' => $location_from,
                //         'product_d_id' => $var2[$i]->product_d_id,
                //         'inventory_type' => "STOCK MOVEMENT MOBILE",
                //         'qty' => 0,
                //         'inv_storage_exp_date' => $var2[$i]->inv_storage_exp_date,
                //         'inv_storage_batch'=> $var2[$i]->inv_storage_batch,
                //         'inv_storage_serial' => $var2[$i]->inv_storage_serial,
                //         'product_d_supplier_id' => $var2[$i]->product_d_supplier_id,
                //         'created_date' => date('Y-m-d H:i:s'),
                //         'create_user' => $profile->id,
                //         'qty_out' => $var2[$i]->qty_move
                //     );
                //     $insertMin = $this->M_api_home->insertStorageModel($min);
                //     $plus = array(
                //         'location_id' => $location_to,
                //         'product_d_id' => $var2[$i]->product_d_id,
                //         'inventory_type' => "STOCK MOVEMENT MOBILE",
                //         'qty' => $var2[$i]->qty_move,
                //         'inv_storage_exp_date' => $var2[$i]->inv_storage_exp_date,
                //         'inv_storage_batch'=> $var2[$i]->inv_storage_batch,
                //         'inv_storage_serial' => $var2[$i]->inv_storage_serial,
                //         'product_d_supplier_id' => $var2[$i]->product_d_supplier_id,
                //         'created_date' => date('Y-m-d H:i:s'),
                //         'create_user' => $profile->id,
                //         'qty_out' => 0
                //     );
                //     $insertPlus = $this->M_api_home->insertStorageModel($plus);
    
                //     $rand = rand();
                //     $move = array(
                //         'location_storage_id' => $insertMin,
                //         'new_location_storage_id' => $insertPlus,
                //         'created_date' => date('Y-m-d H:i:s'),
                //         'create_user' => $profile->id,
                //         'status' => 1,
                //         'inv_move_number' => $rand
                //     );
                //     $insertMove = $this->M_api_home->insertMovementModel($move);

                // }

                
            }
            $this->Http_Ok([
                'message' => 'success'
                ]
            );
        }
    }

    public function getListOutBound_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $limit = $this->post('limit');
            $offset = $this->post('offset');

            $list = $this->M_api_home->getListOutBoundModel($limit,$offset);
            if($list != null){
                $this->Http_Ok($list);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }

        }
    }

    public function getSelectDoHeader_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $data = $this->post('data');
            $var1 = json_encode($data);
            $var2 = json_decode($var1);
           
            $dt = array();
            for ($i=0; $i < count($var2); $i++) { 
                $cekData = $this->M_api_home->getSelectDoHeaderModel($var2[$i]->do_header_id);
                $dt[] = array(
                    'do_header_id' => $cekData->do_header_id,
                    'do_number' => $cekData->do_number,
                    'so_header_date' => $cekData->so_header_date,
                    'do_header_awb_num' => $cekData->do_header_awb_num,
                    'so_header_id' => base_url()."assets/upload/do_number/".$cekData->do_number.".png"
                );
            }
            if ($var2 != null) {
                $this->Http_Ok($dt);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }


        }
    }


    public function getDetailProductDoHeader_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $do_header_id = $this->post('do_header_id');
            $list = $this->M_api_home->getDetailDataDoHeader($do_header_id);
            if ($list != null) {
                $this->Http_Ok($list);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }


        }
    }

    public function postProsesValidationProduct_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $do_header_id = $this->post('do_header_id');
            $updateDo = $this->M_api_home->updateDoHeaderModel($do_header_id);
            if($updateDo){
                $this->Http_Ok([
                    'message' => 'success'
                    ]
                );
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }


        }
    }

    public function getDetailProductInventory_post()
    {
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {
            $product_d_id = $this->post('product_d_id');
            $data = $this->M_api_home->getDetailProductInventoryModel($product_d_id);
            if ($data != null) {
                $this->Http_Ok($data);
            }else{
                $status = parent::HTTP_NO_CONTENT;
                $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
            }

        }
    }

    public function getConfirmedQuantity_post(){
        //header('Content-type: application/json');

        // if(!$this->input->post('pid') ||
        //     !$this->input->post('qty') ||
        //     !$this->input->post('uom') ){
        //     echo null;
        // }
        $profile = $this->M_api_home->profile($this->auth());

        if ($profile == null) {
            $this->Http_NotFound();
        } else {

            $product_uom = $this->post('product_d_id');
            $qty = $this->post('qty_move');
            $uom = $this->post('uom_id');
            $convert = 0;
            
            if($this->checkNewUomIsChild($product_uom, $uom)){
    
                while($uom != $product_uom) {
                    $productUomData = $this->M_stock_movement->getUomData($product_uom);
                    if ($convert == 0) {
                        $convert = (int)$productUomData->product_d_uom_qty;
                    } else {
                        $convert = (int)$convert * (int)$productUomData->product_d_uom_qty;
                    }
                    $product_uom = $productUomData->product_d_uom_base;
                }
    
                if($convert == 0){
                    $data = ['confirmed_quantity' => $qty];
                    $this->Http_Ok($data);
                } else {
                    $data = ['confirmed_quantity' => (int)$qty * (int)$convert];
                    $this->Http_Ok($data);
                }
    
            } else {
    
                if($uom != $product_uom) {
                    $productUomData = $this->M_stock_movement->getUomDataChild($product_uom);

                  if($productUomData != null){
                    if ($convert == 0) {
                        $convert = (int)$productUomData->product_d_uom_qty;
                    } else {
                        $convert = (int)$convert * (int)$productUomData->product_d_uom_qty;
                    }
                    
                    $product_uom = $productUomData->product_d_uom_id;
                  }else{
                    $convert == 0;
                  }
                    
                   
                }
               
                if($convert == 0){
                    $data = ['confirmed_quantity' => $qty];
                    $this->Http_Ok($data);
                } elseif( fmod((int)$qty / (int)$convert, 1) === 0.00)  {
                    $data = ['confirmed_quantity' => (int)$qty / (int)$convert];
                    $this->Http_Ok($data);
                }else{
                    // $data = ['confirmed_quantity' => (int)$qty / (int)$convert];
                    // var_dump($data);
                    // exit;
                    $status = parent::HTTP_NO_CONTENT;
                    $this->response(['status' => $status, 'message' => "list drop point kosong"], $status);
                }
    
            }
            
            // $this->Http_Ok($data);
            // echo json_encode($data);
            // exit;



        }

       
    }

    private function checkNewUomIsChild($product_uom, $uom): bool
    {
        
        $newUomBase = $this->M_stock_movement->getUomData($product_uom);
       
        $child = false;
        
        while ($newUomBase != null){
            if($newUomBase->product_d_uom_base == $uom){
                $child = true;
            }
            $newUomBase = $this->M_stock_movement->getUomData($newUomBase->product_d_uom_base);
            // var_dump($newUomBase);
            // exit;
        }
        // var_dump($child);
        // exit;
        return $child;

    }

    


}
