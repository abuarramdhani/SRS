<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('kasirs');
        $this->load->library("cart");

        $this->load->helper('terbilang_helper');

        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    public function index() {
        $data['no_urut'] = $this->kasirs->no_urut();
        $data['produk'] = $this->db->query("select * from tabel_barang ");
        $this->template->display('kasir/form', $data);
    }

    public function add() {

        $kode_barang = $this->input->get_post('kode_barang');
        $nama_barang = $this->input->get_post('nama_barang_1');

        if ($kode_barang == "" && $nama_barang != "") {
            $product = $this->db->query("select * from tabel_barang where nm_barang='$nama_barang'")->row();
            $data = array(
                'id' => $product->ukuran,
                'qty' => 1,
                'price' => $product->hrg_jual,
                'name' => $product->nm_barang,
            );
            $this->cart->insert($data);
        } else if ($kode_barang != "" && $nama_barang == "") {
            $product = $this->db->query("select * from tabel_barang where kd_barang='$kode_barang'")->row();
            if ($product->stok == 0) {
                $this->session->set_flashdata('item', 'Maaf Stok Untuk Barang Ini Habis');
                $data = array(
                    'id' => "$this->session->set_flashdata('item', 'Maaf Stok Untuk Barang Ini Habis')",
                    'qty' => 1,
                    'price' => $product->hrg_jual,
                    'name' => $product->nm_barang,
                    'ukuran' => $product->ukuran,
                );
                $this->cart->insert($data);
            } else {
                $data = array(
                    'id' => $product->kd_barang,
                    'qty' => 1,
                    'price' => $product->hrg_jual,
                    'name' => $product->nm_barang,
                    'ukuran' => $product->ukuran,
                );
                $this->cart->insert($data);
            }
        }



//var_dump($product->nm_barang);
        redirect("kasir");
    }

    public function hapus_keranjang($kode) {
        $id = '';
        if ($this->uri->segment(3) === FALSE) {
            $id = '';
        } else {
            $id = $this->uri->segment(3);
        }
        $data = array(
            'rowid' => $kode,
            'qty' => 0);
        $this->cart->update($data);
        redirect("kasir");
    }

    function update_keranjang() {


        $total = $this->cart->total_items();
        $item = $this->input->get_post('rowid');
        $qty = $this->input->get_post('qty');

        for ($i = 0; $i < $total; $i++) {
            $data = array(
                'rowid' => $item[$i],
                'qty' => $qty[$i]
            );

            $this->cart->update($data);
        }
        redirect('kasir');


        //$this->cart->update($_POST);
        //redirect("kasir");
    }

    /**
     * Call Form to Add  New kasir
     *
     */
    public function searchBarang() {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);
        // cari di database
        $data = $this->db->query("select * from tabel_barang where nm_barang like '%$keyword%' ");



        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            if ($row->stok == 0) {
                $stok = "Kosong";
            } else {
                $stok = $row->stok;
            }

            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->nm_barang . ' - ' . $row->ukuran,
                'kd_satuan' => $row->kd_satuan,
                'hrg_jual' => $row->hrg_jual,
                'kd_barang' => $row->kd_barang,
                'ukuran' => $row->ukuran,
                'stok' => $stok,
                'nm_barang' => $row->nm_barang,
            );
        }
        // minimal PHP 5.2
        echo

        json_encode($arr);
    }

    function simpanKasir() {

        $kode = $this->input->get_post("id_transaksi");
        $total = $this->cart->total();
$kembalian =  $this->input->get_post("kembalian");
			$total_pembayaran =  $this->input->get_post("total_pembayaran");
        $data = array(
            'kode_keluar' => $this->input->get_post("id_transaksi"),
            'tgl_keluar' => $this->input->get_post("tgl_penjualan"),
			'pembayaran'=>$total_pembayaran,
			'kembalian'=>$kembalian,
        );
        $this->db->insert("keluar_barang", $data);

        foreach ($this->cart->contents() as $items) {
            $this->db->query("insert into rinci_keluar
							(kode_keluar,kd_barang,nm_barang,harga,jumlah,total) 
							values('" . $kode . "','" . $items['id'] . "',
							'" . $items['name'] . "','" . $items['price'] . "','" . $items['qty'] . "','" . $items['subtotal'] . "')");
        }
        $this->cart->destroy();
    }

    public function cetakKasir($id_transaksi) {
        $data['faktur'] = $this->kasirs->cetakKasir($id_transaksi)->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $data['detail'] = $this->db->query("select * from keluar_barang where kode_keluar='$id_transaksi'")->row();
        $this->load->view('kasir/cetakKasir', $data);
    }

}

?>
