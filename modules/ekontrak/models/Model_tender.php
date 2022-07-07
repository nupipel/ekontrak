<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_tender extends CI_Model
{
    public function __construct()
    {
        $this->db_pusat = $this->load->database('pusat', true);
    }

    function nilai_paket($opd = null, $year = null)
    {
        $query = $this->db_pusat->select('sum(jumlahpagu) as total')->where_in('metodepengadaan', ['Tender', 'Tender Cepat', 'Seleksi', 'Penunjukan Langsung', 'Lelang Umum', 'Dikecualikan']);
        if ($opd) {
            $query->where('kodesatker', $opd);
        }
        if ($year) {
            $query->where('tahunanggaran', $year);
        }

        $result = $query->get('paket_penyedia_opt1618s')->row();
        return $result;
    }

    function total_paket($opd = null, $year = null)
    {
        $query = $this->db_pusat->select('count(idrup) as total')->where_in('metodepengadaan', ['Tender', 'Tender Cepat', 'Seleksi', 'Penunjukan Langsung', 'Lelang Umum', 'Dikecualikan']);
        if ($opd) {
            $query->where('kodesatker', $opd);
        }
        if ($year) {
            $query->where('tahunanggaran', $year);
        }
        $query->where("statusdeletepaket = '0' and statusaktifpaket = '1'");

        $result = $query->get('paket_penyedia_opt1618s')->row();
        return $result;
    }

    function proses_pagu($opd = null, $year = null)
    {
        $query = $this->db_pusat->select('sum(pagu) as total');
        if ($opd) {
            $query->where('kd_satker', $opd);
        }
        if ($year) {
            $query->where('tahun_anggaran', $year);
        }
        $result = $query->get('tender_pengumuman_detail_spses')->row();
        return $result;
    }

    function proses_paket($opd = null, $year = null)
    {
        $query = $this->db_pusat->select('count(distinct kd_rup_paket) as total');
        if ($opd) {
            $query->where('kd_satker', $opd);
        }
        if ($year) {
            $query->where('tahun_anggaran', $year);
        }

        $result = $query->get('tender_pengumuman_detail_spses')->row();
        return $result;
    }

    function kontrak_pagu($opd = null, $year = null)
    {
        $query = $this->db_pusat->select('sum(a.nilai_kontrak) as total')
            ->join('tender_pengumuman_detail_spses b', 'a.kd_tender = b.kd_tender', 'left');
        if ($opd) {
            $query->where('b.kd_satker', $opd);
        }
        if ($year) {
            $query->where('a.tahun_anggaran', $year);
        }

        $result = $query->get('tender_ekontrak_bap_bast_spses a')->row();
        return $result;
    }

    function kontrak_paket($opd = null, $year = null)
    {
        $query = $this->db_pusat->select('count(distinct a.kd_tender) as total')
            ->join('tender_pengumuman_detail_spses b', 'a.kd_tender = b.kd_tender', 'left');

        if ($opd) {
            $query->where('b.kd_satker', $opd);
        }
        if ($year) {
            $query->where('a.tahun_anggaran', $year);
        }

        $result = $query->get('tender_ekontrak_bap_bast_spses a')->row();
        return $result;
    }

    function selesai_pagu($opd = null, $year = null)
    {

        $query = $this->db_pusat->select('sum(a.nilai_kontrak) as total')
            ->join('tender_pengumuman_detail_spses b', 'a.kd_tender = b.kd_tender', 'left');
        if ($opd) {
            $query->where('b.kd_satker', $opd);
        }
        if ($year) {
            $query->where('a.tahun_anggaran', $year);
        }
        $query->where('a.no_bast <> ""');
        $query->where('a.tgl_bast <> ""');

        $result = $query->get('tender_ekontrak_bap_bast_spses a')->row();
        return $result;
    }
    function selesai_paket($opd = null, $year = null)
    {
        $query = $this->db_pusat->select('count(distinct a.kd_tender) as total')
            ->join('tender_pengumuman_detail_spses b', 'a.kd_tender = b.kd_tender', 'left');
        if ($opd) {
            $query->where('b.kd_satker', $opd);
        }
        if ($year) {
            $query->where('a.tahun_anggaran', $year);
        }
        $query->where('a.no_bast <> ""');
        $query->where('a.tgl_bast <> ""');

        $result = $query->get('tender_ekontrak_bap_bast_spses a')->row();
        return $result;
    }
}
