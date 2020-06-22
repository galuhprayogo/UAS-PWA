<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <h1 class="mt-4 mb-3">Tentang Kami</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?= site_url('') ?>">Beranda</a>
    </li>
    <li class="breadcrumb-item active">Tentang Kami</li>
  </ol>
  <div class="row">
    <div class="col-lg-6">
      <img class="img-fluid rounded mb-4" src="<?= base_url() ?>assets/img/bg4.jpg" alt="">
    </div>
    <div class="col-lg-6">
      <h2>Tentang Animal Kingdom</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>
    </div>
  </div>
  <h2>Tim Kami</h2>
  <div class="row">
    <?php foreach ($tim->result() as $key): ?>
      <div class="col-lg-3 mb-4">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="<?= base_url() ?>assets/img/<?= $key->gambar ?>" alt="">
          <div class="card-body">
            <h4 class="card-title"><?= $key->nama ?></h4>
            <h6 class="card-subtitle mb-2 text-muted"><?= $key->posisi ?></h6>
            <p class="card-text"><?= $key->deskripsi ?></p>
          </div>
          <div class="card-footer">
            <a href="mailto:<?= $key->email ?>"><?= $key->email ?></a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>