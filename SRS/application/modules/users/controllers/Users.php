<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller users
 * @created on : Wednesday, 13-May-2015 02:23:37
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */
class users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('userss');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    /**
     * List all data users
     *
     */
    public function index() {
        $config = array(
            'base_url' => site_url('users/index/'),
            'total_rows' => $this->userss->count_all(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['userss'] = $this->userss->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('users/view', $data);
    }

    /**
     * Call Form to Add  New users
     *
     */
    public function add() {
        $data['users'] = $this->userss->add();
        $data['action'] = 'users/save';


        $this->template->display('users/form_input', $data);
    }

    /**
     * Call Form to Modify users
     *
     */
    
    
    public function edit($id = '') {
        if ($id != '') {

            $data['users'] = $this->userss->get_one($id);
            $data['action'] = 'users/save_edit/' . $id;

            $this->template->display('users/form', $data);
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'info'));
            redirect(site_url('users'));
        }
    }

    /**
     * Save & Update data  users
     *
     */
     public function save_edit($id) {
        // validation config
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'akses',
                'label' => 'Akses',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'foto',
                'label' => 'Foto',
                'rules' => 'trim'
            ),
        );

        // if id NULL then add new data


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post()) {

                $this->userss->save_edit($id);
                $this->session->set_flashdata('notif', notify('Data berhasil di simpan', 'success'));
                redirect('users');
            }
        } else { // If validation incorrect 
            $this->edit();
        }
    }
    
    
    public function save() {
        // validation config
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'akses',
                'label' => 'Akses',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'foto',
                'label' => 'Foto',
                'rules' => 'trim'
            ),
        );

        // if id NULL then add new data


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post()) {

                $this->userss->save();
                $this->session->set_flashdata('notif', notify('Data berhasil di simpan', 'success'));
                redirect('users');
            }
        } else { // If validation incorrect 
            $this->add();
        }
    }

    /**
     * Search users like ""
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
            'base_url' => site_url('users/search/'),
            'total_rows' => $this->userss->count_all_search(),
            'per_page' => $this->config->item('per_page'),
            'uri_segment' => 3,
            'num_links' => 9,
            'use_page_numbers' => FALSE
        );

        $this->pagination->initialize($config);
        $data['total'] = $config['total_rows'];
        $data['number'] = (int) $this->uri->segment(3) + 1;
        $data['pagination'] = $this->pagination->create_links();
        $data['userss'] = $this->userss->get_search($config['per_page'], $this->uri->segment(3));

        $this->template->display('users/view', $data);
    }

    /**
     * Delete users by ID
     *
     */
    public function destroy($id) {
        if ($id) {
            $this->userss->destroy($id);
            $this->session->set_flashdata('notif', notify('Data berhasil di hapus', 'success'));
            redirect('users');
        } else {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan', 'warning'));
            redirect('users');
        }
    }

}

?>
