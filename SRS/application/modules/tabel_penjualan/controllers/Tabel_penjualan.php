<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller tabel_penjualan
 * @created on : Wednesday, 06-May-2015 02:29:24
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */
class tabel_penjualan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('terbilang_helper');
        $this->load->model('tabel_penjualans');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    /**
     * List all data tabel_penjualan
     *
     */
    public function index() {
        $config = array(
            'base_url' => site_url('tabel_penjualan/index/'),
            'total_rows' => $this->tabel_penjualans->count_all(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['no_urut'] = $this->tabel_penjualans->no_urut();
        $data['pagination'] = $this->pagination->create_links();
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['tabel_penjualan'] = $this->tabel_penjualans->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('tabel_penjualan/view', $data);
    }

    /**
     * Call Form to Add  New tabel_penjualan
     *
     */
    public function add() {
        $data['tabel_penjualan'] = $this->tabel_penjualans->add();
        $data['action'] = 'save';
        $data['no_urut'] = $this->tabel_penjualans->no_urut();

        $this->template->display('tabel_penjualan/form', $data);
    }

    public function caribarang() {


        $config = array(
            'base_url' => site_url('tabel_penjualan/caribarang/'),
            'total_rows' => $this->tabel_penjualans->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_barang'] = $this->tabel_penjualans->get_search($config['per_page'], $this->uri->segment(3));

        $this->load->view('tabel_penjualan/hasilCari', $data);
    }

    public function carisupplier() {


        $config = array(
            'base_url' => site_url('tabel_penjualan/carisupplier/'),
            'total_rows' => $this->tabel_penjualans->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_supplier'] = $this->tabel_penjualans->get_searchSupplier($config['per_page'], $this->uri->segment(3));

        $this->load->view('tabel_penjualan/hasilSupplier', $data);
    }

    /**
     * Delete tabel_penjualan by ID
     *
     */
    public function lihat() {
        $data['lihat'] = $this->tabel_penjualans->lihat()->result_array();
        $data['supplier'] = $this->tabel_penjualans->lihat()->row_array();
        $this->load->view('tabel_penjualan/_show', $data);
    }

    public function destroy($id) {
        if ($id) {
            $this->tabel_penjualans->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('tabel_penjualan');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('tabel_penjualan');
        }
    }

    public function daftarSupplier() {
        $data['data_supplier'] = $this->tabel_penjualans->getSupplier();
        $this->load->view('tabel_penjualan/supplier', $data);
    }

    public function daftarBarang() {
        $data['no_urut'] = $this->tabel_penjualans->no_urut();
        $data['data_barang'] = $this->tabel_penjualans->getBarang();
        $this->load->view('tabel_penjualan/barang', $data);
    }

    public function tambahBarang() {
        $this->tabel_penjualans->tambahBarang();
    }

    public function tampilBarang() {
        $no_faktur = $this->input->post('no_faktur');
        $data['tampilBarang'] = $this->db->get_where('tabel_rinci_penjualan', array('no_faktur_penjualan' => $no_faktur))->result_array();
        $this->load->view('tabel_penjualan/tampilBarang', $data);
    }

    public function hapusBarang() {
        $id = $this->input->post("id");
        $this->db->where("kd_barang", $id);
        $this->db->delete("tabel_rinci_penjualan");
        //$data['tampilBarang'] = $this->db->get('tabel_rinci_penjualan')->result_array();
        //$this->load->view('tabel_penjualan/tampilBarang', $data);
    }

    public function saveBarang() {
        $this->tabel_penjualans->save();
    }

    public function cetakFaktur($no_faktur) {
        $data['faktur'] = $this->tabel_penjualans->cetakFaktur($no_faktur)->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $data['supplier'] = $this->tabel_penjualans->cetakFaktur($no_faktur)->row();
        $this->load->view('tabel_penjualan/cetakFaktur', $data);
    }

    public function inputTemp() {
        $this->tabel_penjualans->inputTemp();
    }

    public function getPelanggan() {
        $data['title'] = "tes";
        $this->load->view('tabel_penjualan/getPelanggan', $data);
    }

    public function tambahPelanggan() {
        $data = array(
            'nama_pelanggan' => $this->input->post("nama_pelanggan"),
            'alamat' => $this->input->post("alamat"),
            'telp' => $this->input->post("telp"),
            'hp' => $this->input->post("hp"),
            'email' => $this->input->post("email"),
        );

        $this->db->insert("tabel_pelanggan", $data);
    }

    public function cek_invoice() {
        $kode_surat = $this->input->post("no_invoice");
        //var_dump($kode_surat);
        $data = $this->db->query("select * from tabel_penjualan where kode_surat = '$kode_surat' ");
        if ($data->num_rows() > 0 || $kode_surat == '') {
            echo 0;
        } else {
            echo 1;
        }
    }

}

?>
