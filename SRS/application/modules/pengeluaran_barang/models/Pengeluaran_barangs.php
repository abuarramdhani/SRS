<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pengeluaran_barangs extends CI_Model {

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
        $sql = $this->db->query("select * from keluar_barang kb 
                inner join rinci_keluar rk on kb.kode_keluar=rk.kode_keluar");

        return $sql;
    }

    public function count_all_search() {
        /*
          $keyword = $this->session->userdata('keyword');
          $this->db->from('surat_peminjaman');

          $this->db->or_like('kode_surat_peminjaman', $keyword);

          $this->db->or_like('id_user', $keyword);
          $this->db->or_like('kode_surat', $keyword);

          return $this->db->count_all_results();
         * 
         */
        $this->db->from('tabel_barang');
        return $this->db->count_all_results();
    }

    /**
     *  Count All tabel_barang
     *    
     *  @return Integer
     *
     */
    public function kode_barang() {
        $q = $this->db->query("select MAX(RIGHT(kode_keluar,4)) as kd_max from keluar_barang");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return "KR" . $kd;
    }

    public function count_all() {

        $sql = $this->db->query("select * from keluar_barang kb 
                inner join rinci_keluar rk on kb.kode_keluar=rk.kode_keluar")->num_rows();

        return $sql;
        /*
        $this->db->from('tabel_barang');
        return $this->db->count_all_results();
         * 
         */
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

        $this->db->like('stok', $keyword);

        $this->db->or_like('kd_barang', $keyword);

        $this->db->or_like('nm_barang', $keyword);

        $this->db->or_like('kd_satuan', $keyword);

        $this->db->or_like('kd_kategori', $keyword);
        $this->db->or_like('ukuran', $keyword);

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
    /**
     *  Save data Post
     *
     *  @return void
     *
     */

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

    public function tambahPengeluaran() {
        $data = array(
            'kode_keluar' => $this->input->post("kode_keluar"),
            //'tipe_keluar' => $this->input->post("tipe_keluar"),
            'kd_barang' => $this->input->post("kd_barang"),
            'nm_barang' => $this->input->post("nm_barang"),
            'satuan' => $this->input->post("satuan"),
            'ukuran' => $this->input->post("ukuran"),
            'kategori' => $this->input->post("kategori"),
            'jumlah' => $this->input->post("jumlah"),
            'total' => $this->input->post("total"),
            'harga' => $this->input->post("harga"),
        );
        $this->db->insert("rinci_keluar", $data);
    }

    public function tampilKeluar() {
        $kode_keluar = $this->input->post("kode_keluar");
        $query = $this->db->query("select * from rinci_keluar where kode_keluar = '$kode_keluar'");
        return $query;
    }

    public function cetakKeluar($kode_keluar) {
        $query = $this->db->query("select * from keluar_barang tp
                            inner join rinci_keluar trp on tp.kode_keluar = trp.kode_keluar
                            where tp.kode_keluar='$kode_keluar'");
        return $query;
    }

}
