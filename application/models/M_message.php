<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_message extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function selectRow(): array
    {
        return [
            'tc.*',
            'mk.nik',
            'mk.nama',
            'mk.no_handphone',
            'ts.date_transaction',
            'ts.time_transaction'
        ];
    }

    public function queryData($num="", $offset="")
    {
        $this->db->select($this->selectRow());
        $this->db->from('tc_queue tc');
        $this->db->join('tc_schedule ts','tc.schedule_id = ts.id');
        $this->db->join('ms_kpm mk','tc.kpm_id = mk.id');
        $this->db->where('tc.queue_no !=', "");
        $this->db->where('ts.status', 1);
        $this->db->where('tc.status', 1);
        $this->db->order_by('ts.date_transaction', 'ASC');
        if($num != "" || $offset != ""){
            $this->db->limit($num, $offset);
        }
        return $this->db->get();
    }

    public function queryDataFilter($num="", $offset="", $filter=[])
    {
        $this->db->select($this->selectRow());
        $this->db->from('tc_queue tc');
        $this->db->join('tc_schedule ts','tc.schedule_id = ts.id');
        $this->db->join('ms_kpm mk','tc.kpm_id = mk.id');
        $this->db->join('ms_drop_point md','ts.drop_point_id = md.id');
        $this->db->join('ms_zonasi mz','md.zonasi_id = mz.id');
        $this->db->where('tc.queue_no !=', "");
        $this->db->where('ts.status', 1);
        $this->db->where('tc.status', 1);
        $this->db->order_by('ts.date_transaction', 'ASC');
        foreach ($filter as $key => $value){
            if($value != ""){
                $this->db->where($key, $value);
            }
        }
        $this->db->order_by('ts.date_transaction', 'ASC');
        if($num != "" || $offset != ""){
            $this->db->limit($num, $offset);
        }
        return $this->db->get();
    }

    public function getCountData(){
        return $this->queryData()->num_rows();
    }

    public function getCountFilterData(){
        return $this->queryDataFilter()->num_rows();
    }

    public function getData($num, $offset){
        return $this->queryData($num, $offset)->result();
    }

    public function getFilterData($num, $offset, $filter){
        return $this->queryDataFilter($num, $offset, $filter)->result();
    }

    public function postAddSchedule($data)
    {
        $query = $this->db->insert('tc_schedule', $data);
        return $query;
    }

    public function postEditSchedule($data, $id){
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('tc_schedule');
        return $this->db->affected_rows();
    }

    public function getDropPointName($id){
        $this->db->select('nama');
        return $this->db->get_where('ms_drop_point', ['id' => $id])->row()->nama;
    }

    public function getDataDropPoint($filter){
        $this->db->select(['dp.nama','dp.id'])
            ->from(
                'ms_drop_point dp')
            ->join(
                'ms_zonasi mz', 'dp.zonasi_id = mz.id'
        );
        $this->db->where('dp.status', 1);
        foreach ($filter as $f => $v){
            $this->db->where($f,$v);
        }

        return $this->db->get()->result();
    }

    public function getCountQueue($schedule_id){
        return $this->db->get_where('tc_queue', ['schedule_id' => $schedule_id])->num_rows();
    }

    public function getDataEdit($id){
        $this->db->select($this->selectRow());
        $this->db->from('ms_drop_point md');
        $this->db->join('tc_schedule ts','md.id = ts.drop_point_id');
        $this->db->join('ms_zonasi mz','mz.id = md.zonasi_id');
        $this->db->where('md.status', 1);
        $this->db->where('ts.status', 1);
        $this->db->where('ts.id', $id);

        return $this->db->get()->row();
    }
}
