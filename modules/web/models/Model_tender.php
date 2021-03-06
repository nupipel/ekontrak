<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_tender extends CI_Model
{
    //set nama tabel yang akan kita tampilkan datanya
    var $table = 'tender_pengumuman_detail_spses';
    //set kolom order, kolom pertama saya null untuk kolom NOMOR
    var $column_order = array(
        null,
        'tahun_anggaran',
        // 'kd_klpd',
        // 'nama_klpd',
        // 'jenis_klpd',
        // 'kd_lpse',
        // 'nama_lpse',
        // 'kd_satker',
        'nama_satker',
        'kd_tender',
        'kd_paket',
        'kd_rup_paket',
        'nama_paket',
        'pagu',
        'hps',
        'ang',
        'jenis_pengadaan',
        'mtd_pemilihan',
        'mtd_evaluasi',
        'mtd_kualifikasi',
        'kontrak_pembayaran',
        'kontrak_tahun',
        'jenis_kontrak',
        'nama_status_tender',
        'versi_tender',
        'ket_diulang',
        'ket_ditutup',
        'tgl_buat_paket',
        'tgl_kolektif_kolegial',
        'tgl_pengumuman_tender',
        'url_lpse',
        'kualifikasi_paket',
        'lokasi_pekerjaan',
    );

    var $column_search = array(
        // 'tahun_anggaran',
        'nama_satker',
        // 'kd_tender',
        // 'kd_paket',
        // 'kd_rup_paket',
        // 'nama_paket',
        // 'pagu',
        // 'hps',
        // 'ang',
        // 'jenis_pengadaan',
        // 'mtd_pemilihan',
        // 'mtd_evaluasi',
        // 'mtd_kualifikasi',
        // 'kontrak_pembayaran',
        // 'kontrak_tahun',
        // 'jenis_kontrak',
        // 'nama_status_tender',
        // 'versi_tender',
        // 'ket_diulang',
        // 'ket_ditutup',
        // 'tgl_buat_paket',
        // 'tgl_kolektif_kolegial',
        // 'tgl_pengumuman_tender',
        // 'url_lpse',
        // 'kualifikasi_paket',
        // 'lokasi_pekerjaan',
    );
    // default order 
    var $order = array('nama_satker' => 'desc');

    public function __construct()
    {
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
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        $this->db_pusat->from($this->table);
        $this->db_pusat->where('nama_status_tender', "Aktif");

        if ($opd) {
            $this->db_pusat->where('kd_satker', $opd);
        }
        if ($year) {
            $this->db_pusat->where('tahun_anggaran', $year);
        }
        $this->db_pusat->group_by('kd_rup_paket');

        return $this->db_pusat->count_all_results();
    }

    private function _get_datatables_query()
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        $this->db_pusat->from($this->table);
        $this->db_pusat->where('nama_status_tender', "Aktif");

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
        $this->db_pusat->group_by('kd_rup_paket');

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
        // MULTIPLE QUERY ==============================
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        // PAKET PROSES ================================
        $paketSelesai   = $this->db_pusat->select('count(distinct(kd_paket)) as total')->from('v_tender')->where('kd_paket in (select kd_paket from tender_selesai_detail_spses)');
        if ($opd) {
            $paketSelesai->where('kd_satker', $opd);
        }
        if ($year) {
            $paketSelesai->where('tahun_anggaran', $year);
        }
        $paketSelesai = $paketSelesai->get()->row();
        $selesai = $paketSelesai->total;

        //PAKET PROSES ==================================
        $paketProses    = $this->db_pusat->select('count(distinct(kd_paket)) as total')->from('v_tender')->where('kd_paket not in (select kd_paket from tender_selesai_detail_spses)');
        if ($opd) {
            $paketProses->where('kd_satker', $opd);
        }
        if ($year) {
            $paketProses->where('tahun_anggaran', $year);
        }
        $paketProses = $paketProses->get()->row();
        $proses = $paketProses->total;

        // TOTAL PAKET ==================================
        $totalPaket     = $this->db_pusat->select('count(distinct(kd_paket)) as total')->from('v_tender');
        if ($opd) {
            $totalPaket->where('kd_satker', $opd);
        }
        if ($year) {
            $totalPaket->where('tahun_anggaran', $year);
        }
        $totalPaket = $totalPaket->get()->row();
        $total = $totalPaket->total;

        if ($total > 0) {
            $persProses = $proses / $total * 100;
            $persSelesai = $selesai / $total * 100;
        } else {
            $persProses = 0;
            $persSelesai = 0;
        }
        // ==============================================

        $result = [
            // tata letak object dibawah harus urut (ini menentukan tampilan di front end)
            'proses'    => (int)$proses,
            'selesai'   => (int)$selesai,
            'total'     => (int)$total,
            'persen_proses'     => $persProses,
            'persen_selesai'    => $persSelesai,

        ];
        return $result;
    }

    function detailStatus($status)
    {
        if ($status == "Paket Selesai") {
            $result = $this->db_pusat->where('kd_paket in (select kd_paket from tender_selesai_detail_spses)')->get('v_tender')->result();
        } else {
            $result = $this->db_pusat->where('kd_paket not in (select kd_paket from tender_selesai_detail_spses)')->get('v_tender')->result();
        }
        return $result;
    }
}
