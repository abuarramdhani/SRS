<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pengeluaran_barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pengeluaran_barangs');

        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    /**
     * List all data pengeluaran_barang
     *
     */
    public function upload() {
        
    }

    public function index() {
        $config = array(
            'base_url' => site_url('pengeluaran_barang/index/'),
            'total_rows' => $this->pengeluaran_barangs->count_all(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pengeluaran_barang'] = $this->pengeluaran_barangs->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('pengeluaran_barang/view', $data);
    }

    /**
     * Call Form to Add  New pengeluaran_barang
     *
     */
    public function add() {

        $data['kode_barang'] = $this->pengeluaran_barangs->kode_barang();
        $data['action'] = 'save';
        $this->template->display('pengeluaran_barang/form', $data);
    }

    /**
     * Call Form to Modify pengeluaran_barang
     *
     */
    public function edit($id = '') {
        if ($id != '') {

            $data['pengeluaran_barang'] = $this->pengeluaran_barangs->get_one($id);
            $data['action'] = 'save/' . $id;
            $data['kode_barang'] = $this->pengeluaran_barangs->kode_barang();
            $data['tabel_satuan_barang'] = $this->pengeluaran_barangs->get_tabel_satuan_barang();
            $data['tabel_kategori_barang'] = $this->pengeluaran_barangs->get_tabel_kategori_barang();

            $this->template->display('pengeluaran_barang/form', $data);
        } else {
            $this->session->set_flashdata('notif', 'Data tidak ditemukan');
            redirect(site_url('pengeluaran_barang'));
        }
    }

    /**
     * Save & Update data  pengeluaran_barang
     *
     */
    public function save($id = NULL) {
        // validation config
        $config = array(
            array(
                'field' => 'kd_barang',
                'label' => 'Kode Barang',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'nm_barang',
                'label' => 'Nm Barang',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'kd_satuan',
                'label' => 'Kd Satuan',
                'rules' => 'trim'
            ),
            array(
                'field' => 'kd_kategori',
                'label' => 'Kd Kategori',
                'rules' => 'trim'
            ),
            array(
                'field' => 'hrg_jual',
                'label' => 'Hrg Jual',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'hrg_beli',
                'label' => 'Hrg Beli',
                'rules' => 'trim'
            ),
            array(
                'field' => 'ukuran',
                'label' => 'Ukuran',
                'rules' => 'trim'
            ),
        );

        // if id NULL then add new data
        if (!$id) {
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == TRUE) {
                if ($this->input->post()) {

                    $this->pengeluaran_barangs->save();
                    $this->session->set_flashdata('notif', 'Data berhasil di simpan');
                    redirect('pengeluaran_barang');
                }
            } else { // If validation incorrect 
                $this->add();
            }
        } else { // Update data if Form Edit send Post and ID available
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == TRUE) {
                if ($this->input->post()) {
                    $this->pengeluaran_barangs->update($id);
                    $this->session->set_flashdata('notif', 'Data berhasil di update');
                    redirect('pengeluaran_barang');
                }
            } else { // If validation incorrect 
                $this->edit($id);
            }
        }
    }

    /**
     * Search pengeluaran_barang like ""
     *
     */
    public function search() {
        if ($this->input->post('q')) {
            $keyword = $this->input->post('q');

            $this->session->set_userdata(
                    array('keyword' => $this->input->post('q', TRUE))
            );
        }

        $config = array(
            'base_url' => site_url('pengeluaran_barang/search/'),
            'total_rows' => $this->pengeluaran_barangs->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['sum'] = $this->db->query("select sum(stok) as stok from tabel_barang")->row();

        $data['pengeluaran_barang'] = $this->pengeluaran_barangs->get_search($config['per_page'], $this->uri->segment(3));

        //var_dump($this->input->post('q'));

        $this->template->display('pengeluaran_barang/view', $data);
    }

    /**
     * Delete pengeluaran_barang by ID
     *
     */
    public function destroy($id) {
        if ($id) {
            $this->pengeluaran_barangs->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('pengeluaran_barang');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('pengeluaran_barang');
        }
    }

    public function tambahPengeluaran() {

        $this->pengeluaran_barangs->tambahPengeluaran();
    }

    public function tampilKeluar() {
        $data['keluar'] = $this->pengeluaran_barangs->tampilKeluar()->result_array();
        $this->load->view("pengeluaran_barang/tampilBarang", $data);
    }

    public function hapusBarang() {
        $kode_keluar = $this->input->post("kode_keluar");
        $this->db->where("id_keluar", $kode_keluar);
        $this->db->delete("rinci_keluar");
    }

    public function caribarang() {
        $config = array(
            'base_url' => site_url('surat_peminjaman/caribarang/'),
            'total_rows' => $this->pengeluaran_barangs->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );
        $this->pagination->initialize($config);
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['data_barang'] = $this->pengeluaran_barangs->get_search($config['per_page'], $this->uri->segment(3));
        $data_barang = $this->pengeluaran_barangs->get_search($config['per_page'], $this->uri->segment(3));
        $pagination = $this->pagination->create_links();
        //var_dump($pagination);
        $this->load->view('pengeluaran_barang/hasilCari', $data);
    }

    function add_cart() {
        $kd_barang = $this->input->post("kd_barang");
        //$this->db->query("select * from tabel_barang where kd_barang = '$kd_barang'");
        $nm_barang = $this->input->post("nm_barang");
        $satuan = $this->input->post("satuan");
        $kategori = $this->input->post("kategori");
        $jumlah = $this->input->post("jumlah");
        $harga = $this->input->post("harga");

        /*
          $insert = array(
          'kd_barang' => $kd_barang,
          'jumlah' => $jumlah,
          'nm_barang' => $nm_barang,
          'kategori' =>  $kategori,
          'satuan' =>$satuan,
          'harga' =>$harga,
          );
         * 
         */
        $data = array(
            'id' => $kd_barang,
            'qty' => 1,
            'price' => $harga,
            'name' => $nm_barang,
        );
        $this->cart->insert($data);
        var_dump($data);
        //header('location:' . base_url() . 'pengeluaran_barang/add');
    }

    function simpanKeluar() {
        $kode_keluar = $this->input->post("kode_keluar");
        $tipe_keluar = $this->input->post("tipe_keluar");
        $tgl_keluar = $this->input->post("tgl_keluar");

        $data = array(
            'kode_keluar' => $kode_keluar,
            'tipe_keluar' => $tipe_keluar,
            'tgl_keluar' => $tgl_keluar
        );
        $this->db->insert("keluar_barang", $data);
    }

    function cetakKeluar($kode_keluar) {
        $data['keluar'] = $this->pengeluaran_barangs->cetakKeluar($kode_keluar)->result_array();
        $data['company'] = $this->db->get("setting_toko")->row();
        $data['detail'] = $this->db->query("select * from keluar_barang where kode_keluar ='$kode_keluar'")->row();
        $this->load->view('pengeluaran_barang/cetakKeluar', $data);
    }

}

?>
