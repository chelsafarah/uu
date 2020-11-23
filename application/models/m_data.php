<?php 

class M_data extends CI_Model{
	function tampil_data(){
		$this->db->select('*');
		$this->db->from('saksi,kabupaten');
		$this->db->where('saksi.kabupatensaksi=kabupaten.idkabupaten');
		return $this->db->get();
	}

	function calon(){
		$hasil=$this->db->query("SELECT namacaleg FROM profil");
		return $hasil;
	}

	function namakab(){
		$hasil=$this->db->query("SELECT namakabupaten FROM kabupaten");
		return $hasil;
	}

	function vote(){
		$hasil=$this->db->query("SELECT hitung.jumlah,kabupaten.namakabupaten,profil.namacaleg FROM hitung,kabupaten,profil,saksi WHERE hitung.saksihitung=saksi.idsaksi and saksi.kabupatensaksi=kabupaten.idkabupaten and saksi.saksiuntuk=profil.idcaleg");
		return $hasil;
	}
}