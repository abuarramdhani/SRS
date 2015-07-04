<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller surat_jalan
 * @created on : Wednesday, 06-May-2015 02:29:24
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */
class surat_jalan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('terbilang_helper');
        $this->load->model('surat_jalans');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    /**
     * List all data surat_jalan
     *
     */
    public function index() {
        $config = array(
            'base_url' => site_url('surat_jalan/index/'),
            'total_rows' => $this->surat_jalans->count_all(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['no_urut'] = $this->surat_jalans->no_urut();
        $data['pagination'] = $this->pagination->create_links();
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['surat_jalan'] = $this->surat_jalans->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('surat_jalan/view', $data);
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
            'base_url'          => site_url('surat_jalan/search_barang/'),
            'total_rows'        => $this->surat_jalans->count_all_barang(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['surat_jalan']       = $this->surat_jalans->get_search_barang($config['per_page'], $this->uri->segment(3));
       
        $this->template->display('surat_jalan/view',$data);
    }
    

    /**
     * Call Form to Add  New surat_jalan
     *
     */
    public function add() {
        $data['surat_jalan'] = $this->surat_jalans->add();
        $data['action'] = 'save';
        $data['no_urut'] = $this->surat_jalans->no_urut();

        $this->template->display('surat_jalan/form', $data);
    }

    public function caribarang() {


        $config = array(
            'base_url' => site_url('surat_jalan/caribarang/'),
            'total_rows' => $this->surat_jalans->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_barang'] = $this->surat_jalans->get_search($config['per_page'], $this->uri->segment(3));

        $this->load->view('surat_jalan/hasilCari', $data);
    }

    public function carisupplier() {


        $config = array(
            'base_url' => site_url('surat_jalan/carisupplier/'),
            'total_rows' => $this->surat_jalans->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_supplier'] = $this->surat_jalans->get_searchSupplier($config['per_page'], $this->uri->segment(3));

        $this->load->view('surat_jalan/hasilSupplier', $data);
    }

    /**
     * Delete surat_jalan by ID
     *
     */
    public function lihat() {
        $data['lihat'] = $this->surat_jalans->lihat()->result_array();
        $data['supplier'] = $this->surat_jalans->lihat()->row_array();
        $this->load->view('surat_jalan/_show', $data);
    }

    public function destroy($id) {
        if ($id) {
            $this->surat_jalans->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('surat_jalan');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('surat_jalan');
        }
    }

    public function daftarSupplier() {
        $data['data_supplier'] = $this->surat_jalans->getSupplier();
        $this->load->view('surat_jalan/supplier', $data);
    }

    public function daftarBarang() {
        $data['data_barang'] = $this->surat_jalans->getBarang();
        $this->load->view('surat_jalan/barang', $data);
    }

    public function tambahBarang() {
        $this->surat_jalans->tambahBarang();
    }

    public function tampilBarang() {
        $no_faktur = $this->input->post('no_faktur');
        $data['tampilBarang'] = $this->db->get_where('rinci_surat_jalan', array('no_surat_jalan' => $no_faktur))->result_array();
        $this->load->view('surat_jalan/tampilBarang', $data);
    }

    public function hapusBarang() {
        $id = $this->input->post("id");
        $this->db->where("kd_barang", $id);
        $this->db->delete("rinci_surat_jalan");
        //$data['tampilBarang'] = $this->db->get('rinci_surat_jalan')->result_array();
        //$this->load->view('surat_jalan/tampilBarang', $data);
    }

    public function saveBarang() {
        $this->surat_jalans->save();
    }

    public function cetakFaktur($no_faktur) {
        $data['faktur'] = $this->surat_jalans->cetakFaktur($no_faktur)->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $data['supplier'] = $this->db->query("select * from surat_jalan where kode_surat_jalan='$no_faktur'")->row();
        $this->load->view('surat_jalan/cetakFaktur', $data);
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
    
    
    public function searchBarang() {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);
        // cari di database
        $data = $this->db->query("select * from tabel_barang where nm_barang like '%$keyword%' ");

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->nm_barang.' - '.$row->ukuran,
                'kd_satuan' => $row->kd_satuan,
                'hrg_jual' => $row->hrg_jual,
                'kd_barang' => $row->kd_barang,
                'nm_barang' => $row->nm_barang,
                'ukuran' => $row->ukuran,
                'stok' => $row->stok,
                
                
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

	
	public function cek_invoice() {
        $kode_surat = $this->input->post("no_invoice");
        //var_dump($kode_surat);
        $data = $this->db->query("select * from surat_jalan where kode_surat = '$kode_surat' ");
        if ($data->num_rows() > 0 || $kode_surat == '') {
            echo 0;
        } else {
            echo 1;
        }
    }

}

?>
