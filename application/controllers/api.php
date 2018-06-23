<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class api extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('pengguna');
	}
	
	function index_get()
	{
		$id = $this->get('id');
		$tampil = $this->pengguna->tampil();

		if(!$id)
		{
			$this->response($tampil, 200);
		}
		else
		{
			$pilih = $this->pengguna->pilih($id);
			if($pilih)
			{
				$this->response($pilih, 200);
			}
			else
			{
				$this->response(array('Status' => 'ID Tidak Terdaftar'), 404);
			}
		}
	}

	function index_post()
	{
		$data = array('nama' => $this->post('nama'),
					  'username' => $this->post('username'),
					  'sandi' => $this->post('sandi'));
		if(!$data)
		{
			$this->response(array('Status' => 'Masukan Data Untuk Disimpan.'), 400);
		}
		else
		{
			$tambah = $this->pengguna->tambah($data);
			if($tambah)
			{
				$this->response(array('Status' => 'Berhasil Menyimpan Data.'));
			}
			else
			{
				$this->response(array('Status' => 'Data Tidak Dapat Disimpan, Cobalah Lagi.'), 404);
			}
		}
	}

	function index_put()
	{
		$id = $this->put('id');
		$data = array('nama' => $this->put('nama'),
					  'username' => $this->put('username'),
					  'sandi' => $this->put('sandi'));
		if(!$id)
		{
			$this->response(array('Status' => 'Masukan ID yang Akan Diubah.'), 400);
		}
		else
		{
			$pilih = $this->pengguna->pilih($id);
			if($pilih)
			{
				if(!$data)
				{
					$this->response(array('Status' => 'Masukan Data Untuk Disimpan.'), 400);
				}
				else
				{
					$ubah = $this->pengguna->ubah($id,$data);
					if($ubah)
					{
						$this->response(array('Status' => 'Berhasil Mengubah Data.'));
					}
					else
					{
						$this->response(array('Status' => 'Data Tidak Dapat Disimpan, Cobalah Lagi.'), 404);
					}
				}
			}
			else
			{
				$this->response(array('Status' => 'ID Tidak Terdaftar.'), 400);
			}
		}
	}

	function index_delete()
	{
		$id = $this->delete('id');
		if(!$id)
		{
			$this->response(array('Status' => 'Masukan ID yang Akan Dihapus.'), 400);
		}
		else
		{
			$pilih = $this->pengguna->pilih($id);
			if($pilih)
			{
				$hapus = $this->pengguna->hapus($id);
				if($hapus)
				{
					$this->response(array('Status' => 'Berhasil Menghapus Data.'));
				}
				else
				{
					$this->response(array('Status' => 'Gagal Menghapus Data.'), 404);
				}
			}
			else
			{
				$this->response(array('Status' => 'ID Tidak Terdaftar.'), 400);
			}
		}
	}
}
?>