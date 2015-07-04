<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller tabel_pembelian
 * @created on : Wednesday, 06-May-2015 02:29:24
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */
class tabel_pembelian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('terbilang_helper');
        $this->load->model('tabel_pembelians');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    /**
     * List all data tabel_pembelian
     *
     */
    public function index() {
        $config = array(
            'base_url' => site_url('tabel_pembelian/index/'),
            'total_rows' => $this->tabel_pembelians->count_all(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['no_urut'] = $this->tabel_pembelians->no_urut();
        $data['pagination'] = $this->pagination->create_links();
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['tabel_pembelians'] = $this->tabel_pembelians->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('tabel_pembelian/view', $data);
    }

    /**
     * Call Form to Add  New tabel_pembelian
     *
     */
    public function add() {
        $data['tabel_pembelian'] = $this->tabel_pembelians->add();
        $data['action'] = 'save';
        $data['no_urut'] = $this->tabel_pembelians->no_urut();

        $this->template->display('tabel_pembelian/form', $data);
    }

    public function caribarang() {


        $config = array(
            'base_url' => site_url('tabel_pembelian/caribarang/'),
            'total_rows' => $this->tabel_pembelians->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_barang'] = $this->tabel_pembelians->get_search($config['per_page'], $this->uri->segment(3));

        $this->load->view('tabel_pembelian/hasilCari', $data);
    }

    public function carisupplier() {


        $config = array(
            'base_url' => site_url('tabel_pembelian/carisupplier/'),
            'total_rows' => $this->tabel_pembelians->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_supplier'] = $this->tabel_pembelians->get_searchSupplier($config['per_page'], $this->uri->segment(3));

        $this->load->view('tabel_pembelian/hasilSupplier', $data);
    }

    /**
     * Delete tabel_pembelian by ID
     *
     */
    public function lihat() {
        $data['lihat'] = $this->tabel_pembelians->lihat()->result_array();
        $data['supplier'] = $this->tabel_pembelians->lihat()->row_array();
        $this->load->view('tabel_pembelian/_show', $data);
    }

    public function destroy($id) {
        if ($id) {
            $this->tabel_pembelians->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('tabel_pembelian');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('tabel_pembelian');
        }
    }

    public function daftarSupplier() {
        $data['data_supplier'] = $this->tabel_pembelians->getSupplier();
        $this->load->view('tabel_pembelian/supplier', $data);
    }

    public function daftarBarang() {
        $data['data_barang'] = $this->tabel_pembelians->getBarang();
        $this->load->view('tabel_pembelian/barang', $data);
    }

    public function tambahBarang() {
        $this->tabel_pembelians->tambahBarang();
    }

    public function tampilBarang() {
        $no_faktur = $this->input->post('no_faktur');
        $data['tampilBarang'] = $this->db->get_where('tabel_rinci_pembelian', array('no_faktur_pembelian' => $no_faktur))->result_array();
        $this->load->view('tabel_pembelian/tampilBarang', $data);
    }

    public function hapusBarang() {
        $id = $this->input->post("id");
        $this->db->where("kd_barang", $id);
        $this->db->delete("tabel_rinci_pembelian");
        //$data['tampilBarang'] = $this->db->get('tabel_rinci_pembelian')->result_array();
        //$this->load->view('tabel_pembelian/tampilBarang', $data);
    }

    public function saveBarang() {
        $this->tabel_pembelians->save();
    }

    public function cetakFaktur($no_faktur) {
        $data['faktur'] = $this->tabel_pembelians->cetakFaktur($no_faktur)->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $data['supplier'] = $this->tabel_pembelians->cetakFaktur($no_faktur)->row();
        $this->load->view('tabel_pembelian/cetakFaktur', $data);
    }

}

?>
