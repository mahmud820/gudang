<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data['judul']) ? $data['judul'] : 'Gudang'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>

<body>

    <!-- Wrapper -->
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="custom-sidebar" id="sidebar">
            <ul class="menu">
                <li class="nav-item"><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
                <li class="nav-item"><a href="<?= BASEURL; ?>/barang">Barang</a></li>
                <li class="nav-item"><a href="<?= BASEURL; ?>/supplier">Supplier</a></li>
                <li class="nav-item"><a href="<?= BASEURL; ?>/distribusi">Distribusi</a></li>
                <li class="nav-item"><a href="#">Toko</a></li>
                <li class="nav-item"><a href="<?= BASEURL; ?>/laporan">Laporan</a></li>
                <li class="nav-item"><a href="<?= BASEURL; ?>/about">About Me</a></li>
            </ul>
        </nav>
    </div>

    <!-- Konten Utama -->
    <div class="flex-grow-1">
        <!-- Navbar -->
        <nav class="custom-navbar d-flex align-items-center px-3" id="navbar">
            <div class="d-flex align-items-center">
                <button class="toggle-btn btn btn-outline-light btn-sm me-2" id="toggleSidebar">☰</button>
                <h4 class="navbar-title m-0 text-white">Gudang</h4>
            </div>
        </nav>

    </div>

    <!-- Konten -->
    <div class="content-wrapper p-4">