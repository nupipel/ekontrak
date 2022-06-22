<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Ekontrak extends API
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_tender');
        $this->load->model('model_nontender');
        $this->load->model('model_epurc');
        $this->load->model('web/model_home_front', 'model_home_front');
    }

    public function instansi_get()
    {
        $data = $this->model_home_front->list_instansi();

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


        $tender = [
            'sirup'         => $this->model_tender->total_paket($opd, $year),
            'sirup_pagu'    => $this->model_tender->nilai_paket($opd, $year),
            'proses'        => $this->model_tender->proses_paket($opd, $year),
            'proses_pagu'   => $this->model_tender->proses_pagu($opd, $year),
            'kontrak'       => $this->model_tender->kontrak_paket($opd, $year),
            'kontrak_pagu'  => $this->model_tender->kontrak_pagu($opd, $year),
            'selesai'       => $this->model_tender->selesai_paket($opd, $year),
            'selesai_pagu'  => $this->model_tender->selesai_pagu($opd, $year),
        ];

        $nontender = [
            'sirup'         => $this->model_nontender->total_paket($opd, $year),
            'sirup_pagu'    => $this->model_nontender->nilai_paket($opd, $year),
            'proses'        => $this->model_nontender->proses_paket($opd, $year),
            'proses_pagu'   => $this->model_nontender->proses_pagu($opd, $year),
            'kontrak'       => $this->model_nontender->kontrak_paket($opd, $year),
            'kontrak_pagu'  => $this->model_nontender->kontrak_pagu($opd, $year),
            'selesai'       => $this->model_nontender->selesai_paket($opd, $year),
            'selesai_pagu'  => $this->model_nontender->selesai_pagu($opd, $year),
        ];

        $epurc = [
            'sirup'         => $this->model_epurc->sirup('paket', $opd, $year),
            'sirup_pagu'    => $this->model_epurc->sirup('pagu', $opd, $year),
            'proses'        => $this->model_epurc->proses('paket', $opd, $year),
            'proses_pagu'   => $this->model_epurc->proses('pagu', $opd, $year),
            'kontrak'       => $this->model_epurc->kontrak('paket', $opd, $year),
            'kontrak_pagu'  => $this->model_epurc->kontrak('pagu', $opd, $year),
            'selesai'       => $this->model_epurc->selesai('paket', $opd, $year),
            'selesai_pagu'  => $this->model_epurc->selesai('pagu', $opd, $year),
        ];

        $result = [
            'tender' => [
                [
                    'jenis' => 'Sirup',
                    'paket' => $tender['sirup']->total ?? 0,
                    'pagu'  => (int)$tender['sirup_pagu']->total ?? 0,
                ],
                [
                    'jenis' => 'Proses',
                    'paket' => $tender['proses']->total ?? 0,
                    'pagu'  => (int)$tender['proses_pagu']->total ?? 0,
                ],
                [
                    'jenis' => 'Kontrak',
                    'paket' => $tender['kontrak']->total ?? 0,
                    'pagu'  => (int)$tender['kontrak_pagu']->total ?? 0,
                ],
                [
                    'jenis' => 'Selesai',
                    'paket' => $tender['selesai']->total ?? 0,
                    'pagu'  => (int)$tender['selesai_pagu']->total ?? 0,
                ]

            ],
            'nontender' => [
                [
                    'jenis' => 'Sirup',
                    'paket' => $nontender['sirup'] ?? 0,
                    'pagu'  => (int)$nontender['sirup_pagu'] ?? 0,
                ],
                [
                    'jenis' => 'Proses',
                    'paket' => $nontender['proses'] ?? 0,
                    'pagu'  => (int)$nontender['proses_pagu'] ?? 0,
                ],
                [
                    'jenis' => 'Kontrak',
                    'paket' => $nontender['kontrak'] ?? 0,
                    'pagu'  => (int)$nontender['kontrak_pagu'] ?? 0,
                ],
                [
                    'jenis' => 'Selesai',
                    'paket' => $nontender['selesai'] ?? 0,
                    'pagu'  => (int)$nontender['selesai_pagu'] ?? 0,
                ]

            ],
            'epurchasing' => [
                [
                    'jenis' => 'Sirup',
                    'paket' =>  $epurc['sirup'] ?? 0,
                    'pagu'  =>  (int)$epurc['sirup_pagu'] ?? 0,
                ],
                [
                    'jenis' => 'Proses',
                    'paket' => $epurc['proses'] ?? 0,
                    'pagu'  => (int)$epurc['proses_pagu'] ?? 0,
                ],
                [
                    'jenis' => 'Kontrak',
                    'paket' => $epurc['kontrak'] ?? 0,
                    'pagu'  => (int)$epurc['kontrak_pagu'] ?? 0,
                ],
                [
                    'jenis' => 'Selesai',
                    'paket' => $epurc['selesai'] ?? 0,
                    'pagu'  => (int)$epurc['selesai_pagu'] ?? 0,
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