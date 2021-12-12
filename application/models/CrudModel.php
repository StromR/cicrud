<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CrudModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function jumlah_data()
	{
		return $this->db->count_all('mahasiswa');
	}

	public function read()
	{
		return $this->db->get('mahasiswa')->result();
	}

	public function save()
	{

		$data['nim'] =$this->input->post('nim');
		$data['nama'] =$this->input->post('nama');
		$data['kelas'] =$this->input->post('kelas');
		$data['jurusan'] =$this->input->post('jurusan');

		return $this->db->insert('mahasiswa', $data);
	}

	public function edit($id)
	{
		return $this->db->get_where('mahasiswa', array('id' => $id))->row();
	}

	public function update()
	{
		$data['nim'] =$this->input->post('nim');
		$data['nama'] =$this->input->post('nama');
		$data['kelas'] =$this->input->post('kelas');
		$data['jurusan'] =$this->input->post('jurusan');

		return $this->db->where('id', $this->input->post('id'))
					->update('mahasiswa', $data);
	}

	public function delete($id)
	{
		return $this->db->delete('mahasiswa', array('id' => $id));
	}



}