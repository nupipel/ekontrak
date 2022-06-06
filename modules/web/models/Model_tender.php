<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_tender extends CI_Model
{
    //set nama tabel yang akan kita tampilkan datanya
    var $table = 'v_tender';
    //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
    var $column_order = array(
        null,
        'nama_satker',
        'nama_paket',
        'kd_rup_paket',
        'kd_nontender',
        'no_kontrak',
        'tgl_kontrak',
        'pagu',
        'nilai_kontrak',
        'nama_penyedia',
        'tgl_mulai_kerja_spmk',
        'tgl_selesai_kerja_spmk',
        'no_bast',
        'tgl_bast',
    );

    var $column_search = array(
        'nama_satker',
        'nama_paket',
        'kd_rup_paket',
        'kd_nontender',
        'no_kontrak',
        'tgl_kontrak',
        'pagu',
        'nilai_kontrak',
        'nama_penyedia',
        'tgl_mulai_kerja_spmk',
        'tgl_selesai_kerja_spmk',
        'no_bast',
        'tgl_bast',
    );
    // default order 
    var $order = array('created_at' => 'desc');

    public function __construct()
    {
        // $this->db_bappeda = $this->load->database('bappeda', true);
        $this->db_pusat = $this->load->database('pusat', true);
    }

    function dataTableTender()
    {
        $this->_get_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db_pusat->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db_pusat->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db_pusat->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db_pusat->from($this->table);
        return $this->db_pusat->count_all_results();
    }

    private function _get_datatables_query()
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
