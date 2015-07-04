<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of tabel_supplier
 * @created on : Tuesday, 05-May-2015 02:45:18
 * @author DAUD D. SIMBOLON <daud.simbolon@gmail.com>
 * Copyright 2015    
 */
class tabel_suppliers extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *  Get All data tabel_supplier
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) {

        $result = $this->db->get('tabel_supplier', $limit, $offset);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function kode_supplier() {
        $q = $this->db->query("select MAX(RIGHT(kd_supplier,4)) as kd_max from tabel_supplier");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return "SU" . $kd;
    }

    /**
     *  Count All tabel_supplier
     *    
     *  @return Integer
     *
     */
    public function count_all() {
        $this->db->from('tabel_supplier');
        return $this->db->count_all_results();
    }

    /**
     * Search All tabel_supplier
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

        $this->db->like('kd_supplier', $keyword);

        $this->db->like('nm_supplier', $keyword);

        $this->db->like('almt_supplier', $keyword);

        $this->db->like('tlp_supplier', $keyword);

        $this->db->like('fax_supplier', $keyword);

        $this->db->like('atas_nama', $keyword);

        $this->db->limit($limit, $offset);
        $result = $this->db->get('tabel_supplier');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    /**
     * Search All tabel_supplier
     * @param keyword : mixed
     *
     * @return Integer
     *
     */
    public function count_all_search() {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('tabel_supplier');

        $this->db->like('kd_supplier', $keyword);

        $this->db->or_like('nm_supplier', $keyword);

        $this->db->or_like('almt_supplier', $keyword);

        $this->db->or_like('tlp_supplier', $keyword);

        $this->db->or_like('fax_supplier', $keyword);

        $this->db->or_like('atas_nama', $keyword);

        return $this->db->count_all_results();
    }

    /**
     *  Get One tabel_supplier
     *
     *  @param id : Integer
     *
     *  @return array
     *
     */
    public function get_one($id) {
        $this->db->where('id_supplier', $id);
        $result = $this->db->get('tabel_supplier');

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    /**
     *  Default form data tabel_supplier
     *  @return array
     *
     */
    public function add() {
        $data = array(
            'kd_supplier' => '',
            'nm_supplier' => '',
            'almt_supplier' => '',
            'tlp_supplier' => '',
            'fax_supplier' => '',
            'atas_nama' => '',
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
            'kd_supplier' => strip_tags($this->input->post('kd_supplier', TRUE)),
            'nm_supplier' => strip_tags($this->input->post('nm_supplier', TRUE)),
            'almt_supplier' => strip_tags($this->input->post('almt_supplier', TRUE)),
            'tlp_supplier' => strip_tags($this->input->post('tlp_supplier', TRUE)),
            'fax_supplier' => strip_tags($this->input->post('fax_supplier', TRUE)),
            'atas_nama' => strip_tags($this->input->post('atas_nama', TRUE)),
        );


        $this->db->insert('tabel_supplier', $data);
    }

    /**
     *  Update modify data
     *
     *  @param id : Integer
     *
     *  @return void
     *
     */
    public function update($id) {
        $data = array(
            'kd_supplier' => strip_tags($this->input->post('kd_supplier', TRUE)),
            'nm_supplier' => strip_tags($this->input->post('nm_supplier', TRUE)),
            'almt_supplier' => strip_tags($this->input->post('almt_supplier', TRUE)),
            'tlp_supplier' => strip_tags($this->input->post('tlp_supplier', TRUE)),
            'fax_supplier' => strip_tags($this->input->post('fax_supplier', TRUE)),
            'atas_nama' => strip_tags($this->input->post('atas_nama', TRUE)),
        );
        $this->db->where('id_supplier', $id);
        $this->db->update('tabel_supplier', $data);
    }

    /**
     *  Delete data by id
     *
     *  @param id : Integer
     *
     *  @return void
     *
     */
    public function destroy($id) {
        $this->db->where('id_supplier', $id);
        $this->db->delete('tabel_supplier');
    }

}
