<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class web extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_web');
        //if ($this->session->userdata('username'));
        //redirect(base_url());
    }

    public function index() {
        
        $this->load->view('web');
    }

    public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Username dan password harus diisi');
            redirect('index.php/web');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $cek = $this->m_web->cek($username, md5($password));
            if ($cek->num_rows() > 0) {
                //login berhasil, buat session
                $data = $cek->row();
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('id_user', $data->id_user);
                $this->session->set_flashdata('sukses', 'Sukses ! Anda Berhasil Login');

                redirect('index.php/dashboard');
            } else {
                //login gagal
                $this->session->set_flashdata('message', 'Username dan Password Salah');
                redirect('index.php/web');
            }
        }
    }

}
