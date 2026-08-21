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

    <!-- Navbar -->
    <nav class="custom-navbar px-4 py-2">

        <div class="left-section">
            <button class="toggle-btn" id="toggleSidebar">
                ☰
            </button>

            <div class="brand">
                <img src="<?= BASEURL; ?>/img/logo.png" alt="Logo">
                <div>
                    <h5>MotoStock</h5>
                    <small>Warehouse Management</small>
                </div>
            </div>
        </div>

        <div class="center-section">

            <div class="search-box">
                <input type="text" placeholder="Cari barang...">
            </div>

        </div>

        <div class="right-section">

            <button class="icon-btn">
                🔔
            </button>

            <div class="date">
                <?= date('d M Y'); ?>
            </div>

            <div class="profile">
                <img src="<?= BASEURL; ?>/img/user.png">
                <span>Admin</span>
            </div>

        </div>

    </nav>