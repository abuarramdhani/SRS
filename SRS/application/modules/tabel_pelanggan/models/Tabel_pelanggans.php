<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of tabel_pelanggan
 * @created on : Sunday, 17-May-2015 00:39:47
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015    
 */
 
 
class tabel_pelanggans extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data tabel_pelanggan
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {
        $this->db->order_by("nama_pelanggan", "asc"); 
        $result = $this->db->get('tabel_pelanggan', $limit, $offset);

        if ($result->num_rows() > 0) 
        {
            return $result->result_array();
        } 
        else 
        {
            return array();
        }
    }

    

    /**
     *  Count All tabel_pelanggan
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('tabel_pelanggan');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All tabel_pelanggan
    *
    *  @param limit   : Integer
    *  @param offset  : Integer
    *  @param keyword : mixed
    *
    *  @return array
    *
    */
    public function get_search($limit, $offset) 
    {
        $keyword = $this->session->userdata('keyword');
                
        $this->db->like('nama_pelanggan', $keyword);  
                
        $this->db->like('alamat', $keyword);  
                
        $this->db->like('telp', $keyword);  
                
        $this->db->like('hp', $keyword);  
                
        $this->db->like('email', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('tabel_pelanggan');

        if ($result->num_rows() > 0) 
        {
            return $result->result_array();
        } 
        else 
        {
            return array();
        }
    }

    
    
    
    
    
    /**
    * Search All tabel_pelanggan
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('tabel_pelanggan');        
                
        $this->db->like('nama_pelanggan', $keyword);  
                
        $this->db->like('alamat', $keyword);  
                
        $this->db->like('telp', $keyword);  
                
        $this->db->like('hp', $keyword);  
                
        $this->db->like('email', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One tabel_pelanggan
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('id_pelanggan', $id);
        $result = $this->db->get('tabel_pelanggan');

        if ($result->num_rows() == 1) 
        {
            return $result->row_array();
        } 
        else 
        {
            return array();
        }
    }

    
    
    
    /**
    *  Default form data tabel_pelanggan
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'nama_pelanggan' => '',
            
                'alamat' => '',
            
                'telp' => '',
            
                'hp' => '',
            
                'email' => '',
            
        );

        return $data;
    }

    
    
    
    
    /**
    *  Save data Post
    *
    *  @return void
    *
    */
    public function save() 
    {
        $data = array(
        
            'nama_pelanggan' => strip_tags($this->input->post('nama_pelanggan', TRUE)),
        
            'alamat' => strip_tags($this->input->post('alamat', TRUE)),
        
            'telp' => strip_tags($this->input->post('telp', TRUE)),
        
            'hp' => strip_tags($this->input->post('hp', TRUE)),
        
            'email' => strip_tags($this->input->post('email', TRUE)),
        
        );
        
        
        $this->db->insert('tabel_pelanggan', $data);
    }
    
    
    

    
    /**
    *  Update modify data
    *
    *  @param id : Integer
    *
    *  @return void
    *
    */
    public function update($id)
    {
        $data = array(
        
                'nama_pelanggan' => strip_tags($this->input->post('nama_pelanggan', TRUE)),
        
                'alamat' => strip_tags($this->input->post('alamat', TRUE)),
        
                'telp' => strip_tags($this->input->post('telp', TRUE)),
        
                'hp' => strip_tags($this->input->post('hp', TRUE)),
        
                'email' => strip_tags($this->input->post('email', TRUE)),
        
        );
        
        
        $this->db->where('id_pelanggan', $id);
        $this->db->update('tabel_pelanggan', $data);
    }


    
    
    
    /**
    *  Delete data by id
    *
    *  @param id : Integer
    *
    *  @return void
    *
    */
    public function destroy($id)
    {       
        $this->db->where('id_pelanggan', $id);
        $this->db->delete('tabel_pelanggan');
        
    }







    



}
