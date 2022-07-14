<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_nontender extends CI_Model
{
    var $table = 'non_tender_pengumuman_detail_spses';

    var $select_column = 'tahun_anggaran,
            nama_satker,
            nama_paket,
            pagu,
            anggaran,
            kategori_pengadaan,
            metode_pengadaan,
            tanggal_buat_paket,
            nama_status_nontender';

    //UNION
    var $pencatatan_column = 'tahun_anggaran,
            nama_satker,
            nama_paket,
            pagu,
            ang as anggaran,
            kategori_pengadaan,
            mtd_pemilihan_v1 as metode_pengadaan,
            tgl_buat_paket as tanggal_buat_paket,
            status_nontender_pct as nama_status_nontender';


    var $column_order = array(
        null,
        'tahun_anggaran',
        'nama_satker',
        'nama_paket',
        'pagu',
        'anggaran',
        'kategori_pengadaan',
        'metode_pengadaan',
        'tanggal_buat_paket',
        'nama_status_nontender',
        'lokasi_pekerjaan'
    );

    var $column_search = array(
        'nama_satker',
        'nama_paket'
    );
    // default order 
    var $order = array('nama_satker' => 'asc');

    public function __construct()
    {
        // $this->db_bappeda = $this->load->database('bappeda', true);
        $this->db_pusat = $this->load->database('pusat', true);
    }

    function dataTableNonTender()
    {
        $this->_get_datatables_query();

        if ($this->input->post('length') != -1) {
            $this->db_pusat->limit($this->input->post('length'), $this->input->post('start'));
        }
        return $this->db_pusat->get()->result();
    }

    function count_filtered()
    {
        $Q = $this->_get_datatables_query();
        $Q = $this->db_pusat->get();
        return $Q->num_rows();
    }

    public function count_all()
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        // QUERY TABLE non_tender_pengumuman_detail_spses
        $this->db_pusat->select($this->select_column)
            ->from($this->table)
            ->where(['nama_status_nontender' => "Aktif", 'metode_pengadaan' => "Pengadaan Langsung"]);
        $opd ? $this->db_pusat->where('kd_satker', $opd) : null;
        $year ? $this->db_pusat->where('tahun_anggaran', $year) : null;
        // $this->db_pusat->group_by('kd_rup_paket');
        $Q1 = $this->db_pusat->get_compiled_select();
        //END

        // QUERY TABLE pencatatan_non_tender_spses
        $Q2 = $this->_get_pencatatan();
        $Q2 = $this->db_pusat->get_compiled_select();

        // UNION 
        $union =  ($Q1) . " UNION ALL " . ($Q2);

        $this->db_pusat->flush_cache();

        $query = $this->db_pusat->from("(" . $union . ") as nontender");

        return $query->get()->num_rows();
    }

    private function _get_datatables_query()
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        // QUERY TABLE non_tender_pengumuman_detail_spses
        $this->db_pusat->select($this->select_column)
            ->from($this->table)
            ->where(['nama_status_nontender' => "Aktif", 'metode_pengadaan' => "Pengadaan Langsung"]);
        $opd ? $this->db_pusat->where('kd_satker', $opd) : null;
        $year ? $this->db_pusat->where('tahun_anggaran', $year) : null;
        // $this->db_pusat->group_by('kd_rup_paket');
        $Q1 = $this->db_pusat->get_compiled_select();
        //END

        // QUERY TABLE pencatatan_non_tender_spses
        $Q2 = $this->_get_pencatatan();
        $Q2 = $this->db_pusat->get_compiled_select();
        // UNION 
        $union =  ($Q1) . " UNION ALL " . ($Q2);

        $this->db_pusat->flush_cache();

        $this->db_pusat->from("(" . $union . ") as nontender");

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->input->post('search')['value']) {
                if ($i === 0) {
                    $this->db_pusat->group_start();
                    $this->db_pusat->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db_pusat->or_like($item, $this->input->post('search')['value']);
                }
                if (count($this->column_search) - 1 == $i) {
                    $this->db_pusat->group_end();
                }
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

    private function _get_pencatatan()
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        $this->db_pusat->flush_cache();
        $q2 = $this->db_pusat->select($this->pencatatan_column)->from('pencatatan_non_tender_spses')->where(['mtd_pemilihan_v1' => 'Pengadaan Langsung']);
        $year ? $q2->where('tahun_anggaran', $year) : null;
        $opd ? $q2->where('kd_satker_str', $opd) : null;
    }

    function get_status()
    {
        // MULTIPLE QUERY ==============================
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        // PAKET PROSES ================================
        $paketSelesai   = $this->db_pusat->select('count(distinct(kd_nontender)) as total')->from('v_non_tender')->where('kd_nontender in (select kd_nontender from non_tender_selesai_detail_spses)');
        if ($opd) {
            $paketSelesai->where('kd_satker', $opd);
        }
        if ($year) {
            $paketSelesai->where('tahun_anggaran', $year);
        }
        $paketSelesai = $paketSelesai->get()->row();
        $selesai = $paketSelesai->total;

        //PAKET PROSES ==================================
        $paketProses    = $this->db_pusat->select('count(distinct(kd_nontender)) as total')->from('v_non_tender')->where('kd_nontender not in (select kd_nontender from non_tender_selesai_detail_spses)');
        if ($opd) {
            $paketProses->where('kd_satker', $opd);
        }
        if ($year) {
            $paketProses->where('tahun_anggaran', $year);
        }
        $paketProses = $paketProses->get()->row();
        $proses = $paketProses->total;

        // TOTAL PAKET ==================================
        $totalPaket     = $this->db_pusat->select('count(distinct(kd_nontender)) as total')->from('v_non_tender');
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
}
