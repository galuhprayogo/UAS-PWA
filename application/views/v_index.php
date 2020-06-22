<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php 
      $jumlah = $slider->num_rows();
      for ($i=0; $i < $jumlah; $i++) { 
        ?>
        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" 
          <?php  if ($i == 0) { echo 'class="active"'; } ?> ></li>
          <?php
        }
        ?>
      </ol>
      <div class="carousel-inner" role="listbox">
        <?php 
        $no = 0;
        foreach ($slider->result() as $key): ?>
          <div class="carousel-item <?php  if ($no == 0) { echo 'active'; } ?>" style="background-image: url('assets/img/<?= $key->gambar ?>')">
            <div class="carousel-caption d-none d-md-block">
              <h3><?= $key->nama ?></h3>
              <p><?= $key->deskripsi ?></p>
            </div>
          </div>
          <?php $no++; ?>
        <?php endforeach ?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>
  <div class="container">
    <h1 class="my-4" style="text-align: center;">Selamat Datang Di <?= $this->config->item('judul_web'); ?></h1>
    <?php foreach ($kategori->result() as $key): ?>
      <?php 
      $query = $this->db->order_by('tanggal', 'desc');
      $query = $this->db->where('id_kategori', $key->id);        
      $query = $this->db->get('konten', 4, 0);
      ?>
      <h2>Hewan <?= $key->nama ?></h2>
      <div class="row">
        <?php foreach ($query->result() as $konten): ?>
          <div class="col-lg-3 col-sm-6 animal-item">
            <div class="card h-100">
              <a href="<?= site_url('welcome/detail_hewan/'.$konten->id) ?>"><img class="card-img-top" src="<?= base_url() ?>assets/img/<?= $konten->gambar ?>" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="<?= site_url('welcome/detail_hewan/'.$konten->id) ?>"><?= $konten->nama ?></a>
                </h4>
                <p class="card-text"><?= substr($konten->deskripsi,0, 200) ?></p>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    <?php endforeach ?>
    <hr>
  </div>