<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MahasiswaModel');
	}

	public function index()
	{
		$data['jumlah_data'] = $this->MahasiswaModel->jumlah_data();
		$data['mahasiswa'] = $this->MahasiswaModel->read();
		$this->load->view('templates/header');
		$this->load->view('mahasiswa/read', $data);
		$this->load->view('templates/footer');
	}
	
	public function pagination()
	{
		// Pengaturan Pagination
        $config['base_url'] 		= base_url('mahasiswa/pagination'); //base url
        $config['total_rows'] 		= $this->MahasiswaModel->jumlah_data(); //total row
        $config['per_page'] 		= 5;  // show record per halaman
        $config["uri_segment"] 		= 3;  // uri parameter
        $config["num_links"] 		= floor($config["total_rows"] / $config["per_page"]);
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-end">';
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
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // Ambil data dari model MahasiswaModel
        $data['mahasiswa'] = $this->MahasiswaModel->lists($config["per_page"], $data['page']);           
        $data['pagination'] = $this->pagination->create_links();
		$start = $this->pagination->cur_page * $this->pagination->per_page;
        $end = $start + $this->pagination->per_page;
		
		// Hitung Data
		$data['jumlah_data'] = $this->MahasiswaModel->jumlah_data();
		$data['page_start'] = $start;
        $data['page_end']= $end;
		
		$this->load->view('mahasiswa/pagination', $data);
	}

	public function create()
	{
		$this->load->view('mahasiswa/create');
	}

	public function save()
	{
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required',array('required' => 'Please enter a nim'));
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required',array('required' => 'Please enter a name'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required',array('required' => 'Please select a email'));
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required',array('required' => 'Please select a jurusan'));

		if ($this->form_validation->run() == FALSE)
        {
        	$page_data['errors'] = validation_errors();
        	$this->create();
        }else{
			
			// Script untuk upload gambar
			$config['upload_path'] = './assets/images';
			$config['allowed_types'] = 'jpg|png|jpeg|webp';
			$config['max_size'] = '2048';
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('foto')){ 
				$this->session->set_userdata('upload_error', $this->upload->display_errors());
				$this->create();
			}else{
				
				// Hapus session upload error_get_last
				$this->session->unset_userdata('upload_error');
				
				// Ambil data foto yang di upload
				$upload = $this->upload->data();
				
				$data = array(
					'nim' => $this->input->post('nim'),
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'jurusan' => $this->input->post('jurusan'),
					'foto' => $upload['file_name']
				);
				$this->MahasiswaModel->save($data);
				redirect('mahasiswa','refresh');
			}   
        }
	}

	public function edit($id)
	{
		$data['row']= $this->MahasiswaModel->edit($id);
		$this->load->view('mahasiswa/edit', $data);
	}

	public function update()
	{
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required',array('required' => 'Please enter a nim'));
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required',array('required' => 'Please enter a name'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required',array('required' => 'Please select a email'));
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required',array('required' => 'Please select a jurusan'));

		$id = $this->input->post("id");
		$foto = $this->input->post("foto_old");
		
		if ($this->form_validation->run() == FALSE)
        {
        	$page_data['errors'] = validation_errors();
        	$this->edit($id);
        }else{
			
			// Script untuk upload gambar
			$config['upload_path'] = './assets/images';
			$config['allowed_types'] = 'jpg';
			$config['max_size'] = '2048';
			$this->upload->initialize($config);
			
			// Check jika foto diganti
			if (!empty($_FILES['foto']['name'])) {
				if(!$this->upload->do_upload('foto')){ 
					$this->session->set_userdata('upload_error', $this->upload->display_errors());
					$this->edit($id);
				}else{
					// Hapus session upload error_get_last
					$this->session->unset_userdata('upload_error');
					
					// Hapus gambar yang lama
					if(file_exists("assets/images/$foto") && $foto)
					{
						unlink("assets/images/$foto");
					}
		
					// Ambil data foto yang di upload
					$upload = $this->upload->data();
					$foto = $upload['file_name'];
				}
			}				
			
			$data = array(
				'nim' => $this->input->post('nim'),
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'jurusan' => $this->input->post('jurusan'),
				'foto' => $foto
			);
			
        	$this->MahasiswaModel->update($id, $data);
        	redirect('mahasiswa','refresh');
        }
	}

	public function delete($id)
	{
		$row = $this->MahasiswaModel->edit($id);
		// Hapus gambar yang lama
		if(file_exists("assets/images/$row->foto") && $row->foto)
		{
			unlink("assets/images/$row->foto");
		}
					
		$this->MahasiswaModel->delete($id);
		redirect('mahasiswa','refresh');
	}
}
