<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller surat_retur
 * @created on : Wednesday, 06-May-2015 02:29:24
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */
class surat_retur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('terbilang_helper');
        $this->load->model('surat_returs');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    /**
     * List all data surat_retur
     *
     */
    public function index() {
        $config = array(
            'base_url' => site_url('surat_retur/index/'),
            'total_rows' => $this->surat_returs->count_all(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];

        $data['pagination'] = $this->pagination->create_links();
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['surat_retur'] = $this->surat_returs->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('surat_retur/view', $data);
    }

    /**
     * Call Form to Add  New surat_retur
     *
     */
    public function add() {
        $data['surat_retur'] = $this->surat_returs->add();
        $data['action'] = 'save';
        $data['no_urut'] = $this->surat_returs->no_urut();

        $this->template->display('surat_retur/form', $data);
    }

    public function caribarang() {


        $config = array(
            'base_url' => site_url('surat_retur/caribarang/'),
            'total_rows' => $this->surat_returs->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_barang'] = $this->surat_returs->get_search($config['per_page'], $this->uri->segment(3));

        $this->load->view('surat_retur/hasilCari', $data);
    }

    public function carisupplier() {


        $config = array(
            'base_url' => site_url('surat_retur/carisupplier/'),
            'total_rows' => $this->surat_returs->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_supplier'] = $this->surat_returs->get_searchSupplier($config['per_page'], $this->uri->segment(3));

        $this->load->view('surat_retur/hasilSupplier', $data);
    }

    public function search_barang()
    {
        if($this->input->post('q'))
        {
            $keyword = $this->input->post('q');
            
            $this->session->set_userdata(
                        array('keyword' => $this->input->post('q',TRUE))
                    );
        }
        
         $config = array(
            'base_url'          => site_url('surat_retur/search_barang/'),
            'total_rows'        => $this->surat_returs->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['surat_retur']       = $this->surat_returs->get_search_barang($config['per_page'], $this->uri->segment(3));
       
        $this->template->display('surat_retur/view',$data);
    }
    
    
    public function lihat() {
        $id = $this->input->get_post('id');
        //var_dump($id);
        $data['lihat'] = $this->surat_returs->lihat()->result_array();
        $data['supplier'] = $this->db->query("select * from surat_retur where no_surat_peminjaman = '$id' ")->row_array();
        //var_dump($data['supplier']);
        $this->load->view('surat_retur/_show', $data);
    }

    public function retur() {
        $id = $this->input->get_post('id');
        //var_dump($id);
        $data['lihat'] = $this->surat_returs->lihat()->result_array();
        $data['supplier'] = $this->db->query("select * from surat_retur where kode_surat_retur = '$id' ")->row_array();
        //var_dump($data['supplier']);
        echo json_encode($data);
        $this->load->view('surat_retur/buatRetur', $data);
    }

    public function destroy($id) {
        if ($id) {
            $this->surat_returs->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('surat_retur');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('surat_retur');
        }
    }

    public function daftarSupplier() {
        $data['data_supplier'] = $this->surat_returs->getSupplier();
        $this->load->view('surat_retur/supplier', $data);
    }

    public function daftarBarang() {
        $data['data_barang'] = $this->surat_returs->getBarang();
        $this->load->view('surat_retur/barang', $data);
    }

    public function tambahBarang() {
        $this->surat_returs->tambahBarang();
    }

    public function tampilBarang() {
        $no_faktur = $this->input->post('no_faktur');
        $data['tampilBarang'] = $this->db->get_where('rinci_surat_retur', array('no_surat_retur' => $no_faktur))->result_array();
        $this->load->view('surat_retur/tampilBarang', $data);
    }

    public function hapusBarang() {
        $id = $this->input->post("id");
        $this->db->where("kd_barang", $id);
        $this->db->delete("rinci_surat_retur");
        //$data['tampilBarang'] = $this->db->get('rinci_surat_retur')->result_array();
        //$this->load->view('surat_retur/tampilBarang', $data);
    }

    public function saveBarang() {
        $this->surat_returs->save();
    }

    public function cetakFaktur($no_faktur) {
        $data['faktur'] = $this->surat_returs->cetakFaktur($no_faktur)->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $data['supplier'] = $data['supplier'] = $this->db->query("select * from surat_retur where no_surat_peminjaman='$no_faktur'")->row();
        $this->load->view('surat_retur/cetakFaktur', $data);
    }

    public function search() {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);
        // cari di database
        $data = $this->db->query("select * from tabel_pelanggan where nama_pelanggan like '%$keyword%' ");

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->nama_pelanggan,
                'alamat' => $row->alamat,
                'telp' => $row->telp
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

}

?>
