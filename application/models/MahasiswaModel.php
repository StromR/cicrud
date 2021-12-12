<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MahasiswaModel extends CI_Model {

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
	
	function lists($limit, $start){
        return $this->db->get('mahasiswa', $limit, $start)->result();
    }

	public function save($data)
	{

		return $this->db->insert('mahasiswa', $data);
	}

	public function edit($id)
	{
		return $this->db->get_where('mahasiswa', array('id' => $id))->row();
	}

	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update('mahasiswa', $data);
	}

	public function delete($id)
	{
		return $this->db->delete('mahasiswa', array('id' => $id));
	}



}