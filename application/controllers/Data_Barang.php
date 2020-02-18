<?php 
 class data_barang extends CI_Controller { 

      public function __construct()     {

        $this->load->database();

             parent::__construct();        
              $this->load->model('data_barang_model');      
              $this->load->helper('url_helper');   
                }    

 public function index()     { 

    $data['databarang'] = $this->barang_model->get_data_barang();  
       $data['kode_barang'] = 'databarang archive';   

         $this->load->view('templates/header', $data);
         $this->load->view('news/index', $data);
         $this->load->view('templates/footer');    
          }     
       public function view($slug = NULL)    
        {  
      $data['news_item'] = $this->barang_model->get_data_barang($slug);

        if (empty($data['news_item']))        
         {   
          show_404();     
           }           
           
           $data['databarang'] = $data['news_item']['title']; 

  $this->load->view('templates/header', $data);  
         $this->load->view('news/view', $data);    
              $this->load->view('templates/footer');  
                 }          
      public function create()     {   
            $this->load->helper('form'); 
         $this->load->library('form_validation');  

       $data['title'] = 'Create a news item';

    $this->form_validation->set_rules('title', 'Title', 'required');     
     $this->form_validation->set_rules('text', 'Text', 'required');
         
     if ($this->form_validation->run() === FALSE)    
          {            
        $this->load->view('templates/header', $data);  
        $this->load->view('news/create');    
         $this->load->view('templates/footer');      
           }       
          else 
          { 
           $this->news_model->set_news();   
           $this->load->view('templates/header', $data);    
           $this->load->view('news/success');    
           $this->load->view('templates/footer');    
             }   
           } 

  
   public function delete()   
                          {        
 $id = $this->uri->segment(3);  
            if (empty($id))       
           {   
  show_404();    
                             }          
   $news_item = $this->news_model->get_news_by_id($id)

      $this->news_model->delete_news($id);
     redirect( base_url() . 'index.php/news'); 
            }

      } 