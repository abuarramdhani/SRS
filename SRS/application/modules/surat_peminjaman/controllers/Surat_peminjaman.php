<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller surat_peminjaman
 * @created on : Wednesday, 06-May-2015 02:29:24
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */
class surat_peminjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('terbilang_helper');
        $this->load->model('surat_peminjamans');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    public function search_barang() {
        if ($this->input->post('q')) {
            $keyword = $this->input->post('q');

            $this->session->set_userdata(
                    array('keyword' => $this->input->post('q', TRUE))
            );
        }

        $config = array(
            'base_url' => site_url('surat_peminjaman/search_barang/'),
            'total_rows' => $this->surat_peminjamans->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['surat_peminjaman'] = $this->surat_peminjamans->get_search_barang($config['per_page'], $this->uri->segment(3));

        $this->template->display('surat_peminjaman/view', $data);
    }

    /**
     * List all data surat_peminjaman
     *
     */
    public function index() {
        $config = array(
            'base_url' => site_url('surat_peminjaman/index/'),
            'total_rows' => $this->surat_peminjamans->count_all(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['no_urut'] = $this->surat_peminjamans->no_urut();
        $data['pagination'] = $this->pagination->create_links();
        $data['number'] = (int) $this->uri->segment(3) + 1;

        $data['surat_peminjaman'] = $this->surat_peminjamans->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('surat_peminjaman/view', $data);
    }

    /**
     * Call Form to Add  New surat_peminjaman
     *
     */
    public function add() {
        $data['surat_peminjaman'] = $this->surat_peminjamans->add();
        $data['action'] = 'save';
        $data['no_urut'] = $this->surat_peminjamans->no_urut();

        $this->template->display('surat_peminjaman/form', $data);
    }

    public function caribarang() {


        $config = array(
            'base_url' => site_url('surat_peminjaman/caribarang/'),
            'total_rows' => $this->surat_peminjamans->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);

        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_barang'] = $this->surat_peminjamans->get_search($config['per_page'], $this->uri->segment(3));
        $data_barang = $this->surat_peminjamans->get_search($config['per_page'], $this->uri->segment(3));
        $pagination = $this->pagination->create_links();
        //var_dump($pagination);

        $this->load->view('surat_peminjaman/hasilCari', $data);
    }

    /**
     * Delete surat_peminjaman by ID
     *
     */
    public function lihat() {
        $id = $this->input->get_post('id');
        //var_dump($id);
        $data['lihat'] = $this->surat_peminjamans->lihat()->result_array();
        $data['supplier'] = $this->db->query("select * from surat_peminjaman where kode_surat_peminjaman = '$id' ")->row_array();
        //var_dump($data['supplier']);
        $this->load->view('surat_peminjaman/_show', $data);
    }

    public function retur() {
        $id = $this->input->get_post('id');
        //var_dump($id);
        $data['lihat'] = $this->surat_peminjamans->lihat()->result_array();
        //$data['total_rows'] = $this->db->query("select kode_surat_peminjaman  select * from surat_peminjaman where kode_surat_peminjaman = '$id' ");
        $data['supplier'] = $this->db->query("select * from surat_peminjaman where kode_surat_peminjaman = '$id' ")->row_array();
        //var_dump($data['supplier']);
        //echo json_encode($data);
        $this->load->view('surat_peminjaman/buatRetur', $data);
    }

    public function destroy($id) {
        if ($id) {
            $this->surat_peminjamans->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('surat_peminjaman');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('surat_peminjaman');
        }
    }

    public function daftarSupplier() {
        $data['data_supplier'] = $this->surat_peminjamans->getSupplier();
        $this->load->view('surat_peminjaman/supplier', $data);
    }

    public function daftarBarang() {
        $data['data_barang'] = $this->surat_peminjamans->getBarang();
        $this->load->view('surat_peminjaman/barang', $data);
    }

    public function tambahBarang() {
        $this->surat_peminjamans->tambahBarang();
    }

    public function tampilBarang() {
        $no_faktur = $this->input->post('no_faktur');
        $data['tampilBarang'] = $this->db->get_where('rinci_surat_peminjaman', array('no_surat_peminjaman' => $no_faktur))->result_array();
        $this->load->view('surat_peminjaman/tampilBarang', $data);
    }

    public function hapusBarang() {
        $id = $this->input->post("id");
        $this->db->where("kd_barang", $id);
        $this->db->delete("rinci_surat_peminjaman");
        //$data['tampilBarang'] = $this->db->get('rinci_surat_peminjaman')->result_array();
        //$this->load->view('surat_peminjaman/tampilBarang', $data);
    }

    public function saveBarang() {
        $this->surat_peminjamans->save();
    }

    public function cetakFaktur($no_faktur) {
        $data['faktur'] = $this->surat_peminjamans->cetakFaktur($no_faktur)->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $data['supplier'] = $this->db->query("select * from surat_peminjaman where kode_surat_peminjaman='$no_faktur'")->row();
        $this->load->view('surat_peminjaman/cetakFaktur', $data);
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
        echo json_encode($arr);
    }

    function buatRetur() {
        $total_baris = $this->input->post('total_baris', TRUE);
        //$kode_surat_peminjaman = $this->input->post('kode_surat_peminjaman', TRUE);
        //var_dump($total_baris);

        for ($baris = 1; $baris <= $total_baris; $baris++) {
            //$pk_part_dtl_retur_beli = $this->input->post('pk_part_dtl_retur_beli' . $baris, TRUE);

            $data = array(
                'kode_surat' => $this->input->post("kode_surat" . $baris, TRUE),
                'kd_barang' => $this->input->post("kd_barang" . $baris, TRUE),
                'nm_barang' => $this->input->post("nm_barang" . $baris, TRUE),
                'satuan' => $this->input->post("satuan" . $baris, TRUE),
                'ukuran' => $this->input->post("ukuran" . $baris, TRUE),
                'jumlah' => $this->input->post("total" . $baris, TRUE),
                // $jumlah = $this->input->post("jumlah", TRUE),
                'no_surat_peminjaman' => $this->input->post("kode_surat_peminjaman" . $baris, TRUE),
            );
            $this->db->insert("rinci_surat_retur", $data);
            echo "berhasil";

            $dataPj = array(
                'kd_barang' => $this->input->post("kd_barang" . $baris, TRUE),
                'nm_barang' => $this->input->post("nm_barang" . $baris, TRUE),
                'satuan' => $this->input->post("satuan" . $baris, TRUE),
                'ukuran' => $this->input->post("ukuran" . $baris, TRUE),
                'jumlah' => $this->input->post("sisa_qty" . $baris, TRUE),
                // $jumlah = $this->input->post("jumlah", TRUE),
                'harga' => $this->input->post("harga" . $baris, TRUE),
                'sub_total_jual' => $this->input->post("total_jual" . $baris, TRue),
                'no_surat_peminjaman' => $this->input->post("kode_surat_peminjaman" . $baris, TRUE),
            );
            $this->db->insert("tabel_rinci_penjualan", $dataPj);
            echo "Sukses masuk ke invoice";
        }


        $dataMsPj = array(
            'no_surat_peminjaman' => $this->input->post("kode_surat_peminjaman_ms", TRUE),
            'id_user' => $this->session->userdata("username"),
            'total_penjualan' => $this->input->post("total_seluruh", true),
            'tgl_penjualan' => $this->input->post("tgl_peminjaman"),
            'nm_pelanggan' => $this->input->post("nama_pelanggan"),
            'alamat' => $this->input->post("alamat"),
            'telp' => $this->input->post("telp")
        );
        $this->db->insert("tabel_penjualan", $dataMsPj);
        echo "Berhasil Master";

        $dataMs = array(
            'no_surat_peminjaman' => $this->input->post("kode_surat_peminjaman_ms", TRUE),
            'id_user' => $this->session->userdata("username"),
            'total_retur' => $this->input->post("jumlah", true),
            'tgl_retur' => $this->input->post("tgl_peminjaman"),
            'kode_surat' => $this->input->post("kode_surat_ms"),
            'nama_pelanggan' => $this->input->post("nama_pelanggan"),
            'alamat' => $this->input->post("alamat"),
            'telp' => $this->input->post("telp")
        );
        $this->db->insert("surat_retur", $dataMs);
        echo "Berhasil Master";

        $this->db->update("surat_peminjaman", array("status_retur" => "1"), array("kode_surat_peminjaman" => $this->input->post("kode_surat_peminjaman_ms", TRUE)));
    }

    public function cetakRetur($no_peminjaman) {
        $data['faktur'] = $this->surat_peminjamans->cetakRetur($no_peminjaman)->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $data['detail'] = $query = $this->db->query("SELECT * FROM surat_retur sr
                            INNER JOIN rinci_surat_retur rsr ON sr.no_surat_peminjaman = rsr.no_surat_peminjaman 
                            WHERE sr.no_surat_peminjaman='$no_peminjaman'")->row();
        $this->load->view('surat_peminjaman/cetakRetur', $data);
    }

    public function cetakInvoice($no_peminjaman) {
        //var_dump($no_peminjaman);
        $data['faktur'] = $this->surat_peminjamans->cetakInvoice($no_peminjaman)->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $data['detail'] = $query = $this->db->query("SELECT * FROM tabel_penjualan sr
                            INNER JOIN tabel_rinci_penjualan rsr ON sr.no_surat_peminjaman = rsr.no_surat_peminjaman 
                            WHERE sr.no_surat_peminjaman='$no_peminjaman'")->row();
        //var_dump($data['detail']);
        //var_dump($data['faktur']);

        $this->load->view('surat_peminjaman/cetakInvoice', $data);
    }

    public function getPelanggan() {
        $data["tes"] = "tes";
        $this->load->view("surat_peminjaman/getPelanggan", $data);
    }

    public function cek_invoice() {
        $no_faktur_penjualan = $this->input->post("no_faktur_penjualan");
        //var_dump($kode_surat);
        $data = $this->db->query("select * from surat_peminjaman where kode_surat = '$no_faktur_penjualan' ");
        $d = $data->num_rows();

        //var_dump($d);
        if ($data->num_rows() > 0 || $no_faktur_penjualan == "") {
            echo 1;
        } else {
            echo 0;
        }
    }

}

?>
