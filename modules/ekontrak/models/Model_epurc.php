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
        $query = $this->db_pusat->select($select . ' as total')->where_in('metodepengadaan', ['e-Purchasing'])
            ->where("statusdeletepaket = '0' and statusaktifpaket = '1'");

        $opd ? $this->db_pusat->where('kodesatker', $opd) : null;
        $year ? $this->db_pusat->where('tahunanggaran', $year) : null;

        $result = $query->get('paket_penyedia_opt1618s')->row();
        return $result->total;
    }

    function proses($params, $opd, $year)
    {
        $opd ? $kd_satker = $this->_get_kode_satker_str($opd) : null;

        $params == 'paket' ?  $select = "" : $select = 'sum(total_harga) as total';

        $q1 = $this->db_pusat->select($select)->from('paket_e_purchasings');

        // filters 
        $year ? $q1->where('tahun_anggaran', $year) : null;

        $opd ? $q1->where('satker_id', $kd_satker) : null;

        $q1->group_by('kd_rup');

        if ($params == 'paket') {
            $result = $q1->get()->num_rows();
        } else {
            $result = $q1->get()->row();
            $result = $result->total ?? 0;
        }
        return $result;
    }

    function kontrak($params, $opd, $year)
    {
        $opd ? $kd_satker = $this->_get_kode_satker_str($opd) : null;
        $params == 'paket' ?  $select = "" : $select = 'sum(total_harga) as total';

        $q1 = $this->db_pusat->select($select)->from('paket_e_purchasings');

        // filters 
        $year ? $q1->where('tahun_anggaran', $year) : null;
        $opd ? $q1->where('satker_id', $kd_satker) : null;
        $q1->where('status_paket', 'melakukan_pengiriman_dan_penerimaan');
        $q1->group_by('kd_rup');


        if ($params == 'paket') {
            $result = $q1->get()->num_rows();
        } else {
            $result = $q1->get()->row();
            $result = $result->total ?? 0;
        }
        return $result;
    }

    function selesai($params, $opd, $year)
    {
        $opd ? $kd_satker = $this->_get_kode_satker_str($opd) : null;

        $params == 'paket' ?  $select = "" : $select = 'sum(total_harga) as total';

        $q1 = $this->db_pusat->select($select)->from('paket_e_purchasings');

        // filters 
        $year ? $q1->where('tahun_anggaran', $year) : null;
        $opd ? $q1->where('satker_id', $kd_satker) : null;
        $q1->where('status_paket', 'paket_selesai');
        $q1->group_by('kd_rup');

        if ($params == 'paket') {
            $result = $q1->get()->num_rows();
        } else {
            $result = $q1->get()->row();
            $result = $result->total ?? 0;
        }
        return $result;
    }

    private  function _get_kode_satker_str($id)
    {
        $q = $this->db_pusat->get_where('master_satker_rups', ['kd_satker_str' => $id])->row();

        return $q->kd_satker;
    }
}
