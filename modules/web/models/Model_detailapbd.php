<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_monev extends CI_Model
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
}
