<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tanggapan extends CI_Model {

	var $table = 'tanggapan';

	public function json() {
		$this->datatables->select("id, nama, email, pesan, tanggal ");
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" ><i class="fa fa-trash"></i></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_tanggapan.php */
/* Location: ./application/models/admin/M_tanggapan.php */