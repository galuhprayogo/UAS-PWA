<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

	var $table = 'slider';
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Anda Belum Login </div>');
			redirect('admin/welcome');
		}
		$this->load->model('admin/M_slider','Model');
	}
	
	public function index()
	{
		$this->load->view('admin/temp_header');
		$this->load->view('admin/v_slider');
		$this->load->view('admin/temp_footer');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	private function _do_upload()
	{
		$config['upload_path']   = 'assets/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
        	$data['inputerror'][] = 'gambar';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    public function tambah()
    {
    	if ($this->input->is_ajax_request()) {
    		$this->_validate();
    		if(empty($_FILES['gambar']['name'])){
    			$data['inputerror'][] = 'gambar';
    			$data['error_string'][] = 'Input is required';
    			$data['status'] = FALSE;
    		} 
    		$object = array(
    			'nama' => $this->input->post('nama'),
    			'deskripsi' => $this->input->post('deskripsi'),
    		);

    		if(!empty($_FILES['gambar']['name']))
    		{
    			$upload = $this->_do_upload();
    			$object['gambar'] = $upload;
    		}

    		$this->db->insert($this->table,$object);
    		echo json_encode(array("status" => TRUE));
    	}
    }

    public function hapus($id)
    {
    	if ($this->input->is_ajax_request()) {
    		$where = array('id' => $id);
    		$row = $this->db->get_where($this->table, $where)->row();
    		if(file_exists('assets/img/'.$row->gambar) && $row->gambar) {
    			unlink('assets/img/'.$row->gambar);
    		}
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
    		if ($query->num_rows() == 0) {
    			redirect('konten','refresh');
    			exit(0);
    		}

    		$object = array(
    			'nama' => $this->input->post('nama'),
    			'deskripsi' => $this->input->post('deskripsi'),
    		);

    		if(!empty($_FILES['gambar']['name']))
    		{
    			$upload = $this->_do_upload();
                            //hapus gambar lama di folder
    			$row = $this->db->get_where($this->table, $where)->row();
    			if(file_exists('assets/img/'.$row->gambar) && $row->gambar)
    				unlink('assets/img/'.$row->gambar);
    			$object['gambar'] = $upload;
    		}

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


    	if($this->input->post('deskripsi') == '')
    	{
    		$data['inputerror'][] = 'deskripsi';
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

/* End of file Slider.php */
/* Location: ./application/controllers/admin/Slider.php */