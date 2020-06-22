<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_slider extends CI_Model {

	var $table = 'slider';

	public function json() {
		$this->datatables->select("id, nama, gambar, deskripsi");
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"><i class="fa fa-edit"></i></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" ><i class="fa fa-trash"></i></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_slider.php */
/* Location: ./application/models/admin/M_slider.php */