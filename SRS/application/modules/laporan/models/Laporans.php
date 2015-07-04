<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of setting_toko
 * @created on : Monday, 11-May-2015 09:42:58
 * Copyright 2015    
 */
class laporans extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function laporanDataBulanan() {

        //$where = "$tahun-$bulan";
        $dari = $this->input->post("dari", TRUE);
        $sampai = $this->input->post("sampai", TRUE);

        $query = $this->db->query("select * from tabel_penjualan p where tgl_penjualan>= '$dari' and tgl_penjualan<='$sampai'
            -- inner join tabel_rinci_penjualan rp
               -- on rp.no_faktur_penjualan = p.no_faktur_penjualan");
        return $query;
    }
    
    public function cetakLaporanBulanan() {
        $dari = $this->input->get_post("dari", TRUE);
        $sampai = $this->input->get_post("sampai", TRUE);

        $query = $this->db->query("select * from tabel_penjualan p where tgl_penjualan>= '$dari' and tgl_penjualan<='$sampai'
            -- inner join tabel_rinci_penjualan rp
               -- on rp.no_faktur_penjualan = p.no_faktur_penjualan");
        return $query;
    }

}
