<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_landing extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function totalKPMTagging(){
        $this->db->select(
            'COUNT(id) as total'
        );
        return $this->db->get_where('tc_queue', ['status !=' => 0])->row()->total;
    }


    public function totalCompletedKPM(){
        $this->db->select(
            'COUNT(id) as total'
        );
        return $this->db->get_where('tc_queue', ['status' => 3])->row()->total;
    }

    public function totalFund(){
        $this->db->select(
            'SUM(debit) as total'
        );
        return $this->db->get_where('tc_mutation', ['status' => 1])->row()->total;
    }

    public function totalDistribute(){
        $this->db->select(
            'SUM(kredit) as total'
        );
        return $this->db->get_where('tc_mutation', ['status' => 1])->row()->total;
    }

    public function totalDropPoint(){
        $this->db->select(
            'COUNT(id) as total'
        );
        return $this->db->get_where('ms_drop_point', ['status' => 1])->row()->total;
    }

    public function totalQueue(){
        $this->db->select(
            'COUNT(id) as total'
        );
        return $this->db->get_where('tc_queue', ['status !=' => 0, 'queue_no !=' => null])->row()->total;
    }

    public function queryDataRatingKSM($sort){
        $this->db->select([
            'COUNT(tc.id) as count',
            'mz.provinsi'
        ]);
        $this->db->from('tc_queue tc');
        $this->db->join('tc_schedule ts','tc.schedule_id = ts.id');
        $this->db->join('ms_drop_point md','ts.drop_point_id = md.id');
        $this->db->join('ms_zonasi mz','md.zonasi_id = mz.id');
        $this->db->where('tc.status !=', 0);
        $this->db->group_by('mz.provinsi');
        $this->db->order_by('count', $sort);
        $this->db->limit(5);

        return $this->db->get()->result();
    }

}
