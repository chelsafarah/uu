<?php 

class M_peraturan extends CI_Model{
	public function __construct() {
	    parent::__construct(); 
  	}

	  // Fetch records
	public function getAllData($rowno,$rowperpage) {
	 
	    $this->db->select('*');
	    $this->db->from('file');
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

	function get_aturan_by_id($id){
       $hsl=$this->db->query("SELECT * FROM file WHERE id_file='$id'");
       if($hsl->num_rows()>0){
           foreach ($hsl->result() as $data) {
               $hasil=array(
                   'id' => $data->id_file,
                   'judul' => $data->judul,
                   'kategori' => $data->kategori,
                   'tahun' => $data->tahun,
                   'nomor' => $data->no,
                   'terkait' => $data->terkait
                   );
           }
       }
       return $hasil;
   	}

	function get_kategori(){
		$hasil=$this->db->query("SELECT * FROM kategori");
		return $hasil;
	}

	function get_terkait(){
		$hasil=$this->db->query("SELECT * FROM terkait");
		return $hasil;
	}

	function simpan($data){
		$x=array(
			'id_file' => "",
           	'judul' => $data['judul'],
           	'kategori' => $data['kategori'],
           	'tahun' => $data['tahun'],
           	'no' => $data['no'],
           	'terkait' => $data['terkait'],
           	'dokumen' => $data['dok']
			);
		$hasil=$this->db->insert('file',$x);
		return $hasil;
	}

	function delete($id){
		$data= $this->db->query("SELECT * FROM file WHERE id_file='$id'");
		$x=$data->row();
		$nama_file= $x->dokumen;
		unlink("./dok/$nama_file");
		return $this->db->query("DELETE FROM file WHERE id_file='$id'");
	}

}