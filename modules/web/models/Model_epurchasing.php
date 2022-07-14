<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_epurchasing extends CI_Model
{
    //set nama tabel yang akan kita tampilkan datanya
    var $table = 'paket_e_purchasings';
    //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
    var $column_order = array(null, 'tahun_anggaran', 'nama_satker', 'kd_rup', 'nama_paket');

    var $column_search = array('tahun_anggaran', 'nama_satker', 'nama_paket');
    // default order 
    var $order = array('tahun_anggaran' => 'desc');

    public function __construct()
    {
        // $this->db_bappeda = $this->load->database('bappeda', true);
        $this->db_pusat = $this->load->database('pusat', true);
    }

    function status_epur()
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');
        $getID = null;
        if ($opd) {
            $getID = $this->getSatkerID($opd);
            // $filterID = $this->db_pusat->where('satker_id', $getID);
        }

        $subQuery = $this->db_pusat->from('paket_e_purchasings');
        if ($getID) {
            $subQuery->where("satker_id", $getID);
        }
        if ($year) {
            $subQuery->where('tahun_anggaran', $year);
        }
        $subQuery->group_by('kd_paket');
        $subQuery = $subQuery->get_compiled_select();

        $paketSelesai = $this->db_pusat->select('count(p.kd_paket) as total')
            ->from("($subQuery) as p")
            ->where("p.paket_status_str", 'Paket Selesai')->get()->row();
        $selesai = $paketSelesai->total;


        $paketProses = $this->db_pusat->select('count(p.kd_paket) as total')
            ->from("($subQuery) as p")
            ->where("p.paket_status_str", 'Paket Proses')->get()->row();
        $proses = $paketProses->total;


        $total = $paketSelesai->total + $paketProses->total;

        if ($total > 0) {
            $persProses = $proses / $total * 100;
            $persSelesai = $selesai / $total * 100;
        } else {
            $persProses = 0;
            $persSelesai = 0;
        }

        return [
            'proses'    => (int)$proses,
            'selesai'   => (int)$selesai,
            'total'     => (int)$total,
            'persen_proses'     => $persProses,
            'persen_selesai'    => $persSelesai,
        ];
    }

    private function getSatkerID($id)
    {
        $get = $this->db_pusat->get_where('master_satker_rups', ['kd_satker_str' => $id])->row();
        $this->db_pusat->flush_cache();
        return $get->kd_satker;
    }

    function dataTableEpur()
    {
        $this->_epurchasing_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db_pusat->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db_pusat->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_epurchasing_datatables_query();
        $query = $this->db_pusat->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');
        $filterID = null;
        if ($opd) {
            $getID = $this->getSatkerID($opd);
            $filterID = $this->db_pusat->where('satker_id', $getID);
        }

        $this->db_pusat->from($this->table);
        $filterID;
        if ($year) {
            $this->db_pusat->where('tahun_anggaran', $year);
        }
        $this->db_pusat->group_by('kd_paket');

        return $this->db_pusat->count_all_results();
    }

    private function _epurchasing_datatables_query()
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');
        $filterID = null;
        if ($opd) {
            $getID = $this->getSatkerID($opd);
            $filterID = $this->db_pusat->where('satker_id', $getID);
        }
        $this->db_pusat->from($this->table);
        $filterID;
        if ($year) {
            $this->db_pusat->where('tahun_anggaran', $year);
        }

        $i = 0;
        foreach ($this->column_search as $item) // loop kolom 
        {
            if ($this->input->post('search')['value']) // jika datatable mengirim POST untuk search
            {
                if ($i === 0) // looping pertama
                {
                    $this->db_pusat->group_start();
                    $this->db_pusat->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db_pusat->or_like($item, $this->input->post('search')['value']);
                }
                if (count($this->column_search) - 1 == $i) //looping terakhir
                    $this->db_pusat->group_end();
            }
            $i++;
        }
        $this->db_pusat->group_by('kd_rup');


        // jika datatable mengirim POST untuk order
        if ($this->input->post('order')) {
            $this->db_pusat->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db_pusat->order_by(key($order), $order[key($order)]);
        }
    }
}
