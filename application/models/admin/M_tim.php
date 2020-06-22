<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tim extends CI_Model {

	var $table = 'tim';

	public function json() {
		$this->datatables->select("id, nama, gambar, posisi, deskripsi, email");
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"><i class="fa fa-edit"></i></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" ><i class="fa fa-trash"></i></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_tim.php */
/* Location: ./application/models/admin/M_tim.php */