<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_audit_trail extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

//  function getData($num, $offset)
//  {
//      $this->db->order_by('create_date','desc');
//    $query = $this->db->get("audit_trail", $num, $offset);
//
//    return $query->result();
//  }

    function queryData($params = [], $num = "", $offset = "")
    {
        $this->db->select([
            'at.*',
            'mu.name'
        ]);
        $this->db->from('audit_trail at');
        $this->db->join('ms_user mu', 'at.user_id = mu.id');
        if ($params) {
            foreach ($params as $key => $value) {
                $this->db->like($key, $value);
            }
        }
        if ($num != "" || $offset != "") {
            $this->db->limit($num, $offset);
        }
        $this->db->order_by('at.create_date', 'desc');
        return $this->db->get();
    }

    function getData($value_filter, $num, $offset)
    {
        return $this->queryData($value_filter, $num, $offset)->result();
    }

    function getDataCount($value_filter)
    {
        return $this->queryData($value_filter)->num_rows();
    }

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
        $this->db->order_by('create_date', 'desc');
        $this->db->limit('5');
        $query = $this->db->get('view_report_selisih_lmd');
        return $query->result();
    }


}