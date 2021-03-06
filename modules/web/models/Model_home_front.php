<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_home_front extends CI_Model
{
    public $db_bappeda;

    public function __construct()
    {
        $this->db_bappeda = $this->load->database('bappeda', true);
        $this->db_pusat = $this->load->database('pusat', true);
    }
    public function get_infoumum()
    {
        $query = $this->db->select("*")
            ->from('infoumum')
            ->where('id', '1')

            ->get();
        return $query->result_array();
    }

    public function master_satker_rups()
    {
        $query = $this->db->select("*")
            ->from('master_satker_rups')


            ->get();
        return $query->result_array();
    }

    function list_instansi()
    {
        return $this->db_pusat->order_by('nama_satker')->get('master_satker_rups')->result();
    }

    function getUnit($id, $col = null)
    {
        if ($col == 'kode') {
            $arr = ['kode_skpd' => $id];
        } else {
            $arr = ['id_skpd' => $id];
        }
        $get = $this->db_bappeda->get_where('data_unit', $arr)->row();
        return $get;
    }

    public function total_anggaran($opd, $year)
    {
        $where = null;
        if ($opd) {
            $getID = $this->getUnit($opd, 'kode');
            $where = $this->db_bappeda->where('id_skpd', $getID->id_skpd);
        }


        $this->db_bappeda->flush_cache();
        $this->db_bappeda->select('sum(aa.anggaran) as total')->from('apbd_anggaran aa');
        $where;
        if ($year) {
            $this->db_bappeda->where('tahun', $year);
        }

        $q =  $this->db_bappeda->get();
        return $q->row();
    }

    public function total_pendapatan($opd, $year)
    {
        $where = null;
        if ($opd) {
            $getID = $this->getUnit($opd, 'kode');
            $where = $this->db_bappeda->where('id_skpd', $getID->id_skpd);
        }


        $this->db_bappeda->flush_cache();
        $this->db_bappeda->select('sum(aa.anggaran) as total')->from('a_apbd_pendapatan aa');
        $where;
        if ($year) {
            $this->db_bappeda->where('tahun', $year);
        }

        $q =  $this->db_bappeda->get();
        return $q->row();
    }

    public function list_e_purchasing()
    {
        $this->db_pusat->select('*')
            ->from('paket_e_purchasings');
        $q =  $this->db_pusat->get();
        return $q->row();
    }

    public function listpendapatan($limit = null, $opd = null, $year = null)
    {
        $where = null;
        if ($opd) {
            $getID = $this->getUnit($opd, 'kode');
            $where = $this->db_bappeda->where('aa.id_skpd', $getID->id_skpd);
        }
        $this->db_bappeda->flush_cache();
        $this->db_bappeda->select('du.nama_skpd as nama, sum(aa.anggaran) as anggaran, sum(aa.anggaran_pergeseran) as anggaran_pergeseran, sum(aa.anggaran_perubahan) as anggaran_perubahan')
            ->from('a_apbd_pendapatan aa')
            ->join('data_unit du', 'du.id_skpd = aa.id_skpd', 'LEFT');
        if ($year) {
            $this->db_bappeda->where('tahun', $year);
        }
        $where;
        $this->db_bappeda->group_by('aa.id_skpd')
            ->order_by('anggaran', 'desc');
        if ($limit) {
            $this->db_bappeda->limit($limit);
        };
        $q =  $this->db_bappeda->get();

        if ($q->num_rows() > 0) {
            $result = $q->result();
        } else {
            $result = null;
        }
        return $result;
    }

    public function listApbd_OPD($limit = null, $opd = null, $year = null)
    {
        $where = null;
        if ($opd) {
            $getID = $this->getUnit($opd, 'kode');
            $where = $this->db_bappeda->where('aa.id_skpd', $getID->id_skpd);
        }
        $this->db_bappeda->flush_cache();
        $this->db_bappeda->select('aa.id_skpd as id, du.nama_skpd as nama, sum(aa.anggaran) as anggaran, sum(aa.anggaran_pergeseran) as anggaran_pergeseran, sum(aa.anggaran_perubahan) as anggaran_perubahan')
            ->from('apbd_anggaran aa')
            ->join('data_unit du', 'du.id_skpd = aa.id_skpd', 'LEFT');
        $where;
        if ($year) {
            $this->db_bappeda->where('tahun', $year);
        }
        $this->db_bappeda->group_by('aa.id_skpd')
            ->order_by('anggaran', 'desc');
        if ($limit) {
            $this->db_bappeda->limit($limit);
        };
        $q =  $this->db_bappeda->get();
        if ($q->num_rows() > 0) {
            $result = $q->result();
        } else {
            $result = null;
        }
        return $result;
    }

    function total_params($table, $col, $opd = null, $year = null)
    {
        $this->db_pusat->select("sum($col) as nilai")->where("tahun_anggaran", $year);
        if ($opd) {
            $this->db_pusat->where('kd_satker', $opd);
        }
        return $this->db_pusat->get($table)->row();
    }

    function paket_params($table, $col, $opd = null, $year = null)
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        $this->db_pusat->select("count(distinct ($col)) as paket")->where("tahun_anggaran", $year);
        if ($opd) {
            $this->db_pusat->where('kd_satker', $opd);
        }
        return $this->db_pusat->get($table)->row();
    }

    function total_epurc($opd = null, $year = null)
    {
        // $opd = $this->input->post('opd');
        // $year = $this->input->post('year');
        $whereID = null;
        if ($opd) {
            $get        = $this->db_pusat->get_where('master_satker_rups', ['kd_satker_str' => $opd])->row();
            $kd_satker  =  $get->kd_satker;
            $whereID = $this->db_pusat->where('satker_id', $kd_satker);
        }
        $this->db_pusat->flush_cache();

        $this->db_pusat->select('sum(total) as nilai')->where("tahun_anggaran", $year);
        $whereID;
        return $this->db_pusat->get('paket_e_purchasings')->row();
    }

    function paket_epurc($opd = null, $year = null)
    {
        // $opd = $this->input->post('opd');
        // $year = $this->input->post('year');
        $whereID = null;
        if ($opd) {
            $get        = $this->db_pusat->get_where('master_satker_rups', ['kd_satker_str' => $opd])->row();
            $kd_satker  =  $get->kd_satker;
            $whereID = $this->db_pusat->where('satker_id', $kd_satker);
        }
        $this->db_pusat->flush_cache();

        $this->db_pusat->select("count(distinct (kd_paket)) as paket")->where("tahun_anggaran", $year);
        $whereID;
        return $this->db_pusat->get('paket_e_purchasings')->row();
    }

    function getAPBDbyID($id, $year = null)
    {
        $this->db_bappeda->select(' aa.id_skpd as id, aa.id_subkegiatan, du.nama_skpd as nama, aa.anggaran, aa.anggaran_pergeseran, aa.anggaran_perubahan')
            ->from('apbd_anggaran aa')
            ->join('data_unit du', 'du.id_skpd = aa.id_skpd', 'LEFT')
            // ->join('tampung_exel_subkegiatan k', 'k.id_kegiatan = aa.id_kegiatan', 'LEFT')
            ->where('aa.id_skpd', $id)
            ->where('aa.tahun', $year)
            // ->group_by('aa.id_subkegiatan')
            ->order_by('anggaran', 'desc');

        $q =  $this->db_bappeda->get()->result();
        return $q;
    }

    function getSubKegiatanByID($id)
    {
        return $this->db_bappeda->get_where('tampung_exel_subkegiatan', ['id_kegiatan' => $id])->result();
    }
    function getKegiatan($id)
    {
        return $this->db_bappeda->get_where('tampung_exel_kegiatan', ['id' => $id])->row();
    }

    function list_satker($id = null)
    {

        $this->db_pusat->select('kd_satker as id, nama_satker, kd_satker_str')
            ->from('master_satker_rups');
        if ($id) {
            $this->db_pusat->where('kd_satker_str', $id);
        }
        return $this->db_pusat->order_by('nama_satker')->get()->result();
    }
    function list_satker_bappeda($kode_skpd = null)
    {

        $this->db_bappeda->select('id_unit, kode_skpd, nama_skpd')
            ->from('data_unit');
        if ($kode_skpd) {
            $this->db_bappeda->where('kode_skpd', $kode_skpd);
        }
        return $this->db_bappeda->order_by('nama_skpd')->get()->result();
    }

    function getByMethod($id, $year, $method)
    {
        $this->db_pusat->select('idsatker as id, count(idsatker) as jml, sum(jumlahpagu) as total')
            ->from('paket_penyedia_opt1618s')
            ->where("statusdeletepaket = '0' and statusaktifpaket = '1'")
            ->where("metodepengadaan", $method)
            ->where("tahunanggaran", $year)
            ->where("idsatker", $id)
            ->group_by("idsatker");
        $query = $this->db_pusat->get();
        return $query->row();
    }
    function getByMethodSwakelola($id, $year)
    {
        $this->db_pusat->select('count(idsatker) as jml, sum(jumlahpagu) as total')
            ->from('paket_swakelola_opt1618s')
            ->where("statusdeletepaket='0' and statusaktifpaket = '1'")
            // ->where("metodepengadaan")
            ->where("tahunanggaran", $year)
            ->where("idsatker", $id);
        // ->group_by("idsatker");
        $query = $this->db_pusat->get();
        return $query->row();
    }

    function barjasmodal($kode_skpd, $year, $tahap)
    {
        $query = $this->db_bappeda->select('SUM(if(substring(a.kode_akun, 1, 6)= "5.1.02", a.rincian, 0)) as barjas, SUM(if(substring(a.kode_akun, 1, 3)= "5.2", a.rincian, 0)) as modal')
            ->from($tahap)
            ->join('data_unit b', 'a.id_sub_skpd = b.id_skpd', 'left')
            ->where(['a.tahun' => $year, 'b.kode_skpd' => $kode_skpd]);
        return $query->get()->row();
    }

    function GET_list_kegiatan_by_opd($opd, $year)
    {
        $q1 = $this->db_bappeda->query("select
            *
        from
            tampung_exel_kegiatan
        where
            id in (
            select
                id_kegiatan
            from
                tampung_exel_subkegiatan
            where
                id in (
                select
                    id_subkegiatan
                from
                    apbd_anggaran
                where
                    tahun = $year
                    and id_skpd = $opd))")->result();
        return $q1;
    }


    function GET_list_subkegiatan_by_kegiatan($idKegiatan, $opd, $year)
    {

        $q1 = $this->db_bappeda->query("select
            id,kode,uraian
        from
            tampung_exel_subkegiatan
        where
            id_kegiatan = $idKegiatan 
        AND
            id in (
            select
                id_subkegiatan
            from
                data_rka
            where
                tahun = $year
                and id_skpd = $opd)")->result();
        return $q1;
    }
}
