<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Ekontrak extends API
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('model_group');
        $this->load->model('web/model_home_front', 'model_home_front');
    }

    public function instansi_get()
    {
        $data = $this->model_home_front->list_instansi();

        // $data = [
        //     'kd_satker_str' =>   $get->kd_satker_str,
        //     'nama_satker'    =>   $get->nama_satker,

        // ];

        $this->response([
            'status'     => true,
            'message'     => 'List Instansi',
            'data'         => $data
        ], API::HTTP_OK);
    }
}

/* End of file Group.php */
/* Location: ./application/controllers/api/Group.php */