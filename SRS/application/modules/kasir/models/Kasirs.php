<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class kasirs extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *  Get All data tabel_barang
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) {
        $this->db->order_by("nm_barang", "asc");
        $result = $this->db->get('tabel_barang', $limit, $offset);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    /**
     *  Count All tabel_barang
     *    
     *  @return Integer
     *
     */
    public function no_urut() {

        $today = date('Ymd');
        $query = $this->db->query("select max(kode_keluar) as last from keluar_barang where kode_keluar like '%$today%'");
        $data = $query->row_array();
        $lastNoFaktur = $data['last'];

        //PJ20150513001
        $lastNoUrut = substr($lastNoFaktur, 10, 3);

        $nextNoUrut = $lastNoUrut + 1;

        $nextNoTransaksi = $today . sprintf('%03s', $nextNoUrut);

        return $nextNoTransaksi;
    }

    public function count_all() {
        $this->db->from('tabel_barang');
        return $this->db->count_all_results();
    }

    /**
     * Search All tabel_barang
     *
     *  @param limit   : Integer
     *  @param offset  : Integer
     *  @param keyword : mixed
     *
     *  @return array
     *
     */
    public function get_search($limit, $offset) {
        $keyword = $this->session->userdata('keyword');

        $this->db->like('kd_barang', $keyword);

        $this->db->or_like('nm_barang', $keyword);

        $this->db->or_like('kd_satuan', $keyword);

        $this->db->or_like('kd_kategori', $keyword);

        $this->db->limit($limit, $offset);
        $result = $this->db->get('tabel_barang');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    /**
     * Search All tabel_barang
     * @param keyword : mixed
     *
     * @return Integer
     *
     */
    public function count_all_search() {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('tabel_barang');

        $this->db->or_like('kd_barang', $keyword);

        $this->db->or_like('nm_barang', $keyword);

        $this->db->or_like('kd_satuan', $keyword);

        $this->db->or_like('kd_kategori', $keyword);

        return $this->db->count_all_results();
    }

    /**
     *  Get One tabel_barang
     *
     *  @param id : Integer
     *
     *  @return array
     *
     */
    public function get_one($id) {
        $this->db->where('id_barang', $id);
        $result = $this->db->get('tabel_barang');

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    /**
     *  Default form data tabel_barang
     *  @return array
     *
     */
    public function add() {
        $data = array(
            'id_barang' => '',
            'kd_barang' => '',
            'nm_barang' => '',
            'kd_satuan' => '',
            'kd_kategori' => '',
            'hrg_jual' => '',
            'hrg_beli' => '',
            'deskripsi' => '',
            'stok' => '',
            'diskon' => '',
            'tgl_masuk' => '',
            'dibeli' => '',
            'ukuran' => '',
        );

        return $data;
    }

    /**
     *  Save data Post
     *
     *  @return void
     *
     */
    public function save() {
        $data = array(
            'kd_barang' => strip_tags($this->input->post('kd_barang', TRUE)),
            'nm_barang' => strip_tags($this->input->post('nm_barang', TRUE)),
            'kd_satuan' => strip_tags($this->input->post('kd_satuan', TRUE)),
            'kd_kategori' => strip_tags($this->input->post('kd_kategori', TRUE)),
            'hrg_jual' => strip_tags(str_replace(",", "", $this->input->post('hrg_jual', TRUE))),
            'hrg_beli' => strip_tags(str_replace(",", "", $this->input->post('hrg_beli', TRUE))),
            'deskripsi' => strip_tags($this->input->post('deskripsi', TRUE)),
            'stok' => strip_tags($this->input->post('stok', TRUE)),
            'diskon' => strip_tags($this->input->post('diskon', TRUE)),
            'tgl_masuk' => strip_tags($this->input->post('tgl_masuk', TRUE)),
            'dibeli' => strip_tags($this->input->post('dibeli', TRUE)),
            'ukuran' => strip_tags($this->input->post('ukuran', TRUE)),
        );


        $this->db->insert('tabel_barang', $data);
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
            'nm_barang' => strip_tags($this->input->post('nm_barang', TRUE)),
            'kd_satuan' => strip_tags($this->input->post('kd_satuan', TRUE)),
            'kd_barang' => strip_tags($this->input->post('kd_barang', TRUE)),
            'kd_kategori' => strip_tags($this->input->post('kd_kategori', TRUE)),
            'hrg_jual' => strip_tags($this->input->post('hrg_jual', TRUE)),
            'hrg_beli' => strip_tags($this->input->post('hrg_beli', TRUE)),
            'deskripsi' => strip_tags($this->input->post('deskripsi', TRUE)),
            'stok' => strip_tags($this->input->post('stok', TRUE)),
            'diskon' => strip_tags($this->input->post('diskon', TRUE)),
            'tgl_masuk' => strip_tags($this->input->post('tgl_masuk', TRUE)),
            'dibeli' => strip_tags($this->input->post('dibeli', TRUE)),
            'ukuran' => strip_tags($this->input->post('ukuran', TRUE)),
        );


        $this->db->where('id_barang', $id);
        $this->db->update('tabel_barang', $data);
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
        $this->db->where('id_barang', $id);
        $this->db->delete('tabel_barang');
    }

    // get tabel_satuan_barang
    public function get_tabel_satuan_barang() {

        $result = $this->db->get('tabel_satuan_barang')
                ->result();

        $ret [''] = 'Pilih Satuan Barang :';
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->nm_satuan] = $row->nm_satuan;
            }
        }

        return $ret;
    }

    // get tabel_kategori_barang
    public function get_tabel_kategori_barang() {

        $result = $this->db->get('tabel_kategori_barang')
                ->result();

        $ret [''] = 'Pilih Kategori Barang :';
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->nm_kategori] = $row->nm_kategori;
            }
        }

        return $ret;
    }

    public function cetakKasir($id_transaksi) {
        //$id = $this->input->get_post("no_faktur");
        //var_dump($no_faktur);
        $query = $this->db->query("select * from keluar_barang tp
                            inner join rinci_keluar trp on tp.kode_keluar= trp.kode_keluar
                            where tp.kode_keluar='$id_transaksi'");
        return $query;
    }

}
