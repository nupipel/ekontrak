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
            $this->data['listSatker'] = $this->model_home_front->list_satker_bappeda();
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

    function getAngkaPelelangan()
    {
        $nilai_tender       = $this->model_home_front->total_params('v_tender', 'nilai_kontrak');
        $paket_tender       = $this->model_home_front->paket_params('v_tender', 'kd_paket');
        $nilai_nontender    = $this->model_home_front->total_params('v_non_tender', 'nilai_kontrak');
        $paket_nontender    = $this->model_home_front->paket_params('v_non_tender', 'kd_nontender');
        $nilai_epur         = $this->model_home_front->total_epurc();
        $paket_epur         = $this->model_home_front->paket_epurc();

        $result = [
            'nilai' => [
                'nilai_tender'      => isset($nilai_tender->nilai) ? (int)$nilai_tender->nilai : 0,
                'nilai_nontender'   => isset($nilai_nontender->nilai) ? (int)$nilai_nontender->nilai : 0,
                'nilai_epur'        => isset($nilai_epur->nilai) ? (int)$nilai_epur->nilai : 0,
            ],
            'paket' => [
                'paket_tender'      => isset($paket_tender->paket) ? (int)$paket_tender->paket : 0,
                'paket_nontender'   => isset($paket_nontender->paket) ? (int)$paket_nontender->paket : 0,
                'paket_epur'        => isset($paket_epur->paket) ? (int)$paket_epur->paket : 0,
            ]

        ];
        echo json_encode($result);
    }

    public function pengadaan()
    {
        $data = [
            'container'         => 'pengadaan',
            'get_infoumum'      => $this->model_home_front->get_infoumum(),
            'list_instansi'     => $this->model_home_front->list_instansi(),

            // 'list_e_purchasing' => $this->model_home_front->list_e_purchasing(),
        ];
        $this->template->build('home', $data);
    }

    public function pengadaan_test()
    {
        $data = [
            'container'         => 'pengadaan_test',
            'get_infoumum'      => $this->model_home_front->get_infoumum(),
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

    function tampilDetailAPBD($year, $instansi, $kegiatan)
    {

        $data = [
            'title' => "Cetak RKA | $year",
            'tahun' => $year,
            'instansi' => $instansi,
            'kegiatan' => $kegiatan,
        ];
        $this->load->view('print/detailopd', $data);
    }



    function printDetailAPBD()
    {
        $this->load->model('model_detailapbd');
        $idKegiatan = $this->input->post('kegiatan');
        $opd        = $this->input->post('instansi');
        $year       = $this->input->post('tahun');

        $unit           = $this->model_home_front->getUnit($opd, 'id');
        $namaKegiatan   = $this->model_home_front->getKegiatan($idKegiatan);

        $get_subkegiatan = $this->model_home_front->GET_list_subkegiatan_by_kegiatan($idKegiatan, $opd, $year);
        $subKegiatan = [];
        foreach ($get_subkegiatan as $_subkegiatan) {
            $get_parent = $this->model_detailapbd->list_parentAkun($_subkegiatan->id, $opd, $year);
            $parentakun = [];
            foreach ($get_parent as $_parent) {
                $get_akun = $this->model_detailapbd->listKodeAkun($_parent->kode_parent_akun, $_subkegiatan->id, $opd, $year);
                $akun = [];
                foreach ($get_akun as $_akun) {
                    $akun[] = [
                        'kode_akun' => $_akun->kode_akun,
                        'nama_akun' => $_akun->nama_akun,
                        'total'     => (int)$_akun->total,
                    ];
                }
                $parentakun[] = [
                    'kode_parent'   => $_parent->kode_parent_akun,
                    'nama_parent'   => $_parent->nama_parent_akun,
                    'total'         => (int)$_parent->total,
                    'akun'          => $akun,
                ];
            }
            $subKegiatan[] = [
                'kode_subkegiatan'  => $_subkegiatan->kode,
                'nama_subkegiatan'  => $_subkegiatan->uraian,
                'parent_akun'       => $parentakun,
            ];
        }
        $data = [
            'unit'          => $unit->nama_skpd,
            'kegiatan'      => $namaKegiatan->uraian,
            'subkegiatan'   => $subKegiatan,
        ];
        echo json_encode($data);
    }

    function getListKegiatan()
    {
        $year   = $this->input->post('tahun');
        $opd    = $this->input->post('id_skpd');
        $res =  $this->model_home_front->GET_list_kegiatan_by_opd($opd, $year);
        echo json_encode($res);
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


        $_total = [
            'tender'   => 0,
            '_tender'   => 0,
            'seleksi'   => 0,
            '_seleksi'   => 0,
            'epur'   => 0,
            '_epur'   => 0,
            'pl'   => 0,
            '_pl'   => 0,
            'juksung'   => 0,
            '_juksung'   => 0,
            'dk'   => 0,
            '_dk'   => 0,
            'sw'   => 0,
            '_sw'   => 0,
            'total'   => 0,
            '_total'   => 0,
        ];

        $no = 0;
        foreach ($list_satker as $opd) {
            $no++;
            $tender     = $this->model_home_front->getByMethod($opd->id, $year, 'Tender');
            $seleksi    = $this->model_home_front->getByMethod($opd->id, $year, 'Seleksi');
            $epurc      = $this->model_home_front->getByMethod($opd->id, $year, 'e-Purchasing');
            $pl         = $this->model_home_front->getByMethod($opd->id, $year, 'Pengadaan Langsung');
            $juksung    = $this->model_home_front->getByMethod($opd->id, $year, 'Penunjukan Langsung');
            $dk         = $this->model_home_front->getByMethod($opd->id, $year, 'Dikecualikan');
            $swakelola  = $this->model_home_front->getByMethodSwakelola($opd->id, $year);
            // $darurat    = $this->model_home_front->getByMethod($opd->id, $year, 'Darurat');

            $getapbd = $this->model_home_front->listApbd_OPD(false, $opd->kd_satker_str, $year);
            if ($getapbd) {
                if ($getapbd[0]->anggaran_perubahan) {
                    $apbd = $getapbd[0]->anggaran_perubahan;
                } else if ($getapbd[0]->anggaran_pergeseran) {
                    $apbd = $getapbd[0]->anggaran_pergeseran;
                } else if ($getapbd[0]->anggaran) {
                    $apbd = $getapbd[0]->anggaran;
                }
            } else {
                $apbd = 0;
            }

            $total              = (isset($tender->jml) ? $tender->jml : 0) + (isset($epurc->jml) ? $epurc->jml : 0) + (isset($pl->jml) ? $pl->jml : 0) + (isset($dk->jml) ? $dk->jml : 0) + (isset($swakelola->jml) ? $swakelola->jml : 0);
            $totalPaguAnggaran  = (isset($tender->total) ? $tender->total : 0) + (isset($epurc->total) ? $epurc->total : 0) + (isset($pl->total) ? $pl->total : 0) + (isset($dk->total) ? $dk->total : 0) + (isset($swakelola->total) ? $swakelola->total : 0);
            // $row = [];
            $row['no']  = $no;
            $row['nama']        = $opd->nama_satker;
            $row['tender']      = $tender->jml ?? 0;
            $row['pagutender']  = $tender->total ?? 0;
            $row['seleksi']     = $seleksi->jml ?? 0;
            $row['paguseleksi'] = $seleksi->total ?? 0;
            $row['epur']        = $epurc->jml ?? 0;
            $row['paguepur']    = $epurc->total ?? 0;
            $row['pl']          = $pl->jml ?? 0;
            $row['pagupl']      = $pl->total ?? 0;
            $row['juksung']     = $juksung->jml ?? 0;
            $row['pagujuksung'] = $juksung->total ?? 0;
            $row['dk']          = $dk->jml ?? 0;
            $row['pagudk']      = $dk->total ?? 0;
            $row['sw']          = $swakelola->jml ?? 0;
            $row['pagusw']      = $swakelola->total ?? 0;
            $row['total']       = $total ?? 0;
            $row['totalpagu']   = $totalPaguAnggaran ?? 0;
            $row['prosentase']  = $apbd ? ($totalPaguAnggaran / $apbd * 100) : 0;

            $_total['tender']   += $row['tender'];
            $_total['_tender']  += $row['pagutender'];
            $_total['seleksi']  += $row['seleksi'];
            $_total['_seleksi'] += $row['paguseleksi'];
            $_total['epur']     += $row['epur'];
            $_total['_epur']    += $row['paguepur'];
            $_total['pl']       += $row['pl'];
            $_total['_pl']      += $row['pagupl'];
            $_total['juksung']  += $row['juksung'];
            $_total['_juksung'] += $row['pagujuksung'];
            $_total['dk']       += $row['dk'];
            $_total['_dk']      += $row['pagudk'];
            $_total['sw']       += $row['sw'];
            $_total['_sw']      += $row['pagusw'];
            $_total['total']    += $row['total'];
            $_total['_total']   += $row['totalpagu'];

            $data['data'][] = $row;
        }
        $data['sum'] = $_total;
        echo json_encode($data);
    }
}


/* End of file Web.php */
/* Location: ./application/controllers/Web.php */
