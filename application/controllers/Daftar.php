<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {
	 function __construct(){
        parent::__construct();
        //load libary pagination
        $this->load->library('pagination');
 
        //load the department_model
        $this->load->model('m_daftar');
    }
 
    public function index(){
        //load view mahasiswa view
        $data["kategori"] = $this->m_daftar->get_kategori();  
        $data["tahun"] = $this->m_daftar->get_tahun(); 
        $this->load->view('v_list',$data);
    }

    public function loadRecord($rowno=0){

  	    // Row per page
  	    $rowperpage = 5;

  	    // Row position
  	    if($rowno != 0){
  	      $rowno = ($rowno-1) * $rowperpage;
  	    }
  	 
  	    // All records count
  	    $allcount = $this->m_daftar->getrecordCount();

  	    // Get records
  	    $users_record = $this->m_daftar->getAllData($rowno,$rowperpage);
  	 
  	    // Pagination Configuration
  	    $config['base_url'] = base_url().'daftar/loadRecord';
  	    $config['use_page_numbers'] = TRUE;
  	    $config['total_rows'] = $allcount;
  	    $config['per_page'] = $rowperpage;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = '<i class="glyphicon glyphicon-menu-right"></i>';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
  	    // Initialize
  	    $this->pagination->initialize($config);

  	    // Initialize $data Array
  	    $data['pagination'] = $this->pagination->create_links();
  	    $data['result'] = $users_record;
  	    $data['row'] = $rowno;

  	    echo json_encode($data);
  	}

  	public function keterkaitan($kaitan,$idf){
  		//$kaitan-replace()
      $kaitan=str_replace('%20'," ",$kaitan);
  		 $keterkaitannya = $this->m_daftar->get_fileterkait($kaitan,$idf);
  		 $datax['result'] = $keterkaitannya;
  		 $datax['x']=$kaitan;
  		 echo json_encode($datax);
  	}
}

