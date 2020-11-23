<?php 

class Crud extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('m_data');
                $this->load->helper('url');
	}

	function index(){
		$data['user'] = $this->m_data->tampil_data()->result();
		$data['calon'] = $this->m_data->calon()->result();
		$data['kab'] = $this->m_data->namakab()->result();
		$data['hasil_vote']=$this->m_data->vote()->result();
		foreach($data['hasil_vote'] as $hv){ 
			if(empty($temp[$hv->namakabupaten][$hv->namacaleg])){
				$data['suara'][$hv->namakabupaten][$hv->namacaleg]=$hv->jumlah;
			}else{
				$data['suara'][$hv->namakabupaten][$hv->namacaleg]=$data['suara'][$hv->namakabupaten][$hv->namacaleg]+$hv->jumlah;           
			}	
							
		}
		$this->load->view('v_tampil',$data);
	}
}