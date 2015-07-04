<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class tabel_penjualans extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *  Get All data tabel_penjualans
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) {
        $this->db->order_by("tgl_penjualan", "asc");
        $result = $this->db->get('tabel_penjualan', $limit, $offset);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function count_all() {
        $this->db->from('tabel_penjualan');
        return $this->db->count_all_results();
    }

    public function get_searchSupplier($limit, $offset) {
        $keyword = $this->input->post('carisupplier');

        $this->db->like('nm_supplier', $keyword);
        $this->db->limit($limit, $offset);
        $result = $this->db->get('tabel_supplier');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_search($limit, $offset) {
        $keyword = $this->input->post('caribarang');

        $this->db->like('nm_barang', $keyword);
        $this->db->limit($limit, $offset);
        $result = $this->db->get('tabel_barang');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function count_all_search() {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('tabel_penjualan');

        $this->db->or_like('no_faktur_penjualan', $keyword);

        $this->db->or_like('id_user', $keyword);

        return $this->db->count_all_results();
    }

    public function get_one($id) {
        $this->db->where('id_penjualan', $id);
        $result = $this->db->get('tabel_penjualan');

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function add() {
        $data = array(
            'no_faktur' => '',
            'kd_supplier' => '',
            'tgl_penjualan' => '',
            'id_user' => '',
            'total_penjulan' => '',
        );

        return $data;
    }

    public function save() {
        $data = array(
            'no_faktur_penjualan' => $this->input->post('no_faktur', TRUE),
            'tgl_penjualan' => strip_tags($this->input->post('tgl_penjualan', TRUE)),
            'kode_surat' => strip_tags($this->input->post('no_invoice', TRUE)),
            'nm_pelanggan' => strip_tags($this->input->post('pelanggan', TRUE)),
            'alamat' => strip_tags($this->input->post('alamat', TRUE)),
            'telp' => strip_tags($this->input->post('telp', TRUE)),
            'id_user' => $this->session->userdata('username'),
            'total_penjualan' => strip_tags($this->input->post('grandTotal', TRUE)),
        );
        $this->db->insert('tabel_penjualan', $data);
    }

    /**
     *  Update modify data
     *
     *  @param id : Integer
     *
     *  @return void
     *
     */
    public function update($id) {
        $data = array(
            'no_faktur' => strip_tags($this->input->post('no_faktur', TRUE)),
            'kd_supplier' => strip_tags($this->input->post('kd_supplier', TRUE)),
            'tgl_penjualan' => strip_tags($this->input->post('tgl_penjualan', TRUE)),
            'id_user' => strip_tags($this->input->post('id_user', TRUE)),
            'total_penjualan' => strip_tags($this->input->post('total_penjualan', TRUE)),
        );


        $this->db->where('id_penjualan', $id);
        $this->db->update('tabel_penjualans', $data);
    }

    public function lihat() {
        $id = $this->input->get_post('id');

        $query = $this->db->query("select * from tabel_penjualan tp
                            inner join tabel_rinci_penjualan trp on tp.no_faktur_penjualan = trp.no_faktur_penjualan 
                            where tp.no_faktur_penjualan='$id'");
        return $query;
    }

    /**
     *  Delete data by id
     *
     *  @param id : Integer
     *
     *  @return void
     *
     */
    public function destroy($id) {

        $this->db->where('no_faktur_penjualan', $id);
        $this->db->delete("tabel_penjualan");


        $this->db->where('no_faktur_penjualan', $id);
        $this->db->delete("tabel_rinci_penjualan");



        /*
          $this->db->where('no_faktur_penjualan', $id);
          $this->db->update('tabel_penjualan', array("hapus" => "1"));



          $this->db->where("no_faktur_penjualan", $id);
          $this->db->update("tabel_rinci_penjualan", array("hapus" => "1"));
         * 
         */
    }

    /* Get Supplier for modal */

    public function getSupplier() {
        $data = $this->db->get("tabel_supplier")->result_array();
        return $data;
    }

    public function getBarang() {
        $data = $this->db->get("tabel_barang")->result_array();
        return $data;
    }

    public function no_urut() {

        $today = date('Ymd');
        $query = $this->db->query("select max(no_faktur_penjualan) as last from tabel_penjualan where no_faktur_penjualan like '%$today%'");
        $data = $query->row_array();
        $lastNoFaktur = $data['last'];

//PJ20150513001
        $lastNoUrut = substr($lastNoFaktur, 10, 3);

        $nextNoUrut = $lastNoUrut + 1;

        $nextNoTransaksi = 'PJ' . $today . sprintf('%03s', $nextNoUrut);

        return $nextNoTransaksi;
    }

    public function tambahBarang() {
        $data = array(
            'no_faktur_penjualan' => $this->input->get_post("no_faktur"),
            'kd_barang' => $this->input->get_post("kd_barang"),
            'nm_barang' => $this->input->get_post("nm_barang"),
            'satuan' => $this->input->get_post("satuan"),
            'jumlah' => $this->input->get_post("jumlah"),
            'sub_total_jual' => $this->input->get_post("total"),
            'kode_surat' => $this->input->get_post("no_invoice"),
            'harga' => $this->input->get_post("harga"),
            'ukuran' => $this->input->get_post("ukuran"),
        );
        $this->db->insert("tabel_rinci_penjualan", $data);
    }

    public function cetakFaktur($no_faktur) {
//$id = $this->input->get_post("no_faktur");
//var_dump($no_faktur);
        $query = $this->db->query("select * from tabel_penjualan tp
                            inner join tabel_rinci_penjualan trp on tp.no_faktur_penjualan = trp.no_faktur_penjualan 
                            where tp.no_faktur_penjualan='$no_faktur'");
        return $query;
    }

    public function inputTemp() {
//$id = $this->input->get_post("no_faktur");
//var_dump($no_faktur);
        $data = array(
            'no_faktur_penjualan' => $this->input->get_post("no_faktur"),
            'kd_barang' => $this->input->get_post("kd_barang"),
            'nm_barang' => $this->input->get_post("nm_barang"),
            'satuan' => $this->input->get_post("satuan"),
            'jumlah' => $this->input->get_post("jumlah"),
            'sub_total_jual' => $this->input->get_post("total"),
            'harga' => $this->input->get_post("hrg_jual"),
        );
        $this->db->insert("tmp", $data);
    }

}
