<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class surat_jalans extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *  Get All data surat_jalans
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */

    /**
     * Search All surat_jalan
     *
     *  @param limit   : Integer
     *  @param offset  : Integer
     *  @param keyword : mixed
     *
     *  @return array
     *
     */
    public function get_search_barang($limit, $offset) {
        $keyword = $this->session->userdata('keyword');

        $this->db->like('kode_surat', $keyword);


        $this->db->or_like('id_user', $keyword);

        $this->db->or_like('kode_surat', $keyword);

        $this->db->or_like('nama_pelanggan', $keyword);

        $this->db->or_like('alamat', $keyword);

        $this->db->or_like('telp', $keyword);


        $this->db->limit($limit, $offset);

        $result = $this->db->get('surat_jalan');



        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    /**
     * Search All surat_jalan
     * @param keyword : mixed
     *
     * @return Integer
     *
     */
    public function count_all_barang() {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('surat_jalan');

        $this->db->like('kode_surat', $keyword);


        $this->db->or_like('id_user', $keyword);

        $this->db->or_like('kode_surat', $keyword);

        $this->db->or_like('nama_pelanggan', $keyword);

        $this->db->or_like('alamat', $keyword);

        $this->db->or_like('telp', $keyword);

        return $this->db->count_all_results();
    }

    public function searchBarang() {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);
        // cari di database
        $data = $this->db->query("select * from tabel_barang where nm_barang like '%$keyword%' ");

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->nm_barang,
                'kd_satuan' => $row->kd_satuan,
                'hrg_jual' => $row->hrg_jual,
                'kd_barang' => $row->kd_barang
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

    public function get_all($limit, $offset) {
        $this->db->order_by("tgl_penjualan", "asc");
        $result = $this->db->get('surat_jalan', $limit, $offset);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function count_all() {
        $this->db->from('surat_jalan');
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
        $this->db->from('surat_jalan');

        $this->db->or_like('kode_surat_jalan', $keyword);

        $this->db->or_like('id_user', $keyword);

        return $this->db->count_all_results();
    }

    public function get_one($id) {
        $this->db->where('id_penjualan', $id);
        $result = $this->db->get('surat_jalan');

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
            'kode_surat_jalan' => $this->input->post('no_faktur', TRUE),
            'tgl_penjualan' => strip_tags($this->input->post('tgl_penjualan', TRUE)),
            'id_user' => $this->session->userdata('username'),
            'total_penjualan' => strip_tags($this->input->post('grandTotal', TRUE)),
            'kode_surat' => strip_tags($this->input->post('no_faktur_penjualan')),
            'nama_pelanggan' => $this->input->get_post("nama_pelanggan"),
            'alamat' => $this->input->get_post("alamat"),
            'telp' => $this->input->get_post("telp"),
        );
        $this->db->insert('surat_jalan', $data);
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
        $this->db->update('surat_jalans', $data);
    }

    public function lihat() {
        $id = $this->input->get_post('id');

        $query = $this->db->query("select * from surat_jalan tp
                            inner join rinci_surat_jalan trp on tp.kode_surat_jalan = trp.no_surat_jalan 
                            where tp.kode_surat_jalan='$id'");
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


        $this->db->where('kode_surat_jalan', $id);
        $this->db->delete('surat_jalan');

        $this->db->where('no_surat_jalan', $id);
        $this->db->delete('rinci_surat_jalan');

        /*
          $this->db->where('kode_surat_jalan', $id);
          $this->db->update('surat_jalan', array("hapus" => "1"));



          $this->db->where("no_surat_jalan", $id);
          $this->db->update("rinci_surat_jalan", array("hapus" => "1"));
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
        $query = $this->db->query("select max(kode_surat_jalan) as last from surat_jalan where kode_surat_jalan like '%$today%'");
        $data = $query->row_array();
        $lastNoFaktur = $data['last'];

        //PJ20150513001
        $lastNoUrut = substr($lastNoFaktur, 10, 3);

        $nextNoUrut = $lastNoUrut + 1;

        $nextNoTransaksi = 'SJ' . $today . sprintf('%03s', $nextNoUrut);

        return $nextNoTransaksi;
    }

    public function tambahBarang() {
        $data = array(
            'no_surat_jalan' => $this->input->get_post("no_faktur"),
            'kode_surat' => $this->input->get_post("no_faktur_penjualan"),
            'kd_barang' => $this->input->get_post("kd_barang"),
            'nm_barang' => $this->input->get_post("nm_barang"),
            'satuan' => $this->input->get_post("satuan"),
            'jumlah' => $this->input->get_post("jumlah"),
            'sub_total_jual' => $this->input->get_post("total"),
            'harga' => $this->input->get_post("harga"),
            'ukuran' => $this->input->get_post("ukuran"),
        );
        $this->db->insert("rinci_surat_jalan", $data);
    }

    public function cetakFaktur($no_faktur) {
        //$id = $this->input->get_post("no_faktur");
        //var_dump($no_faktur);
        $query = $this->db->query("select * from surat_jalan tp
                            inner join rinci_surat_jalan trp on tp.kode_surat_jalan = trp.no_surat_jalan 
                            where tp.kode_surat_jalan='$no_faktur'");
        return $query;
    }

}
