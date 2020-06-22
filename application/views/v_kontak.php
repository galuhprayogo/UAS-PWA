<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <h1 class="mt-4 mb-3">Kontak</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?= site_url('') ?>">Beranda</a>
    </li>
    <li class="breadcrumb-item active">Kontak</li>
  </ol>
  <div class="row">

    <div class="col-lg-8 mb-4">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.9724760243907!2d110.40616631437659!3d-7.792738779498928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59e18b1c28d1%3A0xe2d750662f2edace!2sSTMIK%20AKAKOM%20Yogyakarta!5e0!3m2!1sen!2sid!4v1584625348603!5m2!1sen!2sid" width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>

    <div class="col-lg-4 mb-4">
      <h3>Detail Alamat Kontak</h3>
      <p>
        Banguntapan
        <br>Yogyakarta
        <br>
      </p>
      <p>
        <abbr title="Phone">Telepon</abbr>: (123) 456-7890
      </p>
      <p>
        <abbr title="Email">Email</abbr>:
        <a href="mailto:name@example.com">contoh@gmail.com
        </a>
      </p>
    </div>
  </div>
  <div class="col-lg-8 mb-4">
  <?= $this->session->flashdata('pesan'); ?>
    <?php if ($this->session->flashdata('cek_error') == true) { ?>
      <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?> </div>
    <?php } ?>
  </div>
  <div class="row">
    <div class="col-lg-8 mb-4">
      <h3>Beri Tanggapan</h3>
      <form id="contactForm" action="<?= site_url('welcome/send_kontak') ?>" method="POST">
        <div class="control-group form-group">
          <div class="controls">
            <label>Nama Lengkap:</label>
            <input type="text" class="form-control" name="nama" required value="<?= $this->session->flashdata('nama') ?>">
            <p class="help-block"></p>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Alamat E-mail:</label>
            <input type="email" class="form-control" name="email" required value="<?= $this->session->flashdata('email') ?>">
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Pesan:</label>
            <textarea rows="10" cols="100" class="form-control" name="deskripsi" maxlength="999" style="resize:none"><?= $this->session->flashdata('deskripsi') ?></textarea>
          </div>
        </div>
        <div id="success"></div>
        <button type="submit" class="btn btn-primary" id="sendMessageButton">Kirim</button>
      </form>
    </div>
  </div>
</div>