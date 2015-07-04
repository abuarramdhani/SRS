<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller tabel_pelanggan
 * @created on : Sunday, 17-May-2015 00:39:47
 * @author Arief Manggala Putra <manggalacorp@gmail.com>
 * Copyright 2015
 *
 *
 */


class tabel_pelanggan extends CI_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('tabel_pelanggans');
    }
    

    /**
    * List all data tabel_pelanggan
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('tabel_pelanggan/index/'),
            'total_rows'        => $this->tabel_pelanggans->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['tabel_pelanggans']       = $this->tabel_pelanggans->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('tabel_pelanggan/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New tabel_pelanggan
    *
    */
    public function add() 
    {       
        $data['tabel_pelanggan'] = $this->tabel_pelanggans->add();
        $data['action']  = 'tabel_pelanggan/save';
     
        $this->template->display('tabel_pelanggan/form',$data);

    }

    

    /**
    * Call Form to Modify tabel_pelanggan
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['tabel_pelanggan']      = $this->tabel_pelanggans->get_one($id);
            $data['action']       = 'tabel_pelanggan/save/' . $id;           
            
            $this->template->display('tabel_pelanggan/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan','info'));
            redirect(site_url('tabel_pelanggan'));
        }
    }


    
    /**
    * Save & Update data  tabel_pelanggan
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'nama_pelanggan',
                        'label' => 'Nama Pelanggan',
                        'rules' => 'trim|required'
                        ),
                    
                    array(
                        'field' => 'alamat',
                        'label' => 'Alamat',
                        'rules' => 'trim|required'
                        ),
                    
                    array(
                        'field' => 'telp',
                        'label' => 'Telp',
                        'rules' => 'trim|required'
                        ),
                    
                    array(
                        'field' => 'hp',
                        'label' => 'Hp',
                        'rules' => 'trim'
                        ),
                    
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim'
                        ),
                               
                  );
            
        // if id NULL then add new data
        if(!$id)
        {    
                  $this->form_validation->set_rules($config);

                  if ($this->form_validation->run() == TRUE) 
                  {
                      if ($this->input->post()) 
                      {
                          
                          $this->tabel_pelanggans->save();
                          $this->session->set_flashdata('notif', notify('Data berhasil di simpan','success'));
                          redirect('tabel_pelanggan');
                      }
                  } 
                  else // If validation incorrect 
                  {
                      $this->add();
                  }
         }
         else // Update data if Form Edit send Post and ID available
         {               
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == TRUE) 
                {
                    if ($this->input->post()) 
                    {
                        $this->tabel_pelanggans->update($id);
                        $this->session->set_flashdata('notif', notify('Data berhasil di update','success'));
                        redirect('tabel_pelanggan');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail tabel_pelanggan
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['tabel_pelanggan'] = $this->tabel_pelanggans->get_one($id);            
            $this->template->display('tabel_pelanggan/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan','info'));
            redirect(site_url('tabel_pelanggan'));
        }
    }
    
    
    /**
    * Search tabel_pelanggan like ""
    *
    */   
    public function search()
    {
        if($this->input->post('q'))
        {
            $keyword = $this->input->post('q');
            
            $this->session->set_userdata(
                        array('keyword' => $this->input->post('q',TRUE))
                    );
        }
        
         $config = array(
            'base_url'          => site_url('tabel_pelanggan/search/'),
            'total_rows'        => $this->tabel_pelanggans->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['tabel_pelanggans']       = $this->tabel_pelanggans->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->display('tabel_pelanggan/view',$data);
    }
    
    
    /**
    * Delete tabel_pelanggan by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->tabel_pelanggans->destroy($id);           
             $this->session->set_flashdata('notif', notify('Data berhasil di hapus','success'));
             redirect('tabel_pelanggan');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan','warning'));
            redirect('tabel_pelanggan');
        }       
    }

}

?>
