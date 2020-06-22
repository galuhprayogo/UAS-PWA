<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Home
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
      <li class="active">Home</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Kategori</span>
            <span class="info-box-number"><?= $kategori ?></span>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-archive"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Konten</span>
            <span class="info-box-number"><?= $konten ?></span>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-commenting-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Komentar</span>
            <span class="info-box-number"><?= $komentar ?></span>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-rss"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Tanggapan</span>
            <span class="info-box-number"><?= $tanggapan ?></span>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#home').addClass('active treeview');
  });
</script>
