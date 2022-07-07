<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_chartopd extends CI_Model
{
    public function __construct()
    {
        $this->db_pusat = $this->load->database('pusat', true);
    }

    function chart($opd, $year, $method)
    {

        $this->db->select("*")->where(['tahun' => $year, 'metode_pengadaan' => $method]);
        if ($opd) {
            $this->db->where('kode_opd', $opd);
        }
        $q1 = $this->db->get('chart_opd')->result();
        return $q1;
    }

    function rangeMonth($opd, $year, $method)
    {
        $this->db->select("max(bulan) as maxBulan")->where(['tahun' => $year, 'metode_pengadaan' => $method]);
        if ($opd) {
            $this->db->where('kode_opd', $opd);
        }
        $q1 = $this->db->get('chart_opd')->row();
        return $q1;
    }

    function post_chart_opd($data)
    {
        if ($this->db->insert('chart_opd', $data)) {
            return [
                'success' => true
            ];
        } else {
            return [
                'success'   => false,
                'msgErr'    => $this->db->error()
            ];
        }
    }
}
