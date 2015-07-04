<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller laporan
 * @created on : Monday, 11-May-2015 09:42:58
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */
class laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('laporans');
    }

    /**
     * List all data laporan
     *
     */
    public function index() {

        $this->template->display('laporan/form');
    }

    public function lihatLaporanBulanan() {
        //$dari =  $this->input->post("dari", TRUE);
        //$sampai = $this->input->post("sampai", TRUE);

        $data['laporan'] = $this->laporans->laporanDataBulanan()->result_array();
        $data['laporanDet'] = $this->laporans->laporanDataBulanan()->row();

        $this->load->view("laporan/lihatLaporanBulanan", $data);
    }

    public function cetakLaporanBulanan() {
        $data['cetak'] = $this->laporans->cetakLaporanBulanan()->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $this->load->view("laporan/cetakLaporanBulanan", $data);
    }

}

?>
