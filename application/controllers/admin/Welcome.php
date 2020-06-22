<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') ==  "Sudah_Loggin") {
			redirect('admin/home','refresh');
		}
	}

	var $table = 'admin';

	public function index()
	{
		$data['judul'] = "Login";
		return $this->load->view('admin/v_login', $data);
	}

	public function proses($value='')
	{
		$this->validation();

		$query = $this->db->get_where($this->table, array('username' => $this->input->post('username')));
		if ($query->num_rows() < 1 ) {
			$this->send_error('Username / Password Salah');
			redirect('admin/welcome');
			exit(0);
		}

		$hasil = $query->row();
		if (password_verify($this->input->post('password'), $hasil->password)) {
			$this->clear_session();
			foreach ($query->result() as $key ) {
				$sess_data['admin_logged_in'] = "Sudah_Loggin";
				$sess_data['nama'] = $key->nama;
				$sess_data['id_admin'] = $key->id;
				$sess_data['username'] = $key->username;
				$this->session->set_userdata($sess_data);
				redirect('admin/home');
				exit(0);
			}
		}

		$this->send_error('Username / Password Salah');
		redirect('admin/welcome');
		exit(0);
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

	private function validation($value='')
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->send_error(validation_errors());
			redirect('admin/welcome');
			exit(0);
		}
	}

	private function send_error($send_error='')
	{
		$this->session->set_flashdata('error', $send_error);
		$this->session->set_flashdata('username', set_value('username') );
		$this->session->set_flashdata('password', set_value('password') );
		$this->session->set_flashdata('cek_error', true);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/admin/welcome.php */