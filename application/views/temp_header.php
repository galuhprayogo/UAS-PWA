<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?= $this->config->item('title_web'); ?></title>
  <link href="<?= base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= site_url('') ?>"><?= $this->config->item('judul_web'); ?></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('welcome/tentang_kami')?>">Tentang Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('welcome/kontak') ?>">Kontak</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Kategori
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <?php 
              $kategori = $this->db->order_by('nama', 'asc');
              $kategori = $this->db->get('kategori');
              ?>
              <?php foreach ($kategori->result() as $key): ?>
                <a class="dropdown-item" href="<?= site_url('welcome/kategori/'.$key->id)?>"><?= $key->nama ?></a>
              <?php endforeach ?>               
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>