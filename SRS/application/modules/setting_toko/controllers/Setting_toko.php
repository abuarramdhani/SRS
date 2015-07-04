<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller setting_toko
 * @created on : Monday, 11-May-2015 09:42:58
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */
class setting_toko extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('setting_tokos');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    /**
     * List all data setting_toko
     *
     */
    public function index() {
        $data['setting_toko'] = $this->setting_tokos->get_all()->row();
        $data['action'] = 'setting_toko/save';
        $this->load->library('template');
        $data['company'] = $this->template->get_toko()->row();


        $this->template->display('setting_toko/form', $data);
    }

    /**
     * Call Form to Add  New setting_toko
     *
     */
    public function add() {
        $data['setting_toko'] = $this->setting_tokos->get_all()->row();
        $data['action'] = 'setting_toko/save/';
        $this->template->display('setting_toko/form', $data);
    }

    /**
     * Call Form to Modify setting_toko
     *
     */
    public function edit($id = '') {
        if ($id != '') {

            $data['setting_toko'] = $this->setting_tokos->get_one($id);
            $data['action'] = 'setting_toko/save/' . $id;



            $this->template->display('setting_toko/form', $data);
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'info'));
            redirect(site_url('setting_toko'));
        }
    }

    /**
     * Save & Update data  setting_toko
     *
     */
    public function save($id = NULL) {
        // validation config
        $config = array(
            array(
                'field' => 'nama_toko',
                'label' => 'Nama Toko',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'alamat_toko',
                'label' => 'Alamat Toko',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'logo_toko',
                'label' => 'Logo Toko',
                'rules' => 'trim'
            ),
            array(
                'field' => 'telepon',
                'label' => 'Telepon',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'fax',
                'label' => 'Fax',
                'rules' => 'trim'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim'
            ),
            array(
                'field' => 'kodepos',
                'label' => 'Kodepos',
                'rules' => 'trim'
            ),
            array(
                'field' => 'hp',
                'label' => 'Hp',
                'rules' => 'trim'
            ),
        );
        // if id NULL then add new data
        $this->setting_tokos->save();
    }

    /**
     * Detail setting_toko
     *
     */
    public function show($id = '') {
        if ($id != '') {

            $data['setting_toko'] = $this->setting_tokos->get_one($id);
            $this->template->display('setting_toko/_show', $data);
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'info'));
            redirect(site_url('setting_toko'));
        }
    }

    /**
     * Search setting_toko like ""
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
            'base_url' => site_url('setting_toko/search/'),
            'total_rows' => $this->setting_tokos->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['setting_tokos'] = $this->setting_tokos->get_search($config['per_page'], $this->uri->segment(3));

        $this->template->display('setting_toko/view', $data);
    }

    /**
     * Delete setting_toko by ID
     *
     */
    public function destroy($id) {
        if ($id) {
            $this->setting_tokos->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('setting_toko');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('setting_toko');
        }
    }

    function UploadFotoProfile() {

        $this->load->library('template');

        $vfile_upload = "assets/img/logo_aplikasi.png";
        //Simpan gambar dalam ukuran sebenarnya
        move_uploaded_file($_FILES["foto_profile"]["tmp_name"], $vfile_upload);

        $namas = "logo_aplikasi.png";
        $this->setting_tokos->update_foto_profile($namas);
    }

}

?>
