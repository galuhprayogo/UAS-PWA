<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanggapan extends CI_Controller {

	var $table = 'tanggapan';
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Anda Belum Login </div>');
			redirect('admin/welcome');
		}
		$this->load->model('admin/M_tanggapan','Model');
	}
	
	public function index()
	{
		$this->load->view('admin/temp_header');
		$this->load->view('admin/v_tanggapan');
		$this->load->view('admin/temp_footer');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
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
}

/* End of file Tanggapan.php */
/* Location: ./application/controllers/admin/Tanggapan.php */