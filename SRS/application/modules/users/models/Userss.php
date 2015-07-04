<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of users
 * @created on : Wednesday, 13-May-2015 02:23:37
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015    
 */
class userss extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }

    /**
     *  Get All data users
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     * $vfile_upload = "assets/img/logo_aplikasi.png";
      //Simpan gambar dalam ukuran sebenarnya
      move_uploaded_file($_FILES["foto_profile"]["tmp_name"], $vfile_upload);

      $namas = "logo_aplikasi.png";
     */
    public function get_all($limit, $offset) {

        $result = $this->db->get('users', $limit, $offset);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    /**
     *  Count All users
     *    
     *  @return Integer
     *
     */
    public function count_all() {
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    /**
     * Search All users
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

        $this->db->like('username', $keyword);

        $this->db->like('email', $keyword);

        $this->db->like('password', $keyword);

        $this->db->like('akses', $keyword);

        $this->db->like('foto', $keyword);

        $this->db->limit($limit, $offset);
        $result = $this->db->get('users');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    /**
     * Search All users
     * @param keyword : mixed
     *
     * @return Integer
     *
     */
    public function count_all_search() {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('users');

        $this->db->like('username', $keyword);

        $this->db->like('email', $keyword);

        $this->db->like('password', $keyword);

        $this->db->like('akses', $keyword);

        $this->db->like('foto', $keyword);

        return $this->db->count_all_results();
    }

    /**
     *  Get One users
     *
     *  @param id : Integer
     *
     *  @return array
     *
     */
    public function get_one($id) {
        $this->db->where('id_user', $id);
        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    /**
     *  Default form data users
     *  @return array
     *
     */
    public function add() {
        $data = array(
            'username' => '',
            'email' => '',
            'password' => '',
            'akses' => '',
            'foto' => '',
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
        //setting konfiguras upload image
        $config['upload_path'] = 'assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '2000';
        $config['max_height'] = '1024';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('foto')) {
            $gambar = "";
        } else {
            $gambar = $this->upload->file_name;
        }

        $data = array(
            'username' => strip_tags($this->input->post('username', TRUE)),
            'email' => strip_tags($this->input->post('email', TRUE)),
            'password' => md5($this->input->post('password', TRUE)),
            'akses' => strip_tags($this->input->post('akses', TRUE)),
            'foto' => $gambar,
        );
        $this->db->insert('users', $data);
    }

    public function save_edit($id) {
        //setting konfiguras upload image
        $config['upload_path'] = 'assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '2000';
        $config['max_height'] = '1024';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('foto')) {
            $gambar = "";
        } else {
            $gambar = $this->upload->file_name;
        }

        if ($this->input->post("password_baru") != "") {
            if ($gambar == "") {
                $data = array(
                    'username' => strip_tags($this->input->post('username', TRUE)),
                    'email' => strip_tags($this->input->post('email', TRUE)),
                    'password' => md5($this->input->post('password_baru', TRUE)),
                    'akses' => strip_tags($this->input->post('akses', TRUE)),
                );
                $this->db->where('id_user', $id);
                $this->db->update('users', $data);
            } else {
                $data = array(
                    'username' => strip_tags($this->input->post('username', TRUE)),
                    'email' => strip_tags($this->input->post('email', TRUE)),
                    'password' => md5($this->input->post('password_baru', TRUE)),
                    'akses' => strip_tags($this->input->post('akses', TRUE)),
                    'foto' => $gambar,
                );
                $this->db->where('id_user', $id);
                $this->db->update('users', $data);
            }
        } else {
            if ($gambar == "") {
                $data = array(
                    'username' => strip_tags($this->input->post('username', TRUE)),
                    'email' => strip_tags($this->input->post('email', TRUE)),
                    'akses' => strip_tags($this->input->post('akses', TRUE)),
                );
                $this->db->where('id_user', $id);
                $this->db->update('users', $data);
            } else {
                $data = array(
                    'username' => strip_tags($this->input->post('username', TRUE)),
                    'email' => strip_tags($this->input->post('email', TRUE)),
                    'akses' => strip_tags($this->input->post('akses', TRUE)),
                    'foto' => $gambar,
                );
                $this->db->where('id_user', $id);
                $this->db->update('users', $data);
            }
        }
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
            'username' => strip_tags($this->input->post('username', TRUE)),
            'email' => strip_tags($this->input->post('email', TRUE)),
            'password' => strip_tags($this->input->post('password', TRUE)),
            'akses' => strip_tags($this->input->post('akses', TRUE)),
            'foto' => strip_tags($this->input->post('foto', TRUE)),
        );


        $this->db->where('id_user', $id);
        $this->db->update('users', $data);
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
        //$query = $this->db->get_where("users", array("id_user", $id))->row();
        $sql = $this->db->query("select * from users where id_user = '$id' ")->row();
        unlink("assets/img/" . $sql->foto);


        $this->db->where('id_user', $id);
        $this->db->delete('users');
    }

}
