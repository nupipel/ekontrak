<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_nontender extends CI_Model
{
    public function __construct()
    {
        $this->db_pusat = $this->load->database('pusat', true);
    }

    function nilai_paket($opd = null, $year = null)
    {
        $query = $this->db_pusat->select('sum(jumlahpagu) as total')->where_in('metodepengadaan', ['Pengadaan Langsung']);
        if ($opd) {
            $this->db_pusat->where('kodesatker', $opd);
        }
        if ($year) {
            $this->db_pusat->where('tahunanggaran', $year);
        }

        $result = $query->get('paket_penyedia_opt1618s')->row();
        return $result->total;
    }

    function total_paket($opd = null, $year = null)
    {
        $query = $this->db_pusat->select('count(idrup) as total')->where_in('metodepengadaan', ['Pengadaan Langsung']);
        if ($opd) {
            $query->where('kodesatker', $opd);
        }
        if ($year) {
            $query->where('tahunanggaran', $year);
        }

        $result = $query->get('paket_penyedia_opt1618s')->row();

        return $result->total;
    }

    function proses_pagu($opd = null, $year = null)
    {
        $q1 = $this->db_pusat->select('sum(pagu) as total');
        if ($opd) {
            $q1->where('kd_satker', $opd);
        }
        if ($year) {
            $q1->where('tahun_anggaran', $year);
        }
        $t1 = $q1->get('non_tender_pengumuman_detail_spses')->row();

        $t2 = $this->_get_pencatatan('pagu', $opd, $year);

        $result = $t1->total + $t2;

        return $result;
    }

    function proses_paket($opd = null, $year = null)
    {
        $q1 = $this->db_pusat->select('count(kd_rup_paket) as total');
        if ($opd) {
            $q1->where('kd_satker', $opd);
        }
        if ($year) {
            $q1->where('tahun_anggaran', $year);
        }
        $t1 = $q1->get('non_tender_pengumuman_detail_spses')->row();

        $t2 = $this->_get_pencatatan('paket', $opd, $year);

        $result = $t1->total + $t2;
        return $result;
    }

    function kontrak_pagu($opd = null, $year = null)
    {
        $q1 = $this->db_pusat->select('sum(a.nilai_kontrak) as total')
            ->join('non_tender_pengumuman_detail_spses b', 'a.kd_tender = b.kd_nontender', 'left');

        if ($opd) {
            $q1->where('b.kd_satker', $opd);
        }
        if ($year) {
            $q1->where('a.tahun_anggaran', $year);
        }
        $t1 = $q1->get('non_tender_ekontrak_bap_bast_spses a')->row();

        $t2 = $this->_get_pencatatan('pagu', $opd, $year);

        $result = $t1->total + $t2;
        return $result;
    }

    function kontrak_paket($opd = null, $year = null)
    {
        $q1 = $this->db_pusat->select('count(distinct a.kd_tender) as total')
            ->join('non_tender_pengumuman_detail_spses b', 'a.kd_tender = b.kd_nontender', 'left');
        if ($opd) {
            $q1->where('b.kd_satker', $opd);
        }
        if ($year) {
            $q1->where('a.tahun_anggaran', $year);
        }
        $t1 = $q1->get('non_tender_ekontrak_bap_bast_spses a')->row();

        $t2 = $this->_get_pencatatan('paket', $opd, $year);

        $result = $t1->total + $t2;

        return $result;
    }

    function selesai_pagu($opd = null, $year = null)
    {
        $q1 = $this->db_pusat->select('sum(a.nilai_kontrak) as total')
            ->join('non_tender_pengumuman_detail_spses b', 'a.kd_tender = b.kd_nontender', 'left');

        if ($opd) {
            $q1->where('b.kd_satker', $opd);
        }
        if ($year) {
            $q1->where('a.tahun_anggaran', $year);
        }
        $q1->where('a.no_bast <> ""');
        $q1->where('a.tgl_bast <> ""');

        $t1 = $q1->get('non_tender_ekontrak_bap_bast_spses a')->row();

        $t2 = $this->_get_pencatatan('pagu', $opd, $year);

        $result = $t1->total + $t2;
        return $result;
    }

    function selesai_paket($opd = null, $year = null)
    {
        $q1 = $this->db_pusat->select('count(distinct a.kd_tender) as total')
            ->join('non_tender_pengumuman_detail_spses b', 'a.kd_tender = b.kd_nontender', 'left');

        if ($opd) {
            $q1->where('b.kd_satker', $opd);
        }
        if ($year) {
            $q1->where('a.tahun_anggaran', $year);
        }
        $q1->where('a.no_bast <> ""');
        $q1->where('a.tgl_bast <> ""');

        $t1 = $q1->get('non_tender_ekontrak_bap_bast_spses a')->row();

        $t2 = $this->_get_pencatatan('paket', $opd, $year);

        $result = $t1->total + $t2;

        return $result;
    }


    private function _get_pencatatan($params, $opd, $year)
    {
        $this->db_pusat->flush_cache();
        if ($params == 'paket') {
            $q2 = $this->db_pusat->from('pencatatan_non_tender_spses');
            $year ? $q2->where('tahun_anggaran', $year) : null;
            $opd ? $q2->where('kd_satker_str', $opd) : null;

            return $q2->get()->num_rows();
        } else {
            $q2 = $this->db_pusat->select('sum(pagu) as total')->from('pencatatan_non_tender_spses');
            $year ? $q2->where('tahun_anggaran', $year) : null;
            $opd ? $q2->where('kd_satker_str', $opd) : null;

            $t2 = $q2->get()->row();
            return $t2->total;
        }
    }
}
