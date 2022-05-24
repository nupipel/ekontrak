<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_home_front extends CI_Model {
    
    
     public function detailtl($id) {
        $query = $this->db->select("*")
                 ->from('kisah_sukses')
                  
                 
                 ->where('id_kisah_sukses', $id)
                 
                 ->get();
        return $query->result_array();
    }
    
    public function kisah_sukses() {
        $query = $this->db->select("*")
                 ->from('kisah_sukses')
                  
                 
                 ->order_by('id_kisah_sukses', 'DESC')
                 ->limit(30)
                 ->get();
        return $query->result_array();
    }
    
    public function faq() {
        $query = $this->db->select("*")
                 ->from('faq')
                  
                 ->where('status_faq', 'Publish')
                 ->order_by('posisi', 'ASC')
                 ->get();
        return $query->result_array();
    }
    
    public function daftar_aplikasi() {
        $query = $this->db->select("*")
                 ->from('daftar_aplikasi')
                  
                 ->where('status', 'Publish')
                 ->order_by('posisi', 'ASC')
                 ->get();
        return $query->result_array();
    }
    
       public function get_data_pegawai($id) {
        $query = $this->db->select("data_pegawai.*, bidang.*")
                 ->from('data_pegawai')
                  ->join('bidang', 'data_pegawai.id_bidang = bidang.id_bidang')
                 ->where('data_pegawai.id_bidang',$id)
                 ->order_by('data_pegawai.id_pegawai', 'ASC')
                 ->get();
        return $query->result_array();
    }
      public function get_nama_bidang($id) {
        $query = $this->db->select("*")
                 ->from('bidang')
                 ->where('id_bidang',$id)
                
                 ->get();
        return $query->result_array();
    }
    
    public function data_petani($id) {
        $query = $this->db->select("*")
                 ->from('data_petani')
                 ->where('kode_kelompok_tani',$id)
                
                 ->get();
        return $query->result_array();
    }
    
    public function agenda_kebun() {
        $query = $this->db->select("agenda.*,data_kebun.*")
                 ->from('agenda')
                ->join('data_kebun', 'data_kebun.id_data_kebun = agenda.lokasi_kebun')
                  ->order_by('id','DESC')
               ->limit(12)
                 ->get();
        return $query->result_array();
    }
     public function data_statistik() {
        $query = $this->db->select("*")
                 ->from('data_statistik')
                
                  ->where('id_data_statistik','1')
               
                 ->get();
        return $query->result_array();
    }
    
    public function laporankeuangan($dr, $sm) {
        $query = $this->db->select("*")
                 ->from('keuangan_kebun')
                
                  ->where('tgl_penjualan >=',$dr)
                  ->where('tgl_penjualan <=',$sm)
               
                 ->get();
        return $query->result_array();
    }
    
    public function keuangan1($dr, $sm) {
        $query = $this->db->select("keuangan_kebun.*,data_kebun.*,jenis_buah.*")
                 ->from('keuangan_kebun')
                 ->join('data_kebun', 'data_kebun.id_data_kebun = keuangan_kebun.kode_lokasi_kebun')
                  ->join('jenis_buah', 'jenis_buah.id_jenis_buah = keuangan_kebun.kode_produk')
                ->where('jenis_setoran','Petani')
                 ->where('tgl_penjualan >=',$dr)
                  ->where('tgl_penjualan <=',$sm)
                 ->order_by('keuangan_kebun.kode_lokasi_kebun','ASC')
                 ->get();
        return $query->result_array();
    }
     public function keuangan2($dr, $sm) {
        $query = $this->db->select("keuangan_kebun.*,data_kebun.*,jenis_buah.*")
                 ->from('keuangan_kebun')
                 ->join('data_kebun', 'data_kebun.id_data_kebun = keuangan_kebun.kode_lokasi_kebun')
                  ->join('jenis_buah', 'jenis_buah.id_jenis_buah = keuangan_kebun.kode_produk')
                ->where('jenis_setoran','Petugas Kebun')
                 ->where('tgl_penjualan >=',$dr)
                  ->where('tgl_penjualan <=',$sm)
                ->order_by('keuangan_kebun.kode_lokasi_kebun','ASC')
                 ->get();
        return $query->result_array();
    }
    
    
     public function home_produkkebun_1() {
        $query = $this->db->select("*")
                 ->from('produk_kebun')
                  ->order_by('id_produk_kebun', 'DESC')
                  ->where('kode_jenis_tanaman','1')
                ->limit(8)
                 ->get();
        return $query->result_array();
    }
     public function home_produkkebun_2() {
        $query = $this->db->select("*")
                 ->from('produk_kebun')
                  ->order_by('id_produk_kebun', 'DESC')
                  ->where('kode_jenis_tanaman','2')
                ->limit(8)
                 ->get();
        return $query->result_array();
    }
     public function home_produkkebun_3() {
        $query = $this->db->select("*")
                 ->from('produk_kebun')
                  ->order_by('id_produk_kebun', 'DESC')
                  ->where('kode_jenis_tanaman','3')
                ->limit(8)
                 ->get();
        return $query->result_array();
    }
     public function home_produkkebun_4() {
        $query = $this->db->select("*")
                 ->from('produk_kebun')
                  ->order_by('id_produk_kebun', 'DESC')
                  ->where('kode_jenis_tanaman','4')
                ->limit(8)
                 ->get();
        return $query->result_array();
    }
     public function home_produkkebun_5() {
        $query = $this->db->select("*")
                 ->from('produk_kebun')
                  ->order_by('id_produk_kebun', 'DESC')
                  ->where('kode_jenis_tanaman','5')
                ->limit(8)
                 ->get();
        return $query->result_array();
    }
    
     public function running_text() {
        $query = $this->db->select("*")
                 ->from('running_text')
                 ->where('id_running_text','1')
                
                 ->get();
        return $query->result_array();
    }
     public function get_halaman($slug) {
        $query = $this->db->select("*")
                 ->from('halaman')
                 ->where('id',$slug)
                
                 ->get();
        return $query->result_array();
    }
         public function get_sliders() {
        $query = $this->db->select("*")
                 ->from('sliders')
                 ->where('status','Publish')
                 ->order_by('id', 'DESC')
                 ->get();
        return $query->result_array();
    }

 public function get_link() {
        $query = $this->db->select("*")
                 ->from('link_terkait')
                 ->where('status','Publish')
                 ->order_by('posisi', 'ASC')
                 ->get();
        return $query->result_array();
    }
    public function info_lainnya() {
        $query = $this->db->select("*")
                 ->from('info_lainnya')
                 ->where('status','Publish')
                 ->order_by('posisi', 'ASC')
                 ->get();
        return $query->result_array();
    }
    
    public function get_agendahrini() {
        $hrini=date('Y-m-d');
        $query = $this->db->select("*")
                 ->from('agenda')
                 ->like('tgl_mulai', $hrini,'both')
                 ->order_by('tgl_mulai', 'ASC')
                 ->get();
        return $query->result_array();
    }
     public function get_agendahrlain() {
        $hrini=date('Y-m-d').' 23:59:59';
        $query = $this->db->select("*")
                 ->from('agenda')
                 ->where('tgl_mulai >', $hrini)
                 ->limit(6)
                 ->order_by('tgl_mulai', 'ASC')
                 ->get();
        return $query->result_array();
    }

         public function get_infoumum() {
        $query = $this->db->select("*")
                 ->from('infoumum')
                 ->where('id','1')
                 
                 ->get();
        return $query->result_array();
    }

 public function get_sambutan() {
        $query = $this->db->select("*")
                 ->from('sambutan')
                 ->where('id','1')
                 
                 ->get();
        return $query->result_array();
    }

 public function get_berita() {
        $query = $this->db->select("*")
                 ->from('blog')
                 ->where('category','2')
                  ->where('status','publish')
                  ->limit(6)
                   ->order_by('id', 'DESC')
                 ->get();
        return $query->result_array();
    }
  
   public function get_layanan() {
        $query = $this->db->select("*")
                 ->from('blog')
                 ->where('category','1')
                  ->where('status','publish')
                 ->get();
        return $query->result_array();
    }
    
     public function get_galeri() {
        $query = $this->db->select("*")
                 ->from('galeri')
                 ->limit(9)
                    ->order_by('id', 'DESC')
                 
                 ->get();
        return $query->result_array();
    }
    
     public function get_galeri_foto() {
        $query = $this->db->select("*")
                 ->from('galeri')
                 ->where('jenis','Foto')
                 ->limit(6)
                    ->order_by('id', 'DESC')
                 
                 ->get();
        return $query->result_array();
    }
    
     public function get_galeri_video() {
        $query = $this->db->select("*")
                 ->from('galeri')
                 ->where('jenis','Video')
                 ->limit(6)
                    ->order_by('id', 'DESC')
                 
                 ->get();
        return $query->result_array();
    }
    
      public function get_galeri_foto2() {
        $query = $this->db->select("*")
                 ->from('galeri')
                 ->where('jenis','Foto')
                 
                    ->order_by('id', 'DESC')
                 
                 ->get();
        return $query->result_array();
    }
    
     public function get_galeri_video2() {
        $query = $this->db->select("*")
                 ->from('galeri')
                 ->where('jenis','Video')
                 
                    ->order_by('id', 'DESC')
                 
                 ->get();
        return $query->result_array();
    }
  
 


}

?>