<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class tabel_satuan_barangs extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data tabel_satuan_barang
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {
        $this->db->order_by("nm_satuan", "asc"); 
        $result = $this->db->get('tabel_satuan_barang', $limit, $offset);

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
     *  Count All tabel_satuan_barang
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('tabel_satuan_barang');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All tabel_satuan_barang
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
                
        $this->db->like('nm_satuan', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('tabel_satuan_barang');

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
    * Search All tabel_satuan_barang
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('tabel_satuan_barang');        
                
        $this->db->like('nm_satuan', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One tabel_satuan_barang
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('id_satuan', $id);
        $result = $this->db->get('tabel_satuan_barang');

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
    *  Default form data tabel_satuan_barang
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'nm_satuan' => '',
            
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
        
            'nm_satuan' => strip_tags($this->input->post('nm_satuan', TRUE)),
        
        );
        
        
        $this->db->insert('tabel_satuan_barang', $data);
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
        
                'nm_satuan' => strip_tags($this->input->post('nm_satuan', TRUE)),
        
        );
        
        
        $this->db->where('id_satuan', $id);
        $this->db->update('tabel_satuan_barang', $data);
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
        $this->db->where('id_satuan', $id);
        $this->db->delete('tabel_satuan_barang');
        
    }







    



}
