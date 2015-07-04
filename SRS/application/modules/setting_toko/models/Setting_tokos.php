<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of setting_toko
 * @created on : Monday, 11-May-2015 09:42:58
 * Copyright 2015    
 */
class setting_tokos extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *  Get All data setting_toko
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all() {

        $result = $this->db->get('setting_toko');

        return $result;
    }

    /**
     *  Count All setting_toko
     *    
     *  @return Integer
     *
     */
    public function count_all() {
        $this->db->from('setting_toko');
        return $this->db->count_all_results();
    }

    /**
     * Search All setting_toko
     *
     *  @param limit   : Integer
     *  @param offset  : Integer
     *  @param keyword : mixed
     *
     *  @return array
     *
     */
    public function get_search($limit, $offset) {
        $keyword = $this->session->userdata('keyword');

        $this->db->or_like('nama_toko', $keyword);

        $this->db->or_like('alamat_toko', $keyword);

        $this->db->or_like('logo_toko', $keyword);

        $this->db->or_like('telepon', $keyword);

        $this->db->or_like('fax', $keyword);

        $this->db->or_like('email', $keyword);

        $this->db->or_like('kodepos', $keyword);

        $this->db->or_like('hp', $keyword);

        $this->db->limit($limit, $offset);
        $result = $this->db->get('setting_toko');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    /**
     * Search All setting_toko
     * @param keyword : mixed
     *
     * @return Integer
     *
     */
    public function count_all_search() {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('setting_toko');

        $this->db->or_like('nama_toko', $keyword);

        $this->db->or_like('alamat_toko', $keyword);

        $this->db->or_like('logo_toko', $keyword);

        $this->db->or_like('telepon', $keyword);

        $this->db->or_like('fax', $keyword);

        $this->db->or_like('email', $keyword);

        $this->db->or_like('kodepos', $keyword);

        $this->db->or_like('hp', $keyword);

        return $this->db->count_all_results();
    }

    /**
     *  Get One setting_toko
     *
     *  @param id : Integer
     *
     *  @return array
     *
     */
    public function get_one($id) {
        $this->db->where('id_profile', $id);
        $result = $this->db->get('setting_toko');

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    /**
     *  Default form data setting_toko
     *  @return array
     *
     */
    public function add() {
        $data = array(
            'nama_toko' => '',
            'alamat_toko' => '',
            'logo_toko' => '',
            'telepon' => '',
            'fax' => '',
            'email' => '',
            'kodepos' => '',
            'hp' => '',
            'website' => '',
        );

        return $data;
    }

    /**
     *  Save data Post
     *
     *  @return void
     *
     */
    public function save() {
        $data = array(
            'nama_toko' => $this->input->post('nama_toko', TRUE),
            'alamat_toko' => $this->input->post('alamat_toko', TRUE),
            'telepon' => $this->input->post('telepon', TRUE),
            'fax' => $this->input->post('fax', TRUE),
            'email' => $this->input->post('email', TRUE),
            'kodepos' => $this->input->post('kodepos', TRUE),
            'hp' => $this->input->post('hp', TRUE),
            'website' => $this->input->post('website', TRUE),
        );
        //var_dump($data);
        //$this->db->insert('setting_toko', $data);
        $this->db->where("id_profile", "1");
        $this->db->update("setting_toko", $data);
        echo "suskes Broh";
    }

    public function update_foto_profile($nama) {
        $this->db->query("UPDATE setting_toko SET logo_toko ='" . $nama . "' WHERE id_profile=1");
    }

    /**
     *  Update modify data
     *
     *  @param id : Integer
     *
     *  @return void
     *
     */

    /**
     *  Delete data by id
     *
     *  @param id : Integer
     *
     *  @return void
     *
     */
    public function destroy($id) {
        $this->db->where('id_profile', $id);
        $this->db->delete('setting_toko');
    }

}
