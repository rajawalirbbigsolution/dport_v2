<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_notif extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function queryData($num = "", $offset = "")
    {
        $this->db->select([
            'th.inv_trans_h_id as id',
            'th.inv_trans_h_number as number',
            'th.tnv_trans_h_status as status_transfer',
            'th.created_date as rt_date',
            'th.inv_trans_h_dateline as rt_dateline',
            'is.inv_storage_exp_date as exp_date',
            'w.warehouse_name as warehouse',
        ]);
        $this->db->from('tr_inv_trans_h th');
        $this->db->join('tr_inv_trans_d td', 'th.inv_trans_h_id = td.inv_trans_h_id');
        $this->db->join('tr_inv_storage is', 'td.inv_storage_id = is.inv_storage_id');
        $this->db->join('d_location l', 'is.location_id = l.location_id');
        $this->db->join('c_warehouse w', 'w.warehouse_id = l.warehouse_id');
        $this->db->group_by('th.inv_trans_h_id');
        // $this->db->group_by('l.location_type_id');
        // $this->db->where('is.status', 1);
        // $this->db->where('pds.status', 1);
        // $this->db->where('w.warehouse_id', $this->session->userdata('warehouse_id'));

        // echo $this->session->userdata('warehouse_id');
        // die;

        if ($num != "" || $offset != "") {
            $this->db->limit($num, $offset);
        }

        return $this->db->get();
    }
  public function getCountData()
  {
    return $this->queryData()->num_rows();
  }

  public function getData($num, $offset)
  {
    return $this->queryData($num, $offset)->result();
  }

  // function getData($num, $offset)
  // {

  //   $query = $this->db->get("view_report_selisih_lmd", $num, $offset);

  //   return $query->result();
  // }


  function insertAuditTrail($data)
  {
    $this->db->insert('audit_trail', $data);

    return $this->db->insert_id();
  }

  function checkUser($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('ms_user');
    return $query->row();
  }

  function countNotifikasiWeb()
  {
    $sql = 'select * from tc_order_detail where is_minus = 1 or is_damage = 1';
    $query = $this->db->query($sql);
    return $query->result();
  }

  function listNotifikasiWebModel()
  {
    /*    $this->db->where('is_minus','1');
    $this->db->or_where('is_damage','1');
*/
    $this->db->order_by('create_date', 'desc');
    $this->db->limit('5');
    $query = $this->db->get('view_report_selisih_lmd');
    return $query->result();
  }

  function updateDataNotif($id)
  {
    $this->db->set('is_damage', 2);
    $this->db->set('is_minus', 2);
    $this->db->set('difference', 0);
    $this->db->where('id', $id);
    $this->db->update('tc_order_detail');
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  function getDataStockMin($num, $offset)
  {
    $sql = "SELECT aa.*,bb.min_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.stock <= bb.min_stock
      limit ".$num." offset ".$offset;
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getDataStockSafe($num, $offset)
  {
    $sql = "SELECT aa.*,bb.safety_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.stock >= bb.min_stock and aa.stock <= bb.safety_stock
      limit ".$num." offset ".$offset;
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getDataStockMax($num, $offset)
  {
    $sql = "SELECT aa.*,bb.max_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock,dpd.max_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.stock >= bb.max_stock 
      limit ".$num." offset ".$offset;
    $query = $this->db->query($sql);
    return $query->result();
  }

  function getDataStockExp($num, $offset)
  {
    $sql = "SELECT aa.*,bb.max_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,tis.inv_storage_exp_date,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock,dpd.max_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.inv_storage_exp_date <= CURDATE()  
        limit ".$num." offset ".$offset;
      $query = $this->db->query($sql);
      return $query->result();
  }

  function getTotalNotifModel()
  {
    $sql = "SELECT aa.*,bb.safety_stock as param_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,tis.inv_storage_exp_date,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name, 'minimum' as ket 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.stock <= bb.min_stock 
      union all 
      select aa.*,bb.safety_stock as param_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,tis.inv_storage_exp_date,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name, 'Safety' as ket 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.stock >= bb.min_stock and aa.stock <= bb.safety_stock
      union all
      select aa.*,bb.max_stock as param_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,tis.inv_storage_exp_date,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name, 'maximum' as ket 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock,dpd.max_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.inv_storage_exp_date <= CURDATE()";
      $query = $this->db->query($sql);
      return $query->num_rows();
  }

  function listWebNotifModel()
  {
    $sql = "SELECT aa.*,bb.safety_stock as param_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,tis.inv_storage_exp_date,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name, 'minimum stock' as ket 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.stock <= bb.min_stock 
      union all 
      select aa.*,bb.safety_stock as param_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,tis.inv_storage_exp_date,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name, 'Safety stock' as ket 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.stock >= bb.min_stock and aa.stock <= bb.safety_stock
      union all
      select aa.*,bb.max_stock as param_stock,bb.product_h_name,bb.sku_number from (
      select tis.product_d_id,tis.inv_storage_exp_date,(sum(tis.qty)-sum(tis.qty_out)) as stock,dl.location_name, 'maximum stock' as ket 
          from tr_inv_storage tis 
          join d_location dl on tis.location_id = dl.location_id 
          group by product_d_id,inv_storage_exp_date,inv_storage_batch,inv_storage_serial) aa
        join	
      (select dph.product_h_name,dph.sku_number, dpd.product_d_id,dpd.min_stock,dpd.safety_stock,dpd.max_stock from d_product_d dpd
        join d_product_h dph on dpd.product_h_id = dph.product_h_id) bb on aa.product_d_id = 	bb.product_d_id	
      where aa.inv_storage_exp_date <= CURDATE()
      limit 5";
      $query = $this->db->query($sql);
      return $query->result();
  } 
  
  
}
