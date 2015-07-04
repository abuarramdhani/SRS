<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class tabel_pembelians extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *  Get All data tabel_pembelian
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) {

        //$this->db->order_by("nama_pelanggan", "asc"); 
        $result = $this->db->get_where('tabel_pembelian',array("hapus"=>"0"), $limit, $offset);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function count_all() {
        $this->db->from('tabel_pembelian');
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
        $this->db->from('tabel_pembelian');

        $this->db->like('no_faktur', $keyword);

        $this->db->like('kd_supplier', $keyword);

        $this->db->like('id_user', $keyword);

        return $this->db->count_all_results();
    }

    public function get_one($id) {
        $this->db->where('id_pembelian', $id);
        $result = $this->db->get('tabel_pembelian');

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
            'tgl_pembelian' => '',
            'id_user' => '',
            'total_pembelian' => '',
        );

        return $data;
    }

    public function save() {
        $data = array(
            'no_faktur' => $this->input->post('no_faktur', TRUE),
            'kd_supplier' => strip_tags($this->input->post('kd_supplier', TRUE)),
            'tgl_pembelian' => strip_tags($this->input->post('tgl_pembelian', TRUE)),
            'id_user' => $this->session->userdata('username'),
            'total_pembelian' => strip_tags($this->input->post('grandTotal', TRUE)),
        );
        $this->db->insert('tabel_pembelian', $data);
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
            'tgl_pembelian' => strip_tags($this->input->post('tgl_pembelian', TRUE)),
            'id_user' => strip_tags($this->input->post('id_user', TRUE)),
            'total_pembelian' => strip_tags($this->input->post('total_pembelian', TRUE)),
        );


        $this->db->where('id_pembelian', $id);
        $this->db->update('tabel_pembelian', $data);
    }

    public function lihat() {
        $id = $this->input->get_post('id');
        
        $query = $this->db->query("select * from tabel_pembelian tp
                            inner join tabel_rinci_pembelian trp on tp.no_faktur = trp.no_faktur_pembelian 
                            INNER  JOIN tabel_supplier ts ON ts.kd_supplier = tp.kd_supplier
                            where tp.no_faktur='$id'");
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
        
        
        $this->db->where('no_faktur', $id);
        $this->db->update('tabel_pembelian',array("hapus"=>"1"));
        
        
        
        $this->db->where("no_faktur_pembelian",$id);
        $this->db->update("tabel_rinci_pembelian",array("hapus"=>"1"));
        
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
        $query = $this->db->query("select max(no_faktur) as last from tabel_pembelian where no_faktur like '%$today%'");
        $data = $query->row_array();
        $lastNoFaktur = $data['last'];

        $lastNoUrut = substr($lastNoFaktur, 10, 3);

        $nextNoUrut = $lastNoUrut + 1;

        $nextNoTransaksi = 'PM'.$today . sprintf('%03s', $nextNoUrut);

        return $nextNoTransaksi;
    }

    public function tambahBarang() {
        $data = array(
            'no_faktur_pembelian' => $this->input->get_post("no_faktur"),
            'kd_barang' => $this->input->get_post("kd_barang"),
            'nm_barang' => $this->input->get_post("nm_barang"),
            'satuan' => $this->input->get_post("satuan"),
            'jumlah' => $this->input->get_post("jumlah"),
            'sub_total_beli' => $this->input->get_post("total"),
            'harga' => $this->input->get_post("harga"),
        );
        $this->db->insert("tabel_rinci_pembelian", $data);
    }

    public function cetakFaktur($no_faktur) {
        //$id = $this->input->get_post("no_faktur");
        //var_dump($no_faktur);
        $query = $this->db->query("select * from tabel_pembelian tp
                            inner join tabel_rinci_pembelian trp on tp.no_faktur = trp.no_faktur_pembelian 
                            INNER  JOIN tabel_supplier ts ON ts.kd_supplier = tp.kd_supplier
                            where tp.no_faktur='$no_faktur'");
        return $query;
    }

}
