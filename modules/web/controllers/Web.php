<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *| --------------------------------------------------------------------------
 *| Web Controller
 *| --------------------------------------------------------------------------
 *| For default controller
 *|
 */
class Web extends Front
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_home_front');
        $this->load->model('model_epurchasing');
        $this->load->model('model_nontender');
        $this->load->model('model_tender');
        $this->load->model('model_monev');
    }

    public function index()
    {
        if (installation_complete()) {
            $this->home();
        } else {
            redirect('wizzard/language', 'refresh');
        }
    }

    public function switch_lang($lang = 'english')
    {
        $this->load->helper(['cookie']);

        set_cookie('language', $lang, (60 * 60 * 24) * 365);
        $this->lang->load('web', $lang);
        redirect_back();
    }

    public function home()
    {
        if (defined('IS_DEMO')) {
            $this->template->build('home-demo');
        } else {
            $this->data['container'] = 'beranda';
            $this->data['get_infoumum'] = $this->model_home_front->get_infoumum();
            $this->data['list_instansi']     = $this->model_home_front->list_instansi();

            $this->template->build('home', $this->data);

            //$this->template->build('home');
        }
    }

    function getAngkaDashboard()
    {
        $opd = $this->input->post('opd');
        $year = $this->input->post('year');

        $anggaran = $this->model_home_front->total_anggaran($opd, $year);
        $pendapatan = $this->model_home_front->total_pendapatan($opd, $year);

        $data = [
            'anggaran'    => isset($anggaran->total) ? $anggaran->total : 0,
            'pendapatan'  => isset($pendapatan->total) ? $pendapatan->total : 0,
        ];
        echo json_encode($data);
    }

    public function pengadaan()
    {
        $data = [
            'container'         => 'pengadaan',
            'get_infoumum'      => $this->model_home_front->get_infoumum(),
            'nilai_tender'      => $this->model_home_front->total_params('v_tender', 'nilai_kontrak'),
            'paket_tender'      => $this->model_home_front->paket_params('v_tender', 'kd_paket'),
            'nilai_nontender'   => $this->model_home_front->total_params('v_non_tender', 'nilai_kontrak'),
            'paket_nontender'   => $this->model_home_front->paket_params('v_non_tender', 'kd_nontender'),
            'nilai_epur'        => $this->model_home_front->total_params('paket_e_purchasings', 'total'),
            'paket_epur'        => $this->model_home_front->paket_params('paket_e_purchasings', 'kd_paket'),
            'list_instansi'     => $this->model_home_front->list_instansi(),

            // 'list_e_purchasing' => $this->model_home_front->list_e_purchasing(),
        ];
        $this->template->build('home', $data);
    }


    public function monev()
    {
        $data = [
            'container'         => 'monev',
            'get_infoumum'      => $this->model_home_front->get_infoumum(),

        ];
        $this->template->build('home', $data);
    }

    function listrealisasisss()
    {
        // var_dump($this->input->post('year'));
        // die;
        echo json_encode($this->model_home_front->listrealisasi($this->input->post('year')));
    }

    public function set_full_group_sql()
    {
        $this->db->query(" 
            set global sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
         ");

        $this->db->query(" 
            set session sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
         ");
    }

    public function migrate($version = null)
    {
        $this->load->library('migration');

        if ($version) {
            if ($this->migration->version($version) === FALSE) {
                show_error($this->migration->error_string());
            }
        } else {
            if ($this->migration->latest() === FALSE) {
                show_error($this->migration->error_string());
            }
        }
    }

    public function migrate_cicool()
    {
        $this->load->helper('file');
        $this->load->helper('directory');

        $files = (directory_map('application/controllers/administrator'));

        foreach ($files as $file) {
            $f_name = str_replace('.php', '', $file);
            $f_name_lower = strtolower(str_replace('.php', '', $file));

            if ($file == 'index.html') {
                continue;
            }
            if ($f_name_lower != 'web') {

                mkdir('modules/' . $f_name);
                mkdir('modules/' . $f_name . '/models');
                mkdir('modules/' . $f_name . '/views');
                mkdir('modules/' . $f_name . '/controllers');
                mkdir('modules/' . $f_name . '/controllers/backend');
                mkdir('modules/' . $f_name . '/views/backend');
                mkdir('modules/' . $f_name . '/views/backend/standart');
                mkdir('modules/' . $f_name . '/views/backend/standart/administrator');
                copy(FCPATH . '/application/models/Model_' . $f_name_lower . '.php', 'modules/' . $f_name_lower . '/models/Model_' . $f_name_lower . '.php');
                copy(FCPATH . '/application/controllers/administrator/' . $f_name . '.php', 'modules/' . $f_name . '/controllers/backend/' . $f_name . '.php');
                if (is_dir(FCPATH . '/application/views/backend/standart/administrator/' . $f_name_lower)) {

                    $this->recurse_copy(FCPATH . '/application/views/backend/standart/administrator/' . $f_name_lower, 'modules/' . $f_name . '/views/backend/standart/administrator/' . $f_name_lower);
                }
                //unlink('modules/'.$f_name_lower.'/models'.$f_name_lower.'.php' );
            }
        }
    }
    public function migrate_cicool_front()
    {
        $this->load->helper('file');
        $this->load->helper('directory');

        $files = (directory_map('application/controllers'));

        foreach ($files as $file) {
            $f_name = str_replace('.php', '', $file);
            $f_name_lower = strtolower(str_replace('.php', '', $file));

            if ($file == 'index.html') {
                continue;
            }
            if ($f_name_lower != 'web') {

                mkdir('modules/' . $f_name);
                mkdir('modules/' . $f_name . '/models');
                mkdir('modules/' . $f_name . '/views');
                mkdir('modules/' . $f_name . '/controllers');
                mkdir('modules/' . $f_name . '/controllers');
                mkdir('modules/' . $f_name . '/views/backend');
                mkdir('modules/' . $f_name . '/views/backend/standart');
                mkdir('modules/' . $f_name . '/views/backend/standart/administrator');
                copy(FCPATH . '/application/models/Model_' . $f_name_lower . '.php', 'modules/' . $f_name_lower . '/models/Model_' . $f_name_lower . '.php');
                copy(FCPATH . '/application/controllers/' . $f_name . '.php', 'modules/' . $f_name . '/controllers/' . $f_name . '.php');
                if (is_dir(FCPATH . '/application/views/backend/standart/administrator/' . $f_name_lower)) {

                    $this->recurse_copy(FCPATH . '/application/views/backend/standart/administrator/' . $f_name_lower, 'modules/' . $f_name . '/views/backend/standart/administrator/' . $f_name_lower);
                }
                //unlink('modules/'.$f_name_lower.'/models'.$f_name_lower.'.php' );
            }
        }
    }

    public function  recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    function image($mime_type_or_return = 'image/png')
    {
        $file_path = $this->input->get('path');
        $this->helper('file');

        $image_content = read_file($file_path);

        // Image was not found
        if ($image_content === FALSE) {
            show_error('Image "' . $file_path . '" could not be found.');
            return FALSE;
        }

        // Return the image or output it?
        if ($mime_type_or_return === TRUE) {
            return $image_content;
        }

        header('Content-Length: ' . strlen($image_content)); // sends filesize header
        header('Content-Type: ' . $mime_type_or_return); // send mime-type header
        header('Content-Disposition: inline; filename="' . basename($file_path) . '";'); // sends filename header
        exit($image_content); // reads and outputs the file onto the output buffer
    }

    public function create_user()
    {
        for ($i = 0; $i < 30; $i++) {
            $this->aauth->create_user('user' . $i . '@gmail.com', 'admin123', 'user' . $i);
        }
    }

    public function donut_chart()
    {
        $apbp_opd = $this->model_home_front->listApbd_OPD(10, false, $this->input->post('year'));
        if ($apbp_opd) {
            foreach ($apbp_opd as $x) :
                $label[]    = $x->nama;
                $val[]      = $x->anggaran;
            endforeach;
        } else {
            $label  = 0;
            $val    = 0;
        }


        $result = [
            'label'     => $label,
            'val'       => $val,
            'bgcolor'   => [
                '#ff7f50', '#87cefa', '#da70d6', '#32cd32', '#6495ed',
                '#ff69b4', '#ba55d3', '#cd5c5c', '#ffa500', '#40e0d0'
            ]
        ];
        // var_dump($apbp_opd);
        // die;
        echo json_encode($result);
    }

    public function donut_chart3()
    {
        $apbp_opd = $this->model_home_front->listpendapatan(10, false, $this->input->post('year'));
        if ($apbp_opd) {
            foreach ($apbp_opd as $x) :
                $label[]    = $x->nama;
                $val[]      = $x->anggaran;
            endforeach;
        } else {
            $label  = 0;
            $val    = 0;
        }

        $result = [
            'label'     => $label,
            'val'       => $val,
            'bgcolor'   => [
                '#ff7f50', '#87cefa', '#da70d6', '#32cd32', '#6495ed',
                '#ff69b4', '#ba55d3', '#cd5c5c', '#ffa500', '#40e0d0'
            ]
        ];
        // var_dump($apbp_opd);
        // die;
        echo json_encode($result);
    }

    public function clistApbd_OPD()
    {
        $year   = $this->input->post('year');
        $opd    = $this->input->post('opd');
        $apbp_opd = $this->model_home_front->listApbd_OPD(false, $opd, $year);
        echo json_encode($apbp_opd);
    }


    public function clistrealisasi_OPD($tahun)
    {
        $apbp_opd = $this->model_home_front->listrealisasi($tahun);
        echo json_encode($apbp_opd);
    }

    function getDetailAPBD()
    {
        $id         = $this->input->post('id');
        $year       = $this->input->post('year');
        $listData   = $this->model_home_front->getAPBDbyID($id, $year);

        // $result = [];
        foreach ($listData as $datas) {
            $nm_kegiatan =  $this->model_home_front->getKegiatanByID($datas->id_subkegiatan);
            $result[] = [
                'kegiatan'  => $nm_kegiatan,
                'nama'      => $datas->nama,
                'anggaran'  => $datas->anggaran,
                'anggaran_pergeseran'   => $datas->anggaran_pergeseran,
                'anggaran_perubahan'    => $datas->anggaran_perubahan,
            ];
        }

        echo json_encode($result);
    }

    public function pendapatan()
    {
        $year   = $this->input->post('year');
        $opd    = $this->input->post('opd');
        $apbp_opd = $this->model_home_front->listpendapatan(false, $opd, $year);
        echo json_encode($apbp_opd);
    }

    function tenderChart()
    {
        echo json_encode($this->model_tender->get_status());
    }

    function nontenderChart()
    {
        echo json_encode($this->model_nontender->get_status());
    }

    function chartStatusEpur()
    {
        echo json_encode($this->model_epurchasing->status_epur());
    }

    function detailStatus()
    {
        echo json_encode($this->model_tender->detailStatus($this->input->post('status')));
    }

    function dataTableEpur()
    {
        header('Content-Type: application/json');
        $list = $this->model_epurchasing->dataTableEpur();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $datas) {
            $no++;
            $row = array();

            $row[] =  '<strong>' . $no . '</strong>';
            $row[] = $datas->tahun_anggaran;
            $row[] = $datas->nama_satker;
            $row[] = $datas->kd_rup;
            $row[] = $datas->nama_paket;
            $row[] = $datas->kd_paket;
            $row[] = $datas->no_paket;
            $row[] = $datas->tanggal_buat_paket;
            $row[] = $datas->total;
            $row[] = $datas->kuantitas;
            $row[] = $datas->harga_satuan;
            $row[] = $datas->paket_status_str;
            $row[] = $datas->kd_penyedia;
            $row[] = $datas->kd_penyedia_distributor;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->model_epurchasing->count_all(),
            "recordsFiltered" => $this->model_epurchasing->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

    function dataTableNonTender()
    {
        header('Content-Type: application/json');
        $list = $this->model_nontender->dataTableNonTender();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $datas) {
            $no++;
            $row = array();

            $row[] =  '<strong>' . $no . '</strong>';
            $row[] = $datas->nama_satker;
            $row[] = $datas->nama_paket;
            $row[] = $datas->kd_rup_paket;
            $row[] = $datas->kd_nontender;
            $row[] = $datas->no_kontrak;
            $row[] = $datas->tgl_kontrak;
            $row[] = $datas->pagu;
            $row[] = $datas->nilai_kontrak;
            $row[] = $datas->nama_penyedia;
            $row[] = $datas->tgl_mulai_kerja_spmk;
            $row[] = $datas->tgl_selesai_kerja_spmk;
            $row[] = $datas->no_bast;
            $row[] = $datas->tgl_bast;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->model_nontender->count_all(),
            "recordsFiltered" => $this->model_nontender->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

    function dataTableTender()
    {
        header('Content-Type: application/json');
        $list = $this->model_tender->dataTableTender();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $datas) {
            $no++;
            $row = array();

            $row[] =  '<strong>' . $no . '</strong>';
            $row[] = $datas->nama_satker;
            $row[] = $datas->nama_paket;
            $row[] = $datas->kd_rup_paket;
            $row[] = $datas->kd_tender;
            $row[] = $datas->no_kontrak;
            $row[] = $datas->tgl_kontrak;
            $row[] = $datas->pagu;
            $row[] = $datas->nilai_kontrak;
            $row[] = $datas->nama_penyedia;
            $row[] = $datas->tgl_mulai_kerja_spmk;
            $row[] = $datas->tgl_selesai_kerja_spmk;
            $row[] = $datas->no_bast;
            $row[] = $datas->tgl_bast;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->model_tender->count_all(),
            "recordsFiltered" => $this->model_tender->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

    function dataTableRealisasi()
    {
        header('Content-Type: application/json');
        $list = $this->model_monev->dataTableRealisasi();
        $data = array();
        $no = $this->input->post('start');
        // var_dump($this->model_monev->count_filtered());
        // die;
        foreach ($list as $datas) {
            $no++;
            $row = array();
            $row[] =  '<strong>' . $no . '</strong>';
            $row[] = $datas->tahun;
            $row[] = $datas->nama_skpd;
            $row[] = $datas->anggaran;
            $row[] = $datas->perubahan;
            $row[] = $datas->jml_realisasi;
            $row[] = $datas->januari;
            $row[] = $datas->februari;
            $row[] = $datas->maret;
            $row[] = $datas->april;
            $row[] = $datas->mei;
            $row[] = $datas->juni;
            $row[] = $datas->juli;
            $row[] = $datas->agustus;
            $row[] = $datas->september;
            $row[] = $datas->oktober;
            $row[] = $datas->nopember;
            $row[] = $datas->desember;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->model_monev->count_all(),
            "recordsFiltered" => $this->model_monev->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }



    // table paket_penyedia_opt1618s
    function get_paket_penyedia_opt1618s()
    {
        $year       = $this->input->post('year');
        $kd_satker_str   = $this->input->post('opd');
        $list_satker = $this->model_home_front->list_satker($kd_satker_str);
        $data = array();

        $no = 0;
        foreach ($list_satker as $opd) {
            $no++;
            $tender     = $this->model_home_front->getByMethod($opd->id, $year, 'tender');
            $seleksi    = $this->model_home_front->getByMethod($opd->id, $year, 'seleksi');
            $epurc      = $this->model_home_front->getByMethod($opd->id, $year, 'e-Purchasing');
            $pl         = $this->model_home_front->getByMethod($opd->id, $year, 'Pengadaan Langsung');
            $juksung    = $this->model_home_front->getByMethod($opd->id, $year, 'Penunjukan Langsung');
            $dk         = $this->model_home_front->getByMethod($opd->id, $year, 'Dikecualikan');
            $swakelola  = $this->model_home_front->getByMethodSwakelola($opd->id, $year);
            // $darurat    = $this->model_home_front->getByMethod($opd->id, $year, 'Darurat');


            $total              = (isset($tender->jml) ? $tender->jml : 0) + (isset($epurc->jml) ? $epurc->jml : 0) + (isset($pl->jml) ? $pl->jml : 0) + (isset($dk->jml) ? $dk->jml : 0) + (isset($swakelola->jml) ? $swakelola->jml : 0);
            $totalPaguAnggaran  = (isset($tender->total) ? $tender->total : 0) + (isset($epurc->total) ? $epurc->total : 0) + (isset($pl->total) ? $pl->total : 0) + (isset($dk->total) ? $dk->total : 0) + (isset($swakelola->total) ? $swakelola->total : 0);
            // $row = [];
            $row['no']  = $no;
            $row['nama']        = $opd->nama_satker;
            $row['tender']      = isset($tender->jml) ? $tender->jml : "";
            $row['pagutender']  = isset($tender->total) ? $this->rupiah($tender->total) : "";
            $row['seleksi']     = isset($seleksi->jml) ? $seleksi->jml : "";
            $row['paguseleksi'] = isset($seleksi->total) ? $this->rupiah($seleksi->total) : "";
            $row['epur']        = isset($epurc->jml) ? $epurc->jml : "";
            $row['paguepur']    = isset($epurc->total) ? $this->rupiah($epurc->total) : "";
            $row['pl']          = isset($pl->jml) ? $pl->jml : "";
            $row['pagupl']      = isset($pl->total) ? $this->rupiah($pl->total) : "";
            $row['juksung']     = isset($juksung->jml) ? $juksung->jml : "";
            $row['pagujuksung'] = isset($juksung->total) ? $this->rupiah($juksung->total) : "";
            $row['dk']          = isset($dk->jml) ? $dk->jml : "";
            $row['pagudk']      = isset($dk->total) ? $this->rupiah($dk->total) : "";
            $row['sw']          = isset($swakelola->jml) ? $swakelola->jml : "";
            $row['pagusw']      = isset($swakelola->total) ? $this->rupiah($swakelola->total) : "";
            $row['total']       = $total > 0 ? $total : "";
            $row['totalpagu']   = $totalPaguAnggaran > 0 ? $this->rupiah($totalPaguAnggaran) : "";

            $data['data'][] = $row;
        }
        echo json_encode($data);
    }

    function rupiah($angka)
    {
        $hasil_rupiah = number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}


/* End of file Web.php */
/* Location: ./application/controllers/Web.php */
