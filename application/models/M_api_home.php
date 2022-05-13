<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_api_home extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function profile($id)
    {
        $this->db->select('*');
        $this->db->from('ms_user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function getGrListModel($limit,$offset,$value,$params)
    {
        $sql = "SELECT bb.po_header_id,aa.gr_header_number,aa.receive_date,bb.po_header_number,bb.supplier_name,CONCAT(COALESCE(dd.Inspected,0),'/',COALESCE(cc.total_product,0)) as inspec_total from (
            (select tph.po_header_id,tph.po_header_number,tph.supplier_id,ds.supplier_name from tr_po_header tph 
                        left join d_supplier ds on tph.supplier_id = ds.supplier_id)) bb
            left join 
            (select tgh.gr_header_id,tgh.gr_header_number,tgh.receive_date,tgh.po_header_id from tr_gr_header tgh  ) aa on aa.po_header_id = bb.po_header_id
                left join 
            (select count(tpd.po_detail_id) as total_product,tpd.po_detail_id,tpd.po_header_id from tr_po_detail tpd where tpd.status != 0 group by tpd.po_header_id) cc on bb.po_header_id = cc.po_header_id	
            left join 
            (select COUNT(tgd.gr_detail_id) as Inspected,tgd.gr_header_id,tgh2.po_header_id from tr_gr_detail tgd
            	join tr_gr_header tgh2 on tgd.gr_header_id = tgh2.gr_header_id where tgd.status = 1 group by tgh2.po_header_id ) dd on aa.po_header_id = dd.po_header_id 
            where COALESCE(dd.Inspected,0) != COALESCE(cc.total_product,0)
            	and CONCAT(COALESCE(dd.Inspected,0),'/',COALESCE(cc.total_product,0)) != '0/0'
                and ".$params." like '%".$value."%'
                 group by bb.po_header_id
            limit ".$limit." offset ".$offset;
        $query = $this->db->query($sql);
        return $query->result();    
    }

    function getGrProductSelection($po_header_id)
    {
        $sql = "SELECT aa.po_detail_id,bb.product_h_name,bb.sku_number,bb.upc_number,aa.product_d_id from (
            select tpd.po_detail_id,tpd.product_d_id,tpd.po_header_id from tr_po_detail tpd where tpd.status = 1 ) aa
            left join 
            (select dpd.product_d_id ,dph.product_h_name,dph.sku_number,dpds.upc_number from d_product_d dpd 
                    left join d_product_h dph on dpd.product_h_id = dph.product_h_id 
                    left join d_product_d_supplier dpds on dpd.product_h_id = dpds.product_h_id) bb on aa.product_d_id = bb.product_d_id 
                where aa.po_header_id = ?
                group by aa.po_detail_id";
        $query = $this->db->query($sql,[$po_header_id]);
        return $query->result(); 
    }

    function detailProductGr($po_detail_id)
    {
        $sql = "SELECT tpd.po_detail_id,dpd.product_d_id,dpd.product_h_id,dpd.product_d_uom_id,dpd.colour,dpd.weight,dpd.size,
        dph.sku_number ,dph.product_h_name,cpch.prod_cat_h_name as category,cpcs.prod_cat_sub_1_name as category_sub,
        cu.uom_name,tpd.po_detail_qty as po_qty,aa.upc_number,cpcs2.prod_cat_sub_2_name as category_class,cpcs3.prod_cat_sub_3_name as category_class_sub
        from d_product_d dpd 
        left join d_product_h dph on dpd.product_h_id = dph.product_h_id 
        left join c_prod_cat_h cpch on dph.prod_cat_h_id = cpch.prod_cat_h_id 
        left join c_prod_cat_sub_1 cpcs on cpch.prod_cat_h_id = cpcs.prod_cat_h_id
        left join c_prod_cat_sub_2 cpcs2 on cpcs.prod_cat_sub_1_id = cpcs2.prod_cat_sub_1_id 
        left join c_prod_cat_sub_3 cpcs3 on cpcs2.prod_cat_sub_2_id = cpcs3.prod_cat_sub_2_id 
        left join d_product_d_uom dpdu on dpd.product_d_uom_id = dpdu.product_d_uom_id 
        left join c_uom cu on dpdu.product_d_uom_qty = cu.uom_id 
        left join tr_po_detail tpd on dpd.product_d_id = tpd.product_d_id 
        left join d_product_d_supplier aa on dpd.product_h_id  = aa.product_h_id 
        where tpd.po_detail_id = ? ";
        $query = $this->db->query($sql,[$po_detail_id]);
        return $query->row();

    }

    function CheckData($po_detail_id)
    {
        $sql = "SELECT tpd.po_detail_id,tpd.po_header_id,tpd.po_detail_qty,tpd.product_d_id from tr_po_detail tpd
        join tr_po_header tph on tph.po_header_id = tpd.po_header_id
        where tpd.po_detail_id = ?";
        $query = $this->db->query($sql,[$po_detail_id]);
        return $query->row();
    }

    function insertGrHeadModel($data)
    {
        $this->db->insert('tr_gr_header', $data);
	    return $this->db->insert_id();
    }

    function insertGrDetail($data)
    {
        $this->db->insert('tr_gr_detail', $data);
	    return $this->db->insert_id();
    }


    function getListInventory($param,$limit,$offset)
    {
        $sql = "SELECT xx.*,vv.*,nn.* from (
            select inv_move_id,inv_move_number,location_storage_id,new_location_storage_id from tr_inv_move tim ) xx
            join 
           (select aa.*,bb.product_h_name from (
            select tis.inv_storage_id,tis.location_id,tis.product_d_id,
                        dl.location_name ,tis.qty
                            from tr_inv_storage tis
                                left join d_location dl on tis.location_id = dl.location_id ) aa
                join 
                (select dpd.product_d_id,dph.product_h_name from d_product_d dpd 
                            join d_product_h dph ON dpd.product_h_id = dph.product_h_id ) bb on aa.product_d_id = bb.product_d_id
                            group by aa.inv_storage_id) vv on xx.location_storage_id = vv.inv_storage_id	
                join 
                (select aa.*,bb.product_h_name as product_name_to from (
            select tis.inv_storage_id as inv_storage_id_to ,tis.location_id as location_id_to,tis.product_d_id as product_d_id_to,
                        dl.location_name as location_name_to,tis.qty as qty_to 
                            from tr_inv_storage tis
                                left join d_location dl on tis.location_id = dl.location_id ) aa
                join 
                (select dpd.product_d_id,dph.product_h_name from d_product_d dpd 
                            join d_product_h dph ON dpd.product_h_id = dph.product_h_id ) bb on aa.product_d_id_to = bb.product_d_id
                            group by aa.inv_storage_id_to) nn on xx.new_location_storage_id = nn.inv_storage_id_to
                            where xx.inv_move_number LIKE "."'%".$param."%'
                            limit ".$limit." offset ".$offset;
            $query = $this->db->query($sql);
            return $query->result();
    }

    function getLocationModel()
    {
        $sql = "SELECT dl.location_id,dl.location_name from d_location dl where dl.status != 0";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getProductByLocationIdModel($location)
    {
        $sql = "SELECT bb.product_h_id,aa.location_id,aa.product_d_id,aa.qty,bb.sku_number,bb.product_h_name,aa.inv_storage_exp_date,aa.inv_storage_batch,
        aa.inv_storage_serial, 0 as qty_move,bb.product_d_supplier_id,bb.product_d_uom_id as uom_id,bb.product_d_uom_name as uom_name,0 as confirmed_quantity
        from (
       SELECT tis.location_id,tis.product_d_id ,sum(tis.qty) as qty,tis.inv_storage_exp_date,tis.inv_storage_batch,tis.inv_storage_serial
        from tr_inv_storage tis 
       group by tis.product_d_id,tis.location_id,tis.inv_storage_exp_date,tis.inv_storage_batch,tis.inv_storage_serial) aa
        join 
       (select dpd.product_d_id,dph.product_h_name,dph.sku_number,dpds.product_d_supplier_id,dph.product_h_id,dpd.product_d_uom_id,dpdu.product_d_uom_name from d_product_d dpd 
              left join d_product_h dph ON dpd.product_h_id = dph.product_h_id
              left join d_product_d_supplier dpds ON dpd.product_h_id = dpds.product_h_id
              left join d_product_d_uom dpdu on dpd.product_d_uom_id = dpdu.product_d_uom_id 
              group by dpd.product_d_id) bb on aa.product_d_id = bb.product_d_id
               where aa.location_id = ?";
        $query = $this->db->query($sql,[$location]);
        return $query->result();
    }

    function insertStorageModel($data)
    {
        $this->db->insert('tr_inv_storage', $data);
	    return $this->db->insert_id();
    }

    function insertMovementModel($data)
    {
        $this->db->insert('tr_inv_move', $data);
	    return $this->db->insert_id();
    }

    function updateStatusPoModel($po_detail_id)
    {
        $this->db->set('status',2);
        $this->db->where('po_detail_id', $po_detail_id);
        $this->db->update('tr_po_detail');
        return $this->db->affected_rows(); 
    }

    function getListOutBoundModel($limit,$offset)
    {
        $sql = "SELECT tdh.do_header_id,tdh.do_number,tdh.do_header_date,tdh.so_header_id,
                tsh.so_header_id,dch.client_h_name,dch2.customer_h_name,deh.exp_h_name,tdh.status 
                from tr_do_header tdh  
                left join tr_so_header tsh on tdh.so_header_id = tsh.so_header_id 
                left join d_client_h dch on tsh.client_h_id = dch.client_h_id 
                left join d_customer_h dch2 on tsh.customer_h_id = dch2.customer_h_id 
                left join d_exp_h deh on tdh.exp_h_id = deh.exp_h_id 
                    limit ".$limit." offset ".$offset;
        $query = $this->db->query($sql);
        return $query->result();
    }


    function getSelectDoHeaderModel($do_header_id)
    {
        $sql = "SELECT tdh.do_header_id,tdh.do_number,tsh.so_header_date,tdh.do_header_awb_num,tdh.so_header_id from tr_do_header tdh 
        left join tr_so_header tsh on tdh.so_header_id = tsh.so_header_id 
            where tdh.do_header_id = ?";
        $query = $this->db->query($sql,[$do_header_id]);
        return $query->row();
    }


    function getDetailDataDoHeader($do_header_id)
    {
        $sql = "SELECT aa.*,
                    bb.product_h_name,bb.sku_number,bb.upc_number,bb.category,bb.category_sub,bb.category_class,bb.category_class_sub,bb.colour,bb.size,bb.weight,
                    cc.location_name,cc.inv_storage_exp_date,cc.inv_storage_batch,cc.inv_storage_serial,cc.qty
            from (
            select tdh.do_header_id,tdh.so_header_id,tsd2.product_d_id from tr_do_header tdh 
                    left join tr_so_header tsh on tdh.so_header_id = tsh.so_header_id 
                    left join tr_so_detail_1 tsd on tsh.so_header_id = tsd .so_header_id 
                    left join tr_so_detail_2 tsd2 on tsd.so_detail_1_id = tsd2.so_detail_1_id ) aa
            left join		
            (select dpd.product_d_id,dph.product_h_name,dph.sku_number,dpds.upc_number,
                    cpch.prod_cat_h_name as category,cpcs.prod_cat_sub_1_name as category_sub,
                    cpcs2.prod_cat_sub_2_name as category_class,cpcs3.prod_cat_sub_3_name as category_class_sub,dpd.colour,
                    dpd.size,dpd.weight
                    from d_product_d dpd 
                    left join d_product_h dph ON dpd.product_h_id = dph .product_h_id 
                    left join d_product_d_supplier dpds on dph.product_h_id = dpds.product_h_id
                    left join c_prod_cat_h cpch on dph.prod_cat_h_id = cpch .prod_cat_h_id 
                    left join c_prod_cat_sub_1 cpcs on cpch.prod_cat_h_id = cpcs.prod_cat_h_id 
                    left join c_prod_cat_sub_2 cpcs2 on cpcs .prod_cat_sub_1_id = cpcs2.prod_cat_sub_1_id 
                    left join c_prod_cat_sub_3 cpcs3 on cpcs2.prod_cat_sub_2_id = cpcs3.prod_cat_sub_2_id ) bb on aa.product_d_id = bb.product_d_id
            left join 
            (select tis.location_id,dl.location_name ,tis.product_d_id,tis.inv_storage_exp_date,tis.inv_storage_batch,
                    tis.inv_storage_serial,sum(qty)-sum(qty_out) as qty 
                        from tr_inv_storage tis 
                        left join d_location dl on tis.location_id = dl.location_id 
                        group by tis.location_id,tis.product_d_id,tis.inv_storage_exp_date,tis.inv_storage_batch,
                    tis.inv_storage_serial) cc on aa.product_d_id = cc.product_d_id
                    where aa.product_d_id is not null
                        and aa.do_header_id = ?
                group by aa.product_d_id";
                $query = $this->db->query($sql,[$do_header_id]);
                return $query->result();
    }

    function updateDoHeaderModel($do_header_id)
    {
        $this->db->set('status',2);
        $this->db->where('do_header_id', $do_header_id);
        $this->db->update('tr_do_header');
        return $this->db->affected_rows(); 
    }

    function getDetailProductInventoryModel($product_d_id)
    {
        $sql = "SELECT aa.*,bb.* from (
            select dpd.product_d_id,dph.product_h_name,dph.sku_number,dpds.upc_number,
                cpch.prod_cat_h_name as category,cpcs.prod_cat_sub_1_name as category_sub,
                cpcs2.prod_cat_sub_2_name as category_class,cpcs3.prod_cat_sub_3_name as category_class_sub,dpd.colour,
                dpd.size,dpd.weight
                from d_product_d dpd 
                left join d_product_h dph ON dpd.product_h_id = dph .product_h_id 
                left join d_product_d_supplier dpds on dph.product_h_id = dpds.product_h_id
                left join c_prod_cat_h cpch on dph.prod_cat_h_id = cpch .prod_cat_h_id 
                left join c_prod_cat_sub_1 cpcs on cpch.prod_cat_h_id = cpcs.prod_cat_h_id 
                left join c_prod_cat_sub_2 cpcs2 on cpcs .prod_cat_sub_1_id = cpcs2.prod_cat_sub_1_id 
                left join c_prod_cat_sub_3 cpcs3 on cpcs2.prod_cat_sub_2_id = cpcs3.prod_cat_sub_2_id) aa
            
            left join 
            (select tis.location_id,dl.location_name ,tis.product_d_id as product_d_id_1 ,tis.inv_storage_exp_date,tis.inv_storage_batch,
                                tis.inv_storage_serial,sum(qty)-sum(qty_out) as qty 
                                    from tr_inv_storage tis 
                                    left join d_location dl on tis.location_id = dl.location_id 
                                    group by tis.location_id,tis.product_d_id,tis.inv_storage_exp_date,tis.inv_storage_batch,
                                tis.inv_storage_serial) bb on aa.product_d_id = bb.product_d_id_1
            where aa.product_d_id = ?
            group by aa.product_d_id";
            $query = $this->db->query($sql,[$product_d_id]);
            return $query->row();
    }

    function getUom($product_h_id)
    {
        $sql = "SELECT product_d_uom_id as uom_id,product_d_uom_name as uom_name from d_product_d_uom dpdu 
        where product_h_id = ? and status = 1";
        $query = $this->db->query($sql,[$product_h_id]);
        return $query->result();
    }

    function checkDetailUom($product_h_id,$uom_id)
    {
        $this->db->where('product_h_id',$product_h_id);
        $this->db->where('product_d_uom_id',$uom_id);
        $query = $this->db->get('d_product_d');
        return $query->row();
    }
     
    function getDetailProductDmodel($product_d_id)
    {
        $this->db->where('product_d_id',$product_d_id);
        $query = $this->db->get('d_product_d');
        return $query->row();
    }

    function insertDetailProductModel($dProduct)
    {
        $this->db->insert('d_product_d', $dProduct);
	    return $this->db->insert_id();
    }

}
