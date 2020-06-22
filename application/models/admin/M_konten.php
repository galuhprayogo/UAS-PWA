<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_konten extends CI_Model {

	var $table = 'konten';

	public function json() {
		$this->datatables->select("konten.id, konten.nama,konten.tanggal,konten.gambar,konten.nama,kategori.nama as kategori");
		$this->datatables->from($this->table);
		$this->datatables->join('kategori', 'konten.id_kategori = kategori.id');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="'.site_url('admin/komentar/index/$1').'"><i class="fa fa-eye"></i> Komentar</a>

			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"><i class="fa fa-edit"></i></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" ><i class="fa fa-trash"></i></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_konten.php */
/* Location: ./application/models/admin/M_konten.php */