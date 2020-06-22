<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	var $table = 'kategori';
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Anda Belum Login </div>');
			redirect('admin/welcome');
		}
		$this->load->model('admin/M_kategori','Model');
	}
	
	public function index()
	{
		$this->load->view('admin/temp_header');
		$this->load->view('admin/v_kategori');
		$this->load->view('admin/temp_footer');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$this->_validate();
			$where  = array('nama' => $this->input->post('nama'));
			if ($this->db->get_where($this->table,$where)->num_rows() == 1) {
				$data = array();
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = 'Kategori Sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit(0);
			}

			$this->_validate();
			$object = array(
				'nama' => $this->input->post('nama'),
			);
			$this->db->insert($this->table,$object);
			echo json_encode(array("status" => TRUE));
		}
	}

	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
				$where = array('id' => $id);
				$this->db->get_where($this->table,$where)->row();
			// Delete
				$this->db->where($where);
				$this->db->delete($this->table);
				echo json_encode(array("status" => TRUE));
		}

	}

	//edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$data = $this->db->get_where($this->table,$where)->row();
			echo json_encode($data);
		}
	}

	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$this->_validate();
			$where  = array('id' => $this->input->post('id'));
			$query = $this->db->get_where($this->table,$where);
			$row = $query->row();
			$where_cari = array('nama' => $this->input->post('nama'));
			$cari = $this->db->get_where($this->table,$where_cari);

        	// jika email tidak di ganti
			if ($row->nama == $this->input->post('nama')) {
            # code...
				echo json_encode(array("status" => TRUE));
				exit(0);
			}

			// jika email di ganti ternyata duplikat
			if ($cari->num_rows() == 1) {
            # code...
				$data = array();
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = 'Kategori sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit(0);
			}
			$object = array(
				'nama' => $this->input->post('nama')
			);
			$this->db->update($this->table,$object, $where);
			echo json_encode(array("status" => TRUE));
			
		}

	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE; 

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Input is required';
			$data['status'] = FALSE;
		} 

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Kategori.php */
/* Location: ./application/controllers/admin/Kategori.php */