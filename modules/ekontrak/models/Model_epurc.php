<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_epurc extends CI_Model
{
    public function __construct()
    {
        $this->db_pusat = $this->load->database('pusat', true);
    }

    function sirup($params, $opd = null, $year = null)
    {
        $params == 'paket' ? $select = 'count(idrup)' : $select = 'sum(jumlahpagu)';
        $query = $this->db_pusat->select($select . ' as total')->where_in('metodepengadaan', ['e-Purchasing']);
        $this->filter_query($opd, $year);

        $result = $query->get('paket_penyedia_opt1618s')->row();
        return $result->total;
    }

    function filter_query($opd = null, $year = null)
    {
        if ($opd) {
            $this->db_pusat->where('kodesatker', $opd);
        }
        if ($year) {
            $this->db_pusat->where('tahunanggaran', $year);
        }
    }

    function proses($params, $opd, $year)
    {
        $params == 'paket' ?  $select = "" : $select = 'sum(total_harga) as total';

        $q1 = $this->db_pusat->select($select)->from('paket_e_purchasings');

        // filters 
        $year ? $q1->where('tahun_anggaran', $year) : null;
        $opd ? $q1->where('kd_satker', $opd) : null;

        if ($params == 'paket') {
            $result = $q1->get()->num_rows();
        } else {
            $result = $q1->get()->row();
            $result = $result->total;
        }
        return $result;
    }

    function kontrak($params, $opd, $year)
    {
        $params == 'paket' ?  $select = "" : $select = 'sum(total_harga) as total';

        $q1 = $this->db_pusat->select($select)->from('paket_e_purchasings');

        // filters 
        $year ? $q1->where('tahun_anggaran', $year) : null;
        $opd ? $q1->where('kd_satker', $opd) : null;
        $q1->where('status_paket', 'melakukan_pengiriman_dan_penerimaan');

        if ($params == 'paket') {
            $result = $q1->get()->num_rows();
        } else {
            $result = $q1->get()->row();
            $result = $result->total;
        }
        return $result;
    }

    function selesai($params, $opd, $year)
    {
        $params == 'paket' ?  $select = "" : $select = 'sum(total_harga) as total';

        $q1 = $this->db_pusat->select($select)->from('paket_e_purchasings');

        // filters 
        $year ? $q1->where('tahun_anggaran', $year) : null;
        $opd ? $q1->where('kd_satker', $opd) : null;
        $q1->where('status_paket', 'paket_selesai');


        if ($params == 'paket') {
            $result = $q1->get()->num_rows();
        } else {
            $result = $q1->get()->row();
            $result = $result->total;
        }
        return $result;
    }
}
