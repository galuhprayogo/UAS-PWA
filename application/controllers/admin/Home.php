<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Anda Belum Login </div>');
			redirect('admin/welcome');
		}
		
		$this->output->enable_profiler(ENVIRONMENT == 'development');
	}
	
	public function index()
	{
		$title = array('judul' => 'Home', );
		$data['kategori'] = $this->db->get('kategori')->num_rows();
		$data['konten'] = $this->db->get('konten')->num_rows();
		$data['komentar'] = $this->db->get('komentar')->num_rows();
		$data['tanggapan'] = $this->db->get('tanggapan')->num_rows();
		$this->load->view('admin/temp_header',$title);
		$this->load->view('admin/v_home',$data);
		$this->load->view('admin/temp_footer');
	}

	public function logout()
	{
		$this->clear_session();
		redirect('admin/welcome','refresh');
	}



	private function clear_session()
	{
		# code...
		$user_data = $this->session->all_userdata();

		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/admin/Home.php */