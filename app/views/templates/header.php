<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data['judul']) ? $data['judul'] : 'Gudang'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="custom-navbar">
    <button class="toggle-btn">☰</button>
    <span>Gudang</span>
</nav>

<!-- Sidebar -->
<nav class="custom-sidebar">
    <ul class="menu">
        <li class="nav-item">
            <a href="<?= BASEURL; ?>/dashboard">Dashboard</a>
        </li>
        <li class="nav-item has-submenu">
            <a href="<?= BASEURL; ?>/barang">Barang</a>
        </li>
        <li class="nav-item">
            <a href="<?= BASEURL; ?>/supplier">Supplier</a>
        </li>
        <li class="nav-item">
            <a href="<?= BASEURL; ?>/distribusi">Distribusi</a>
        </li>
        <li class="nav-item">
            <a href="">Toko</a>
        </li>
        <li class="nav-item">
            <a href="<?= BASEURL; ?>/laporan">Laporan</a>
        </li>
        <li class="nav-item">
            <a href="<?= BASEURL; ?>/about">About Me</a>
        </li>
    </ul>
</nav>

<!-- Container untuk Konten -->
<div class="content-wrapper">
