<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengguna extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function tampil()
	{	
		$this->db->select('id,nama,username,sandi');
		$this->db->from('pengguna');
		$this->db->order_by("id","asc");

		$kueri = $this->db->get();
		if($kueri->num_rows() > 0)
		{
			return $kueri->result_array();
		}
		else
		{
			return false;
		}
	}

	function pilih($id)
	{	
		$this->db->select('id,nama,username,sandi');
		$this->db->from('pengguna');
		$this->db->where('id',$id);

		$kueri = $this->db->get();
		if($kueri->num_rows() == 1)
		{
			return $kueri->result_array();
		}
		else
		{
			return false;
		}
	}

	function tambah($data)
	{
		$kueri = $this->db->insert('pengguna',$data);
		if($kueri)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function ubah($id,$data)
	{
		$this->db->where('id',$id);
		$kueri = $this->db->update('pengguna',$data);
		if($kueri)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function hapus($id)
	{
		$this->db->where('id',$id);
		$kueri = $this->db->delete('pengguna');
		if($kueri)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>