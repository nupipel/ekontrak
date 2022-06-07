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
        $paketSelesai = $this->db_pusat->query("select count(p.kd_paket) as total from (select kd_paket, paket_status_str from paket_e_purchasings group by kd_paket) as p where p.paket_status_str = 'Paket Selesai'")->row();
        $paketProses = $this->db_pusat->query("select count(p.kd_paket) as total from (select kd_paket, paket_status_str from paket_e_purchasings group by kd_paket) as p where p.paket_status_str = 'Paket Proses'")->row();

        $total = $paketSelesai->total + $paketProses->total;

        return [
            'proses'    => $paketProses->total,
            'selesai'   => $paketSelesai->total,
            'total'     => $total,
            'persen_proses'     => $paketProses->total / $total * 100,
            'persen_selesai'    => $paketSelesai->total / $total * 100,
        ];
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
        $this->db_pusat->from($this->table);
        return $this->db_pusat->count_all_results();
    }

    private function _epurchasing_datatables_query()
    {
        $this->db_pusat->from($this->table);
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

        // jika datatable mengirim POST untuk order
        if ($this->input->post('order')) {
            $this->db_pusat->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db_pusat->order_by(key($order), $order[key($order)]);
        }
    }
}
