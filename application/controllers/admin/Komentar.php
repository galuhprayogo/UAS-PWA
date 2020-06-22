<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komentar extends CI_Controller {

	var $table = 'komentar';
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Anda Belum Login </div>');
			redirect('admin/welcome');
		}
		$this->load->model('admin/M_komentar','Model');
	}
	
	public function index()
	{
		$this->load->view('admin/temp_header');
		$this->load->view('admin/v_komentar');
		$this->load->view('admin/temp_footer');
	}

	public function json() {
		// if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		// }
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

/* End of file Komentar.php */
/* Location: ./application/controllers/admin/Komentar.php */