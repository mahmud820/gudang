<div class="container mt-4">
    <div class="header">
        <h2>Data Supplier</h2>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th>NO</th>
                <th>NAMA SUPPLIER</th>
                <th>NO TELPON</th>
                <th>ALAMAT</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data['suppliers'] as $supplier) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($supplier['nama_supplier']); ?></td>
                    <td><?= htmlspecialchars($supplier['no_telp']); ?></td>
                    <td><?= htmlspecialchars($supplier['alamat']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-3">
        <a href="<?= BASEURL; ?>/dashboard" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </div>
</div>
