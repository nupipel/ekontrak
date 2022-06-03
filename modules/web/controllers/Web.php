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

            $this->data['total_anggaran'] = $this->model_home_front->total_anggaran();
            $this->data['total_pendapatan'] = $this->model_home_front->total_pendapatan();

            $this->template->build('home', $this->data);

            //$this->template->build('home');
        }
    }

    public function pengadaan()
    {
        $data = [
            'container'         => 'pengadaan',
            'get_infoumum'      => $this->model_home_front->get_infoumum(),
            'nilai_epur'        => $this->model_home_front->total_params('paket_e_purchasings', 'total'),
            'paket_epur'        => $this->model_home_front->paket_params('paket_e_purchasings', 'kd_paket'),

            'list_e_purchasing' => $this->model_home_front->list_e_purchasing(),
        ];
        $this->template->build('home', $data);
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
        $apbp_opd = $this->model_home_front->listApbd_OPD(10);
        foreach ($apbp_opd as $x) :
            $label[]    = $x->nama;
            $val[]      = $x->anggaran;
        endforeach;

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
        $apbp_opd = $this->model_home_front->listpendapatan(10);
        foreach ($apbp_opd as $x) :
            $label[]    = $x->nama;
            $val[]      = $x->anggaran;
        endforeach;

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
        $apbp_opd = $this->model_home_front->listApbd_OPD();
        echo json_encode($apbp_opd);
    }

    public function pendapatan()
    {
        $apbp_opd = $this->model_home_front->listpendapatan();
        echo json_encode($apbp_opd);
    }


    function chartStatusEpur()
    {
        echo json_encode($this->model_home_front->status_epur());
    }

    function dataTableEpur()
    {
        $result = [
            "draw" => 1,
            "recordsTotal" => 57,
            "recordsFiltered" => 57,
            "data" => [
                [
                    "Airi",
                    "Satou",
                    "Accountant",
                    "Tokyo",
                    "28th Nov 08",
                    "$162,700"
                ],
                [
                    "Angelica",
                    "Ramos",
                    "Chief Executive Officer (CEO)",
                    "London",
                    "9th Oct 09",
                    "$1,200,000"
                ],
                [
                    "Ashton",
                    "Cox",
                    "Junior Technical Author",
                    "San Francisco",
                    "12th Jan 09",
                    "$86,000"
                ],
                [
                    "Bradley",
                    "Greer",
                    "Software Engineer",
                    "London",
                    "13th Oct 12",
                    "$132,000"
                ],
                [
                    "Brenden",
                    "Wagner",
                    "Software Engineer",
                    "San Francisco",
                    "7th Jun 11",
                    "$206,850"
                ],
                [
                    "Brielle",
                    "Williamson",
                    "Integration Specialist",
                    "New York",
                    "2nd Dec 12",
                    "$372,000"
                ],
                [
                    "Bruno",
                    "Nash",
                    "Software Engineer",
                    "London",
                    "3rd May 11",
                    "$163,500"
                ],
                [
                    "Caesar",
                    "Vance",
                    "Pre-Sales Support",
                    "New York",
                    "12th Dec 11",
                    "$106,450"
                ],
                [
                    "Cara",
                    "Stevens",
                    "Sales Assistant",
                    "New York",
                    "6th Dec 11",
                    "$145,600"
                ],
                [
                    "Cedric",
                    "Kelly",
                    "Senior Javascript Developer",
                    "Edinburgh",
                    "29th Mar 12",
                    "$433,060"
                ],
                [
                    "Airi",
                    "Satou",
                    "Accountant",
                    "Tokyo",
                    "28th Nov 08",
                    "$162,700"
                ],
                [
                    "Angelica",
                    "Ramos",
                    "Chief Executive Officer (CEO)",
                    "London",
                    "9th Oct 09",
                    "$1,200,000"
                ],
                [
                    "Ashton",
                    "Cox",
                    "Junior Technical Author",
                    "San Francisco",
                    "12th Jan 09",
                    "$86,000"
                ],
                [
                    "Bradley",
                    "Greer",
                    "Software Engineer",
                    "London",
                    "13th Oct 12",
                    "$132,000"
                ],
                [
                    "Brenden",
                    "Wagner",
                    "Software Engineer",
                    "San Francisco",
                    "7th Jun 11",
                    "$206,850"
                ],
                [
                    "Brielle",
                    "Williamson",
                    "Integration Specialist",
                    "New York",
                    "2nd Dec 12",
                    "$372,000"
                ],
                [
                    "Bruno",
                    "Nash",
                    "Software Engineer",
                    "London",
                    "3rd May 11",
                    "$163,500"
                ],
                [
                    "Caesar",
                    "Vance",
                    "Pre-Sales Support",
                    "New York",
                    "12th Dec 11",
                    "$106,450"
                ],
                [
                    "Cara",
                    "Stevens",
                    "Sales Assistant",
                    "New York",
                    "6th Dec 11",
                    "$145,600"
                ],
                [
                    "Cedric",
                    "Kelly",
                    "Senior Javascript Developer",
                    "Edinburgh",
                    "29th Mar 12",
                    "$433,060"
                ],
                [
                    "Charde",
                    "Marshall",
                    "Regional Director",
                    "San Francisco",
                    "16th Oct 08",
                    "$470,600"
                ],
                [
                    "Colleen",
                    "Hurst",
                    "Javascript Developer",
                    "San Francisco",
                    "15th Sep 09",
                    "$205,500"
                ],
                [
                    "Dai",
                    "Rios",
                    "Personnel Lead",
                    "Edinburgh",
                    "26th Sep 12",
                    "$217,500"
                ],
                [
                    "Donna",
                    "Snider",
                    "Customer Support",
                    "New York",
                    "25th Jan 11",
                    "$112,000"
                ],
                [
                    "Doris",
                    "Wilder",
                    "Sales Assistant",
                    "Sidney",
                    "20th Sep 10",
                    "$85,600"
                ],
                [
                    "Finn",
                    "Camacho",
                    "Support Engineer",
                    "San Francisco",
                    "7th Jul 09",
                    "$87,500"
                ],
                [
                    "Fiona",
                    "Green",
                    "Chief Operating Officer (COO)",
                    "San Francisco",
                    "11th Mar 10",
                    "$850,000"
                ],
                [
                    "Garrett",
                    "Winters",
                    "Accountant",
                    "Tokyo",
                    "25th Jul 11",
                    "$170,750"
                ],
                [
                    "Gavin",
                    "Joyce",
                    "Developer",
                    "Edinburgh",
                    "22nd Dec 10",
                    "$92,575"
                ],
                [
                    "Gavin",
                    "Cortez",
                    "Team Leader",
                    "San Francisco",
                    "26th Oct 08",
                    "$235,500"
                ],
                [
                    "Gloria",
                    "Little",
                    "Systems Administrator",
                    "New York",
                    "10th Apr 09",
                    "$237,500"
                ],
                [
                    "Haley",
                    "Kennedy",
                    "Senior Marketing Designer",
                    "London",
                    "18th Dec 12",
                    "$313,500"
                ],
                [
                    "Hermione",
                    "Butler",
                    "Regional Director",
                    "London",
                    "21st Mar 11",
                    "$356,250"
                ],
                [
                    "Herrod",
                    "Chandler",
                    "Sales Assistant",
                    "San Francisco",
                    "6th Aug 12",
                    "$137,500"
                ],
                [
                    "Hope",
                    "Fuentes",
                    "Secretary",
                    "San Francisco",
                    "12th Feb 10",
                    "$109,850"
                ],
                [
                    "Howard",
                    "Hatfield",
                    "Office Manager",
                    "San Francisco",
                    "16th Dec 08",
                    "$164,500"
                ],
                [
                    "Jackson",
                    "Bradshaw",
                    "Director",
                    "New York",
                    "26th Sep 08",
                    "$645,750"
                ],
                [
                    "Jena",
                    "Gaines",
                    "Office Manager",
                    "London",
                    "19th Dec 08",
                    "$90,560"
                ],
                [
                    "Jenette",
                    "Caldwell",
                    "Development Lead",
                    "New York",
                    "3rd Sep 11",
                    "$345,000"
                ],
                [
                    "Jennifer",
                    "Chang",
                    "Regional Director",
                    "Singapore",
                    "14th Nov 10",
                    "$357,650"
                ],
                [
                    "Jennifer",
                    "Acosta",
                    "Junior Javascript Developer",
                    "Edinburgh",
                    "1st Feb 13",
                    "$75,650"
                ],
                [
                    "Jonas",
                    "Alexander",
                    "Developer",
                    "San Francisco",
                    "14th Jul 10",
                    "$86,500"
                ],
                [
                    "Lael",
                    "Greer",
                    "Systems Administrator",
                    "London",
                    "27th Feb 09",
                    "$103,500"
                ],
                [
                    "Martena",
                    "Mccray",
                    "Post-Sales support",
                    "Edinburgh",
                    "9th Mar 11",
                    "$324,050"
                ],
                [
                    "Michael",
                    "Silva",
                    "Marketing Designer",
                    "London",
                    "27th Nov 12",
                    "$198,500"
                ],
                [
                    "Michael",
                    "Bruce",
                    "Javascript Developer",
                    "Singapore",
                    "27th Jun 11",
                    "$183,000"
                ],
                [
                    "Michelle",
                    "House",
                    "Integration Specialist",
                    "Sidney",
                    "2nd Jun 11",
                    "$95,400"
                ],
                [
                    "Olivia",
                    "Liang",
                    "Support Engineer",
                    "Singapore",
                    "3rd Feb 11",
                    "$234,500"
                ],
                [
                    "Paul",
                    "Byrd",
                    "Chief Financial Officer (CFO)",
                    "New York",
                    "9th Jun 10",
                    "$725,000"
                ],
                [
                    "Prescott",
                    "Bartlett",
                    "Technical Author",
                    "London",
                    "7th May 11",
                    "$145,000"
                ],
                [
                    "Quinn",
                    "Flynn",
                    "Support Lead",
                    "Edinburgh",
                    "3rd Mar 13",
                    "$342,000"
                ],
                [
                    "Rhona",
                    "Davidson",
                    "Integration Specialist",
                    "Tokyo",
                    "14th Oct 10",
                    "$327,900"
                ],
                [
                    "Sakura",
                    "Yamamoto",
                    "Support Engineer",
                    "Tokyo",
                    "19th Aug 09",
                    "$139,575"
                ],
                [
                    "Serge",
                    "Baldwin",
                    "Data Coordinator",
                    "Singapore",
                    "9th Apr 12",
                    "$138,575"
                ],
                [
                    "Shad",
                    "Decker",
                    "Regional Director",
                    "Edinburgh",
                    "13th Nov 08",
                    "$183,000"
                ],
                [
                    "Shou",
                    "Itou",
                    "Regional Marketing",
                    "Tokyo",
                    "14th Aug 11",
                    "$163,000"
                ],
                [
                    "Sonya",
                    "Frost",
                    "Software Engineer",
                    "Edinburgh",
                    "13th Dec 08",
                    "$103,600"
                ],
                [
                    "Suki",
                    "Burks",
                    "Developer",
                    "London",
                    "22nd Oct 09",
                    "$114,500"
                ],
                [
                    "Tatyana",
                    "Fitzpatrick",
                    "Regional Director",
                    "London",
                    "17th Mar 10",
                    "$385,750"
                ],
                [
                    "Thor",
                    "Walton",
                    "Developer",
                    "New York",
                    "11th Aug 13",
                    "$98,540"
                ],
                [
                    "Tiger",
                    "Nixon",
                    "System Architect",
                    "Edinburgh",
                    "25th Apr 11",
                    "$320,800"
                ],
                [
                    "Timothy",
                    "Mooney",
                    "Office Manager",
                    "London",
                    "11th Dec 08",
                    "$136,200"
                ],
                [
                    "Unity",
                    "Butler",
                    "Marketing Designer",
                    "San Francisco",
                    "9th Dec 09",
                    "$85,675"
                ],
                [
                    "Vivian",
                    "Harrell",
                    "Financial Controller",
                    "San Francisco",
                    "14th Feb 09",
                    "$452,500"
                ],
                [
                    "Yuri",
                    "Berry",
                    "Chief Marketing Officer (CMO)",
                    "New York",
                    "25th Jun 09",
                    "$675,000"
                ],
                [
                    "Zenaida",
                    "Frank",
                    "Software Engineer",
                    "New York",
                    "4th Jan 10",
                    "$125,250"
                ],
                [
                    "Zorita",
                    "Serrano",
                    "Software Engineer",
                    "San Francisco",
                    "1st Jun 12",
                    "$115,000"
                ]
            ]
        ];
        echo json_encode($result);
        // echo json_encode($this->model_home_front->dataTableEpur());
    }
}


/* End of file Web.php */
/* Location: ./application/controllers/Web.php */
