<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <h1 class="mt-4 mb-3"><?= $row->nama ?>
</h1>
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?= site_url() ?>">Beranda</a>
  </li>
  <li class="breadcrumb-item active"><?= $row->nama ?></li>
</ol>
<?php foreach ($konten->result() as $key): ?>
 <div class="row">
  <div class="col-md-7">
    <a href="#">
      <img class="img-fluid rounded mb-3 mb-md-0" src="<?= base_url() ?>assets/img/<?= $key->gambar ?>" alt="">
    </a>
  </div>
  <div class="col-md-5">
    <h3><?= $key->nama ?></h3>
    <p><?= $key->deskripsi ?></p>
    <a class="btn btn-primary" href="<?= site_url('welcome/detail_hewan/'.$key->id) ?>">Lihat Detail
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
  </div>
</div>
<hr>
<?php endforeach ?>
<?= $halaman; ?>
</div>