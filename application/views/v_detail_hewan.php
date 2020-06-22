<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <h1 class="mt-4 mb-3"><?= $row->nama ?></h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?= site_url() ?>">Beranda</a>
    </li>
    <li class="breadcrumb-item active">Detail Hewan</li>
  </ol>
  <div class="row">
    <div class="col-lg-8">
      <img class="img-fluid rounded" src="<?= base_url() ?>assets/img/<?= $row->gambar ?>" alt="">
      <hr>
      <p>Di Posting Pada <?= tgl_ind($row->tanggal) ?></p>
      <hr>
      <p class="lead">
        <?= $row->deskripsi ?>
      </p>
      <hr>      
      <?= $this->session->flashdata('pesan'); ?>
      <?php if ($this->session->flashdata('cek_error') == true) { ?>
        <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?> </div>
      <?php } ?>
      <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
          <form action="<?= base_url('welcome/send_komentar/'.$row->id) ?>" method="POST">
            <div class="form-group">
              <input type="text" name="nama" placeholder="Nama Anda" class="form-control" value="<?= $this->session->flashdata('nama') ?>">
              <br>
              <textarea class="form-control" rows="3" name="deskripsi"><?= $this->session->flashdata('deskripsi') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <?php foreach ($komentar->result() as $key): ?>
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0"><?= $key->nama ?></h5>
            <?= $key->deskripsi ?>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    <div class="col-md-4">
      <div class="card mb-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
          <form action="<?= site_url('welcome/send_cari') ?>" method="POST">
            <div class="input-group">
              <input type="text" class="form-control" name="cari" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </span>
            </div>
          </form>
        </div>
      </div>
      <div class="card my-4">
        <h5 class="card-header">Kategori</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <?php foreach ($kategori->result() as $key): ?>
                  <li>
                    <a href="<?= site_url('welcome/kategori/'.$key->id)?>"><?= $key->nama ?></a>
                  </li>
                <?php endforeach ?>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>