<?php 

class M_daftar extends CI_Model{
	public function __construct() {
	    parent::__construct(); 
  	}
  	
	public function getAllData($rowno,$rowperpage) {
	 
	    $this->db->select('*');
	    $this->db->from('file');
	     $this->db->order_by('tahun', 'ASC');
	    $this->db->limit($rowperpage, $rowno);  
	    $query = $this->db->get();
	 
	    return $query->result_array();
	}

	  // Select total records
	public function getrecordCount() {
		$this->db->select('count(*) as allcount');
	    $this->db->from('file');
	    $query = $this->db->get();
	    $result = $query->result_array();
	 
	    return $result[0]['allcount'];
	}

	function get_kategori(){
		$hasil=$this->db->query("SELECT * FROM kategori");
		return $hasil;
	}

	function get_tahun(){
		$hasil=$this->db->query("SELECT DISTINCT tahun FROM file ORDER BY tahun ASC");
		return $hasil;
	}

	function get_fileterkait($kaitan,$id){
		$this->db->select('*');
		$this->db->from('file');
		$this->db->where('terkait',$kaitan);
		$this->db->where('id_file !=',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
}