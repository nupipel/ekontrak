<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_detailapbd extends CI_Model
{
    //set nama tabel yang akan kita tampilkan datanya
    var $table = 'apbd_anggaran';
    //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
    var $column_order = array(null);

    var $column_search = array(null);
    // default order 
    var $order = array(null);

    public function __construct()
    {
        $this->db_bappeda = $this->load->database('bappeda', true);
        // $this->db_pusat = $this->load->database('pusat', true);
    }

    function dataTableRealisasi()
    {
        $this->_get_datatables_query($this->input->post('year'));
        if ($this->input->post('length') != -1)
            $this->db_bappeda->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db_bappeda->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query($this->input->post('year'));
        $query = $this->db_bappeda->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db_bappeda->select('aa.*, du.nama_skpd');
        $this->db_bappeda->from($this->table);
        $this->db_bappeda->join('data_unit du', 'du.id_skpd = aa.id_skpd', 'LEFT');
        $this->db_bappeda->where('aa.tahun', $this->input->post('year'));
        return $this->db_bappeda->count_all_results();
    }

    private function _get_datatables_query($year = null)
    {
        $this->db_bappeda->select('aa.*, du.nama_skpd');
        $this->db_bappeda->from($this->table);
        $this->db_bappeda->join('data_unit du', 'du.id_skpd = aa.id_skpd', 'LEFT');
        $this->db_bappeda->where('aa.tahun', $year);
        $i = 0;
        foreach ($this->column_search as $item) // loop kolom 
        {
            if ($this->input->post('search')['value']) // jika datatable mengirim POST untuk search
            {
                if ($i === 0) // looping pertama
                {
                    $this->db_bappeda->group_start();
                    $this->db_bappeda->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db_bappeda->or_like($item, $this->input->post('search')['value']);
                }
                if (count($this->column_search) - 1 == $i) //looping terakhir
                    $this->db_bappeda->group_end();
            }
            $i++;
        }

        // jika datatable mengirim POST untuk order
        if ($this->input->post('order')) {
            $this->db_bappeda->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db_bappeda->order_by(key($order), $order[key($order)]);
        }
    }




    function listSubKegiatan($id = null, $year = null)
    {
        // LIST SUBKEGIATAN
        $q1 = $this->db_bappeda->select('a.id_subkegiatan, b.kode, b.uraian as nama_kegiatan')->from('data_rka a')
            ->join('tampung_exel_subkegiatan b', 'b.id = a.id_subkegiatan')
            ->where('a.id_skpd', $id)
            ->where('tahun', $year)
            ->group_by('a.id_subkegiatan')->get();

        return $q1->result();
    }

    function listKodeAkun($id, $idskpd = null, $year = null)
    {

        // select id_subkegiatan, kode_akun  from data_rka dr where id_skpd = 55 && tahun = 2022 && id_subkegiatan = 1257 group by kode_akun 

        $q1 = $this->db_bappeda->select('a.kode_akun, b.nama_akun')
            ->from('data_rka a')
            ->join('akun_baru b', 'a.kode_akun = b.kode_akun', 'left')
            ->where('a.id_subkegiatan', $id)
            ->where('a.id_skpd', $idskpd)
            ->where('a.tahun', $year)
            ->group_by('a.kode_akun')->get()->result();

        return $q1;
    }

    function detailAkun($kodeakun, $idsubkegiatan, $idskpd, $year)
    {
        $q1 = $this->db_bappeda->select('subs_bl_teks as subs, ket_bl_teks as ket')
            ->from('data_rka')
            ->where('id_skpd', $idskpd)
            ->where('tahun', $year)
            ->where('id_subkegiatan', $idsubkegiatan)
            ->where('kode_akun', $kodeakun)->get()->result();

        return $q1;
    }
    function getAlldataRka($idkegiatan, $p1, $p2, $idskpd, $year)
    {
        $q1 = $this->db_bappeda->query("select
            a.nama_komponen,
            (a.harga_satuan * a.vol_1 *(if(a.vol_2>0,a.vol_2,1))*(if(a.vol_3>0,a.vol_3,1))*(if(a.vol_4>0,a.vol_4,1))) as total
            
        from
            `data_rka` a
        left join akun_baru b on
            b.kode_akun = a.kode_akun
        left join tampung_exel_subkegiatan c on
            c.id = a.id_subkegiatan
        left join tampung_exel_kegiatan d on c.id_kegiatan = d.id 
        where
            d.id = $idkegiatan and
            a.`id_skpd` = $idskpd and 
            a.tahun = $year and 
            a.subs_bl_teks = '$p1' and 
            a.ket_bl_teks = '$p2'")->result();

        return $q1;
    }
}
