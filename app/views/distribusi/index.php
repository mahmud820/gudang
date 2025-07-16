<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="main-content">
        <h2 class="mb-3">Daftar Distribusi Motor</h2>
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary mb-3 tombolTambahDistribusi" data-bs-toggle="modal" data-bs-target="#formModal">Tambah Data</button>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Motor</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Dealer</th>
                                <th>Tanggal Kirim</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <?php $no = 1; ?>
                            <?php foreach ($data['distribusi'] as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($d['nama_motor']); ?></td>
                                    <td><?= htmlspecialchars($d['jumlah']); ?></td>
                                    <td><?= htmlspecialchars($d['tujuan']); ?></td>
                                    <td><?= htmlspecialchars($d['tanggal_kirim']); ?></td>
                                    <td><?= htmlspecialchars($d['status']); ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="<?= htmlspecialchars(BASEURL, ENT_QUOTES, 'UTF-8'); ?>/distribusi/ubah/<?= $d['id_distribusi']; ?>" class="btn btn-warning btn-sm tampilModalUbahDistribusi" data-id="<?= $d['id_distribusi']; ?>" data-bs-toggle="modal" data-bs-target="#formModal">Ubah</a>
                                            <a href="<?= htmlspecialchars(BASEURL, ENT_QUOTES, 'UTF-8'); ?>/distribusi/hapus/<?= $d['id_distribusi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('yakin!');">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?> -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <a href="<?= htmlspecialchars(BASEURL, ENT_QUOTES, 'UTF-8'); ?>/dashboard" class="btn btn-primary">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Ubah Data -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="formModalLabel">Tambah Data Distribusi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= htmlspecialchars(BASEURL, ENT_QUOTES, 'UTF-8'); ?>/distribusi/tambah" method="post">
            <input type="hidden" name="id_distribusi" id="id_distribusi">
            
            <div class="mb-3">
                <label for="id_barang" class="form-label">Pilih Motor</label>
                <select name="id_barang" id="id_barang" class="form-control" required>
                    <option value="">-- Pilih Motor --</option>
                    <?php foreach ($data['barang'] as $barang) : ?>
                        <option value="<?= $barang['id']; ?>"><?= htmlspecialchars($barang['nama_motor']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>

            <div class="mb-3">
                <label for="dealer" class="form-label">Dealer</label>
                <select name="dealer" id="dealer" class="form-control" required>
                    <option value="">-- Dealer --</option>
                    <option value="J">Jaya Mandiri</option>
                    <option value="H">Honda</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_kirim" class="form-label">Tanggal Kirim</label>
                <input type="date" class="form-control" id="tanggal_kirim" name="tanggal_kirim" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
        </form>
    </div>
  </div>
</div>
