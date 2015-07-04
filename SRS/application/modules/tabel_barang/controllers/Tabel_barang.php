<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabel_barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tabel_barangs');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    /**
     * List all data tabel_barang
     *
     */
    public function upload() {

    }

    public function index() {
        $config = array(
            'base_url' => site_url('tabel_barang/index/'),
            'total_rows' => $this->tabel_barangs->count_all(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['kode_barang'] = $this->tabel_barangs->kode_barang();
        $data['tabel_satuan_barang'] = $this->tabel_barangs->get_tabel_satuan_barang();
        $data['tabel_kategori_barang'] = $this->tabel_barangs->get_tabel_kategori_barang();
        $data['tabel_barangs'] = $this->tabel_barangs->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('tabel_barang/view', $data);
    }

    /**
     * Call Form to Add  New tabel_barang
     *
     */
    public function add() {
        $data['tabel_barang'] = $this->tabel_barangs->add();
        $data['kode_barang'] = $this->tabel_barangs->kode_barang();
        $data['action'] = 'save';
        $data['tabel_satuan_barang'] = $this->tabel_barangs->get_tabel_satuan_barang();
        $data['tabel_kategori_barang'] = $this->tabel_barangs->get_tabel_kategori_barang();

        $this->template->display('tabel_barang/form', $data);
    }

    /**
     * Call Form to Modify tabel_barang
     *
     */
    public function edit($id = '') {
        if ($id != '') {

            $data['tabel_barang'] = $this->tabel_barangs->get_one($id);
            $data['action'] = 'save/' . $id;
            $data['kode_barang'] = $this->tabel_barangs->kode_barang();
            $data['tabel_satuan_barang'] = $this->tabel_barangs->get_tabel_satuan_barang();
            $data['tabel_kategori_barang'] = $this->tabel_barangs->get_tabel_kategori_barang();

            $this->template->display('tabel_barang/form', $data);
        } else {
            $this->session->set_flashdata('notif', 'Data tidak ditemukan');
            redirect(site_url('tabel_barang'));
        }
    }

    /**
     * Save & Update data  tabel_barang
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

                    $this->tabel_barangs->save();
                    $this->session->set_flashdata('notif', 'Data berhasil di simpan');
                    redirect('tabel_barang');
                }
            } else { // If validation incorrect 
                $this->add();
            }
        } else { // Update data if Form Edit send Post and ID available
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == TRUE) {
                if ($this->input->post()) {
                    $this->tabel_barangs->update($id);
                    $this->session->set_flashdata('notif', 'Data berhasil di update');
                    redirect('tabel_barang');
                }
            } else { // If validation incorrect 
                $this->edit($id);
            }
        }
    }

    /**
     * Detail tabel_barang
     *
     */
    public function show($id = '') {
        if ($id != '') {

            $data['tabel_barang'] = $this->tabel_barangs->get_one($id);
            $this->template->display('_show', $data);
        } else {
            $this->session->set_flashdata('notif', 'Data tidak ditemukan');
            redirect(site_url('tabel_barang'));
        }
    }

    /**
     * Search tabel_barang like ""
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
            'base_url' => site_url('tabel_barang/search/'),
            'total_rows' => $this->tabel_barangs->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['tabel_barangs'] = $this->tabel_barangs->get_search($config['per_page'], $this->uri->segment(3));

        $this->template->display('tabel_barang/view', $data);
    }

    /**
     * Delete tabel_barang by ID
     *
     */
    public function destroy($id) {
        if ($id) {
            $this->tabel_barangs->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('tabel_barang');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('tabel_barang');
        }
    }

}

?>
