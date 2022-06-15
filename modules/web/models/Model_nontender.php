<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_nontender extends CI_Model
{
    //set nama tabel yang akan kita tampilkan datanya
    var $table = 'v_non_tender';
    //set kolom order, kolom pertama saya null untuk kolom NOMORs
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

    function dataTableNonTender()
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
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        $this->db_pusat->from($this->table);
        if ($opd) {
            $this->db_pusat->where('kd_satker', $opd);
        }
        if ($year) {
            $this->db_pusat->where('tahun_anggaran', $year);
        }
        $this->db_pusat->group_by('kd_nontender');

        return $this->db_pusat->count_all_results();
    }

    private function _get_datatables_query()
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        $this->db_pusat->from($this->table);
        if ($opd) {
            $this->db_pusat->where('kd_satker', $opd);
        }
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
        $this->db_pusat->group_by('kd_nontender');


        // jika datatable mengirim POST untuk order
        if ($this->input->post('order')) {
            $this->db_pusat->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db_pusat->order_by(key($order), $order[key($order)]);
        }
    }

    function get_status()
    {
        $paketSelesai   = $this->db_pusat->select('count(distinct (kd_nontender)) as total')->from('non_tender_selesai_detail_spses')->get()->row();
        $totalPaket     =  $this->db_pusat->select('count(distinct (kd_nontender)) as total')->get('v_non_tender')->row();
        $paketProses    = $totalPaket->total - $paketSelesai->total;
        $result = [
            // tata letak object dibawah harus urut (ini menentukan tampilan di front end)
            'proses'    => (int)$paketProses,
            'selesai'   => (int)$paketSelesai->total,
            'persen_proses'     => $paketProses / $totalPaket->total * 100,
            'persen_selesai'    => $paketSelesai->total / $totalPaket->total * 100,
            'total'     => (int)$totalPaket->total,

        ];
        return $result;
    }
}
