<?php

class Template {

    protected $_CI;

    function __construct() {
        $this->_CI = &get_instance();

        log_message('debug', "Template Class Initialized");
    }

    function display($template, $data = null) {
        $data['_content'] = $this->_CI->load->view($template, $data, true);
        //$data['_header']=$this->_CI->load->view('template/footer',$data,true);
        $data['_sidebar'] = $this->_CI->load->view('template/sidebar', $data, true);
        $data['_footer'] = $this->_CI->load->view('template/footer', $data, true);
        $this->_CI->load->view('/template.php', $data);
    }

    function get_toko() {
        $CI = & get_instance();
        $q = $CI->db->get("setting_toko");
        return $q;
    }

    function get_users($id) {
        $CI = &get_instance();
        $sql = $CI->db->query("select * from users where id_user = '$id'")->result();
        foreach ($sql as $tr) {
            $query = $tr->foto;
        }
        $data = '<img src="../assets/img/'.$query.'" class="img-circle" alt="User Image" height="25" width="25">';
        //<img src = "<?= base_url();

        return $data;
    }

}
