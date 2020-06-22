<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_komentar extends CI_Model {

	var $table = 'komentar';

	public function json() {
		$this->datatables->select("komentar.id, komentar.nama, komentar.deskripsi, konten.nama as nama_konten, komentar.tanggal");
		$this->datatables->from($this->table);
		$this->datatables->join('konten', 'komentar.id_konten = konten.id');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" ><i class="fa fa-trash"></i></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_komentar.php */
/* Location: ./application/models/admin/M_komentar.php */