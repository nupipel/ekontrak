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
    function angkaekontrak_get()
    {
        $opd = $this->get('opd');
        $year = $this->get('year');

        $nilai_tender       = $this->model_home_front->total_params('v_tender', 'nilai_kontrak', $opd, $year);
        $paket_tender       = $this->model_home_front->paket_params('v_tender', 'kd_paket', $opd, $year);
        $nilai_nontender    = $this->model_home_front->total_params('v_non_tender', 'nilai_kontrak', $opd, $year);
        $paket_nontender    = $this->model_home_front->paket_params('v_non_tender', 'kd_nontender', $opd, $year);
        $nilai_epur         = $this->model_home_front->total_epurc($opd, $year);
        $paket_epur         = $this->model_home_front->paket_epurc($opd, $year);

        $result = [
            'tender' => [
                [
                    'jenis' => 'Sirup',
                    'paket' => $paket_tender->paket ?? 0,
                    'pagu'  => $nilai_tender->nilai ?? 0,
                ],
                [
                    'jenis' => 'Proses',
                    'paket' => 140,
                    'pagu'  => 300000000000,
                ],
                [
                    'jenis' => 'Kontrak',
                    'paket' => 100,
                    'pagu'  => 200000000000,
                ],
                [
                    'jenis' => 'Selesai',
                    'paket' => 10,
                    'pagu'  => 50000000000,
                ]

            ],
            'nontender' => [
                [
                    'jenis' => 'Sirup',
                    'paket' => $paket_nontender->paket ?? 0,
                    'pagu'  => $nilai_nontender->nilai ?? 0,
                ],
                [
                    'jenis' => 'Proses',
                    'paket' => 140,
                    'pagu'  => 300000000000,
                ],
                [
                    'jenis' => 'Kontrak',
                    'paket' => 100,
                    'pagu'  => 200000000000,
                ],
                [
                    'jenis' => 'Selesai',
                    'paket' => 10,
                    'pagu'  => 50000000000,
                ]

            ],
            'epurchasing' => [
                [
                    'jenis' => 'Sirup',
                    'paket' => $paket_epur->paket ?? 0,
                    'pagu'  => $nilai_epur->nilai ?? 0,
                ],
                [
                    'jenis' => 'Proses',
                    'paket' => 140,
                    'pagu'  => 300000000000,
                ],
                [
                    'jenis' => 'Kontrak',
                    'paket' => 100,
                    'pagu'  => 200000000000,
                ],
                [
                    'jenis' => 'Selesai',
                    'paket' => 10,
                    'pagu'  => 50000000000,
                ]
            ]
        ];
        $this->response([
            'status'     => true,
            'message'     => 'success',
            'data'         => $result
        ], API::HTTP_OK);
    }
}

/* End of file Group.php */
/* Location: ./application/controllers/api/Group.php */