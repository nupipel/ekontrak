<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_home_front extends CI_Model
{
    public $db_bappeda;

    public function __construct()
    {
        $this->db_bappeda = $this->load->database('bappeda', true);
        $this->db_pusat = $this->load->database('pusat', true);
    }
    public function get_infoumum()
    {
        $query = $this->db->select("*")
            ->from('infoumum')
            ->where('id', '1')

            ->get();
        return $query->result_array();
    }

    function list_instansi()
    {
        return $this->db_pusat->order_by('nama_satker')->get('master_satker_rups')->result();
    }

    public function total_anggaran()
    {
        $this->db_bappeda->select('sum(aa.anggaran) as total_anggaran')
            ->from('apbd_anggaran aa');
        $q =  $this->db_bappeda->get();
        return $q->row();
    }

    public function total_pendapatan()
    {
        $this->db_bappeda->select('sum(aa.anggaran) as total_pendapatan')
            ->from('a_apbd_pendapatan aa');
        $q =  $this->db_bappeda->get();
        return $q->row();
    }

    public function list_e_purchasing()
    {
        $this->db_pusat->select('*')
            ->from('paket_e_purchasings');
        $q =  $this->db_pusat->get();
        return $q->row();
    }

    public function listpendapatan($limit = null)
    {
        $this->db_bappeda->select('du.nama_skpd as nama, sum(aa.anggaran) as anggaran, sum(aa.anggaran_pergeseran) as anggaran_pergeseran, sum(aa.anggaran_perubahan) as anggaran_perubahan')
            ->from('a_apbd_pendapatan aa')
            ->join('data_unit du', 'du.id_skpd = aa.id_skpd', 'LEFT')
            ->group_by('aa.id_skpd')
            ->order_by('anggaran', 'desc');
        if ($limit) {
            $this->db_bappeda->limit($limit);
        };
        $q =  $this->db_bappeda->get();
        return $q->result();
    }

    public function listApbd_OPD($limit = null)
    {
        $this->db_bappeda->select('aa.id_skpd as id, du.nama_skpd as nama, sum(aa.anggaran) as anggaran, sum(aa.anggaran_pergeseran) as anggaran_pergeseran, sum(aa.anggaran_perubahan) as anggaran_perubahan')
            ->from('apbd_anggaran aa')
            ->join('data_unit du', 'du.id_skpd = aa.id_skpd', 'LEFT')
            ->group_by('aa.id_skpd')
            ->order_by('anggaran', 'desc');
        if ($limit) {
            $this->db_bappeda->limit($limit);
        };
        $q =  $this->db_bappeda->get();
        return $q->result();
    }

    function total_params($table, $col)
    {
        $this->db_pusat->select("sum($col) as nilai");
        return $this->db_pusat->get($table)->row();
    }

    function paket_params($table, $col)
    {
        $this->db_pusat->select("count(distinct ($col)) as paket");
        return $this->db_pusat->get($table)->row();
    }

    function getAPBDbyID($id, $year = null)
    {
        $this->db_bappeda->select(' aa.id_skpd as id, du.nama_skpd as nama, k.uraian, aa.anggaran, aa.anggaran_pergeseran, aa.anggaran_perubahan')
            ->from('apbd_anggaran aa')
            ->join('data_unit du', 'du.id_skpd = aa.id_skpd', 'LEFT')
            ->join('tampung_exel_subkegiatan k', 'k.id_kegiatan = aa.id_subkegiatan', 'LEFT')
            ->where('aa.id_skpd', $id)
            ->where('aa.tahun', $year)
            ->order_by('anggaran', 'desc');

        $q =  $this->db_bappeda->get()->result();
        return $q;
    }


    // public function listrealisasi($tahun)
    // {

    //     $this->db_bappeda->select('aa.*, du.nama_skpd')
    //         ->from('a_realisasi_keuangan aa')
    //         ->join('data_unit du', 'du.id_skpd = aa.id_skpd', 'LEFT')
    //         ->where('aa.tahun', $tahun)
    //         ->order_by('aa.anggaran', 'desc');

    //     $q =  $this->db_bappeda->get();
    //     return $q->result();
    // }
}
