<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'template'));
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }

    public function index() {
        $data['title'] = "Home";
        $this->template->display('dashboard/index', $data);
    }

    function logout() {
        $this->session->unset_userdata('username');
        redirect('web');
    }

}

?>
