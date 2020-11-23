<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peraturan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('pagination');		
		$this->load->model('m_peraturan');        
	}
  public function index(){
    if($this->session->userdata('status')=='login'){
    	$data["kategori"] = $this->m_peraturan->get_kategori(); // Panggil
      $data["terkait"] = $this->m_peraturan->get_terkait(); 
    	$this->load->view('v_listperaturan',$data);
    }else{
      redirect(base_url());
    }
	}
	
	public function loadRecord($rowno=0){
    // Row per page
    $rowperpage = 5;

    // Row position
    if($rowno != 0){
      $rowno = ($rowno-1) * $rowperpage;
    }
 
    // All records count
    $allcount = $this->m_peraturan->getrecordCount();

    // Get records
    $users_record = $this->m_peraturan->getAllData($rowno,$rowperpage);
 
    // Pagination Configuration
    $config['base_url']         = base_url().'peraturan/loadRecord';
    $config['use_page_numbers'] = TRUE;
    $config['reuse_query_string'] = TRUE;
    $config['total_rows']       = $allcount;
    $config['per_page']         = $rowperpage;
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

	function get_aturan(){
    $id_aturan=$this->input->get('id');
    $data=$this->m_peraturan->get_aturan_by_id($id_aturan);
    echo json_encode($data);
  }

  function tambah(){
    $config['upload_path']="./dok";
    $config['allowed_types']='pdf|doc|docx|rar';
    $this->load->library('upload',$config);
    if($this->upload->do_upload('berkas')){
      $file = array('upload_data' => $this->upload->data());
      $data['judul']=$this->input->post('judul');
      $data['kategori']=$this->input->post('kategori');
      $data['tahun']=$this->input->post('tahun');
      $data['no']=$this->input->post('nomor');
      $data['terkait']=$this->input->post('terkait');
      $data['dok']=$file['upload_data']['file_name'];
      //$judul= $this->input->post('judul');
      //$image= $data['upload_data']['file_name']; 
      //$result=$this->m_peraturan->simpan($data);
      //$result['pesan']=$data; 
      
      if($this->m_peraturan->simpan($data)){
        $result['status']=1;
        $result['pesan']="Berhasil menambahkan";
      }else{
        $result['status']=0;
        $result['pesan']="Gagal menambahkan";
      }
      echo json_encode($result);
    }else{
      //$result['pesan']="gagal";
      $result['status']=0;
      $result['pesan']=$this->upload->display_errors($open="",$close="");//open close untu tag pada pesannya <p></p>
      echo json_encode($result);
    }
    
  }

  function hapus(){
    $id=$this->input->get('id');
    if (!isset($id)){ show_404();
    }else{
      $result=$this->m_peraturan->delete($id);
      echo json_encode($result);
    }   
  }

  function edit(){
    $config['upload_path']="./dok";
    $config['allowed_types']='pdf|doc|docx|rar';
    $this->load->library('upload',$config);
    if (!empty($_FILES["fileuploadd"]["name"])) {
      $result['pesan']="berhasil";
      $result['err']="b";
      echo json_encode($result);
    }else{
      $result['pesan']="gagal";
      $result['err']="a";
      echo json_encode($result);
    }
    /*if($this->upload->do_upload('berkas')){
      $file = array('upload_data' => $this->upload->data());
      $data['judul']=$this->input->post('judull');
      $data['kategori']=$this->input->post('kategorii');
      $data['tahun']=$this->input->post('tahunn');
      $data['no']=$this->input->post('nomorr');
      $data['terkait']=$this->input->post('terkaitt');
      $data['dok']=$file['upload_data']['file_name'];
      
      echo json_encode($result);
    }else{
      $result['pesan']="gagal";
      $result['err']=$this->upload->display_errors($open="",$close="");//open close untu tag pada pesannya <p></p>
      echo json_encode($result);
    }*/

  }
}
