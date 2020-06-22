<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['kategori'] = $this->Global->kategori();
		$data['slider'] = $this->db->get('slider');
		$this->load->view('temp_header');
		$this->load->view('v_index',$data);
		$this->load->view('temp_footer');
	}

	public function kategori($id='',$offset=0)
	{
		$query = $this->db->get_where('kategori', array('id' => $id, ));
		if ($query->num_rows() == 0) {
			redirect('welcome','refresh');
			exit(0);
		}
		$data['row'] = $query->row();

		$jml = $this->db->where('id_kategori', $id);
		$jml = $this->db->get('konten');
		$this->load->library('pagination');
		$config['base_url'] = base_url('').'welcome/kategori/'.$id.'/';
		$config['total_rows'] = $jml->num_rows();
		$config['per_page'] = 6;
		$config['uri_segment'] = 4;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
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
		$data['halaman'] 	= $this->pagination->create_links();
		$data['offset'] 	= $offset;

		$query = $this->db->where('id_kategori', $id);
		$query = $this->db->order_by('tanggal', 'desc');
		$query = $this->db->get('konten', $config['per_page'], $offset);
		$data['konten'] = $query;

		$this->load->view('temp_header');
		$this->load->view('v_kategori',$data);
		$this->load->view('temp_footer');
	}

	public function send_cari($value='')
	{
		if ($this->input->post('cari') == '') {
			redirect('welcome','refresh');
			exit(0);
		}

		$array = array(
			'keyword' => $this->input->post('cari')
		);
		
		$this->session->set_userdata( $array );
		redirect('welcome/cari');
	}

	public function cari($offset=0)
	{
		$keyword = $this->session->userdata('keyword');
		$query_cari = $this->db->like('nama',$keyword);
		$query_cari = $this->db->or_like('deskripsi',$keyword);
		$query_cari = $this->db->get('konten');
		$data['konten'] = $query_cari;
		$data['keyword'] = $keyword;

		$jml = $query_cari;
		$this->load->library('pagination');
		$config['base_url'] = base_url('').'welcome/cari/';
		$config['total_rows'] = $jml->num_rows();
		$config['per_page'] = 6;
		$config['uri_segment'] = 3;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
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
		$data['halaman'] 	= $this->pagination->create_links();
		$data['offset'] 	= $offset;

		$query = $this->db->like('nama',$keyword);
		$query = $this->db->or_like('deskripsi',$keyword);
		$query = $this->db->get('konten', $config['per_page'], $offset);
		$data['konten'] = $query;


		$this->load->view('temp_header');
		$this->load->view('v_cari',$data);
		$this->load->view('temp_footer');

	}

	public function detail_hewan($id='')
	{
		$query = $this->db->get_where('konten', array('id' => $id, ));
		if ($query->num_rows() == 0) {
			redirect('welcome','refresh');
			exit(0);
		}
		$data['row'] = $query->row();

		$query = $this->db->order_by('id', 'desc');
		$query = $this->db->where('id_konten', $id);
		$query =  $this->db->get('komentar', 4, 0);
		$data['komentar'] = $query;

		$data['kategori'] = $this->Global->kategori();

		$this->load->view('temp_header');
		$this->load->view('v_detail_hewan',$data);
		$this->load->view('temp_footer');
	}

	public function send_komentar($id_konten='')
	{
		$query = $this->db->get_where('konten', array('id' => $id_konten, ));
		if ($query->num_rows() == 0) {
			redirect('welcome','refresh');
			exit(0);
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('deskripsi','Deskripsi','required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->send_error(validation_errors());
			redirect('welcome/detail_hewan/'.$id_konten);
			exit(0);
		}

		$object = array(
			'id_konten' => $id_konten, 
			'nama' => $this->input->post('nama'),
			'deskripsi' => $this->input->post('deskripsi'),
			'tanggal' => date('Y-m-d'),
		);
		$this->db->insert('komentar', $object);
		redirect('welcome/detail_hewan/'.$id_konten);
	}

	public function kontak($value='')
	{
		$this->load->view('temp_header');
		$this->load->view('v_kontak');
		$this->load->view('temp_footer');
	}

	public function send_kontak($value='')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('deskripsi','Pesan','required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->send_error(validation_errors());
			redirect('welcome/kontak');
			exit(0);
		}

		$object = array(
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'pesan' => $this->input->post('deskripsi'),
			'tanggal' => date('Y-m-d'),
		);
		$this->db->insert('tanggapan', $object);
		$this->session->set_flashdata('pesan', ' <div class="alert alert-success" role="alert"> Tanggapan Anda Telah di Proses </div>');
		redirect('welcome/kontak');
	}

	public function tentang_kami($value='')
	{
		$data['tim'] = $this->db->get('tim', 4, 0);
		$this->load->view('temp_header');
		$this->load->view('v_tentang_kami',$data);
		$this->load->view('temp_footer');
	}

	private function send_error($send_error='')
	{
		$this->session->set_flashdata('error', $send_error);
		$this->session->set_flashdata('nama', set_value('nama') );
		$this->session->set_flashdata('deskripsi', set_value('deskripsi') );
		$this->session->set_flashdata('email', set_value('email') );
		$this->session->set_flashdata('cek_error', true);
	}
}
