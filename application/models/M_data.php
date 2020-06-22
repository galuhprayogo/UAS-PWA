<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->output->set_header('X-FRAME-OPTIONS: DENY');
		// Prevent some security threats, per Kevin
		// Turn on IE8-IE9 XSS prevention tools
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
		// Don't allow any pages to be framed - Defends against CSRF
		$this->output->set_header('X-Frame-Options: DENY');
		// prevent mime based attacks
		$this->output->set_header('X-Content-Type-Options: nosniff');
	}

	public function sql_data($table='',$where='', $object='')
	{
    // tambah
		$this->db->insert($table, $object);

    // update
		$this->db->update($table, $object, $where);

    // delete
		$query = $this->db->where($object);
		$query = $this->db->delete($table);
	}

	public function kategori($value='')
	{
		$this->db->order_by('nama', 'asc');
		return $this->db->get('kategori');
	}

}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */