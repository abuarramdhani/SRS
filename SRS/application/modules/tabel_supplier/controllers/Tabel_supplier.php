<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller tabel_supplier
 * @created on : Tuesday, 05-May-2015 02:45:18
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */
class tabel_supplier extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tabel_suppliers');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    /**
     * List all data tabel_supplier
     *
     */
    public function index() {
        $config = array(
            'base_url' => site_url('tabel_supplier/index/'),
            'total_rows' => $this->tabel_suppliers->count_all(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['tabel_suppliers'] = $this->tabel_suppliers->get_all($config['per_page'], $this->uri->segment(3));
        $data['kode_supplier'] = $this->tabel_suppliers->kode_supplier();
        $this->template->display('tabel_supplier/view', $data);
    }

    /**
     * Call Form to Add  New tabel_supplier
     *
     */
    public function add() {
        $data['tabel_supplier'] = $this->tabel_suppliers->add();
        $data['action'] = 'save';
        $data['kode_supplier'] = $this->tabel_suppliers->kode_supplier();


        $this->template->display('tabel_supplier/form', $data);
    }

    /**
     * Call Form to Modify tabel_supplier
     *
     */
    public function edit($id = '') {
        if ($id != '') {

            $data['tabel_supplier'] = $this->tabel_suppliers->get_one($id);
            $data['action'] = 'save/' . $id;
            $data['kode_supplier'] = $this->tabel_suppliers->kode_supplier();

            $this->template->display('tabel_supplier/form', $data);
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'info'));
            redirect(site_url('tabel_supplier'));
        }
    }

    /**
     * Save & Update data  tabel_supplier
     *
     */
    public function save($id = NULL) {
        // validation config
        $config = array(
            array(
                'field' => 'nm_supplier',
                'label' => 'Nm Supplier',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'almt_supplier',
                'label' => 'Almt Supplier',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'tlp_supplier',
                'label' => 'Tlp Supplier',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'fax_supplier',
                'label' => 'Fax Supplier',
                'rules' => 'trim'
            ),
            array(
                'field' => 'atas_nama',
                'label' => 'Atas Nama',
                'rules' => 'trim|required'
            ),
        );

        // if id NULL then add new data
        if (!$id) {
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == TRUE) {
                if ($this->input->post()) {

                    $this->tabel_suppliers->save();
                    $this->session->set_flashdata('notif', notify('Data berhasil di simpan', 'success'));
                    redirect('tabel_supplier');
                }
            } else { // If validation incorrect 
                $this->add();
            }
        } else { // Update data if Form Edit send Post and ID available
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == TRUE) {
                if ($this->input->post()) {
                    $this->tabel_suppliers->update($id);
                    $this->session->set_flashdata('notif', notify('Data berhasil di update', 'success'));
                    redirect('tabel_supplier');
                }
            } else { // If validation incorrect 
                $this->edit($id);
            }
        }
    }

    /**
     * Detail tabel_supplier
     *
     */
    public function show($id = '') {
        if ($id != '') {

            $data['tabel_supplier'] = $this->tabel_suppliers->get_one($id);
            $this->template->display('tabel_supplier/_show', $data);
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'info'));
            redirect(site_url('tabel_supplier'));
        }
    }

    /**
     * Search tabel_supplier like ""
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
            'base_url' => site_url('tabel_supplier/search/'),
            'total_rows' => $this->tabel_suppliers->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['tabel_suppliers'] = $this->tabel_suppliers->get_search($config['per_page'], $this->uri->segment(3));

        $this->template->display('tabel_supplier/view', $data);
    }

    /**
     * Delete tabel_supplier by ID
     *
     */
    public function destroy($id) {
        if ($id) {
            $this->tabel_suppliers->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('tabel_supplier');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('tabel_supplier');
        }
    }

}

?>
