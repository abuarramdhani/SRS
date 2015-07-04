<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class surat_returs extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *  Get All data surat_returs
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) {
        $this->db->order_by("tgl_retur", "asc");
        $result = $this->db->get('surat_retur', $limit, $offset);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function count_all() {
        $this->db->from('surat_retur');
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
        $this->db->from('surat_retur');

        $this->db->like('no_surat_peminjaman', $keyword);

        $this->db->or_like('id_user', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->or_like('nama_pelanggan', $keyword);

        return $this->db->count_all_results();
    }

    public function get_search_barang($limit, $offset) {
        $keyword = $this->session->userdata('keyword');


        $this->db->like('no_surat_peminjaman', $keyword);

        $this->db->or_like('id_user', $keyword);
        $this->db->or_like('kode_surat', $keyword);
        $this->db->or_like('nama_pelanggan', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->limit($limit, $offset);
        $result = $this->db->get("surat_retur");

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_one($id) {
        $this->db->where('id_penjualan', $id);
        $result = $this->db->get('surat_retur');

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
            'kode_surat_retur' => $this->input->post('no_faktur', TRUE),
            'tgl_peminjaman' => strip_tags($this->input->post('tgl_penjualan', TRUE)),
            'id_user' => $this->session->userdata('username'),
            'total_peminjaman' => strip_tags($this->input->post('grandTotal', TRUE)),
            //'total_penjualan' => strip_tags($this->input->post('grandTotal', TRUE)),
            'kode_surat' => strip_tags($this->input->post('no_faktur_penjualan')),
            'nama_pelanggan' => $this->input->get_post("nama_pelanggan"),
            'alamat' => $this->input->get_post("alamat"),
            'telp' => $this->input->get_post("telp"),
        );
        $this->db->insert('surat_retur', $data);
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
            'tgl_peminjaman' => strip_tags($this->input->post('tgl_penjualan', TRUE)),
            'id_user' => strip_tags($this->input->post('id_user', TRUE)),
            'total_penjualan' => strip_tags($this->input->post('total_penjualan', TRUE)),
        );


        $this->db->where('id_penjualan', $id);
        $this->db->update('surat_returs', $data);
    }

    public function lihat() {
        $id = $this->input->get_post('id');
        $query = $this->db->query("select * from surat_retur tp
                            inner join rinci_surat_retur trp on tp.no_surat_peminjaman = trp.no_surat_peminjaman
                            where tp.no_surat_peminjaman='$id'");
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

        $this->db->where('no_surat_peminjaman', $id);
        $this->db->delete('surat_retur');


        $this->db->where('no_surat_peminjaman', $id);
        $this->db->delete('rinci_surat_retur');


        /*
          $this->db->where('kode_surat_retur', $id);
          $this->db->update('surat_retur', array("hapus" => "1"));



          $this->db->where("no_surat_retur", $id);
          $this->db->update("rinci_surat_retur", array("hapus" => "1"));
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

    public function tambahBarang() {
        $data = array(
            'no_surat_retur' => $this->input->get_post("no_faktur"),
            'kode_surat' => $this->input->get_post("no_faktur_penjualan"),
            'kd_barang' => $this->input->get_post("kd_barang"),
            'nm_barang' => $this->input->get_post("nm_barang"),
            'satuan' => $this->input->get_post("satuan"),
            'jumlah' => $this->input->get_post("jumlah"),
            'sub_total_jual' => $this->input->get_post("total"),
            'harga' => $this->input->get_post("harga"),
        );
        $this->db->insert("rinci_surat_retur", $data);
    }

    public function cetakFaktur($no_faktur) {
        //$id = $this->input->get_post("no_faktur");
        //var_dump($no_faktur);
        $query = $this->db->query("select * from surat_retur tp
                            inner join rinci_surat_retur trp on tp.no_surat_peminjaman= trp.no_surat_peminjaman
                            where tp.no_surat_peminjaman='$no_faktur'");
        return $query;
    }

}
