<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');



class tabel_satuan_barang extends CI_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('tabel_satuan_barangs');
        if (!$this->session->userdata('username')) {
            redirect('index.php/web');
        }
    }
    

    /**
    * List all data tabel_satuan_barang
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('tabel_satuan_barang/index/'),
            'total_rows'        => $this->tabel_satuan_barangs->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['tabel_satuan_barangs']       = $this->tabel_satuan_barangs->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->display('tabel_satuan_barang/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New tabel_satuan_barang
    *
    */
    public function add() 
    {       
        $data['tabel_satuan_barang'] = $this->tabel_satuan_barangs->add();
        $data['action']  = 'tabel_satuan_barang/save';

      
        $this->template->display('tabel_satuan_barang/form',$data);

    }

    

    /**
    * Call Form to Modify tabel_satuan_barang
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['tabel_satuan_barang']      = $this->tabel_satuan_barangs->get_one($id);
            $data['action']       = 'tabel_satuan_barang/save/' . $id;           
      
            
            $this->template->display('tabel_satuan_barang/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan','info'));
            redirect(site_url('tabel_satuan_barang'));
        }
    }


    
    /**
    * Save & Update data  tabel_satuan_barang
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'nm_satuan',
                        'label' => 'Nm Satuan',
                        'rules' => 'trim|required'
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
                          
                          $this->tabel_satuan_barangs->save();
                          $this->session->set_flashdata('notif', notify('Data berhasil di simpan','success'));
                          redirect('tabel_satuan_barang');
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
                        $this->tabel_satuan_barangs->update($id);
                        $this->session->set_flashdata('notif', notify('Data berhasil di update','success'));
                        redirect('tabel_satuan_barang');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail tabel_satuan_barang
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['tabel_satuan_barang'] = $this->tabel_satuan_barangs->get_one($id);            
            $this->template->display('tabel_satuan_barang/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan','info'));
            redirect(site_url('tabel_satuan_barang'));
        }
    }
    
    
    /**
    * Search tabel_satuan_barang like ""
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
            'base_url'          => site_url('tabel_satuan_barang/search/'),
            'total_rows'        => $this->tabel_satuan_barangs->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['tabel_satuan_barangs']       = $this->tabel_satuan_barangs->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->display('tabel_satuan_barang/view',$data);
    }
    
    
    /**
    * Delete tabel_satuan_barang by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->tabel_satuan_barangs->destroy($id);           
             $this->session->set_flashdata('notif', notify('Data berhasil di hapus','success'));
             redirect('tabel_satuan_barang');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('Data tidak ditemukan','warning'));
            redirect('tabel_satuan_barang');
        }       
    }

}

?>
