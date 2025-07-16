<div class="container-fluid">
      <div class="main-content">
        <h2 class="mb-3">Daftar Motor dan Supplier</h2>
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary mb-3 tombolTambahBarang" data-bs-toggle="modal" data-bs-target="#formModal">Tambah Data</button>
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>NO</th>
                                <th>NAMA MOTOR</th>
                                <th>JUMLAH MOTOR</th>
                                <th>NAMA SUPPLIER</th>
                                <th>NO TELPON</th>
                                <th>ALAMAT</th>
                                <th>TANGGAL MASUK</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data['barang'] as $b) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($b['nama_motor']); ?></td>
                                    <td><?= htmlspecialchars($b['jumlah_motor']); ?></td>
                                    <td><?= htmlspecialchars($b['nama_supplier']); ?></td>
                                    <td><?= htmlspecialchars($b['no_telp']); ?></td>
                                    <td><?= htmlspecialchars($b['alamat']); ?></td>
                                    <td><?= htmlspecialchars($b['tanggal_masuk']); ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="<?= BASEURL; ?>/barang/ubah/<?= $b['id']; ?>" class="btn btn-warning btn-sm tampilModalUbahBarang" data-id="<?= $b['id']; ?>"  data-bs-toggle="modal" data-bs-target="#formModal">Ubah</a>
                                            <a href="<?= BASEURL; ?>/barang/hapus/<?= $b['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('yakin!');">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <a href="<?= BASEURL; ?>/dashboard" class="btn btn-primary">Kembali ke Halaman Utama</a
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
        <h1 class="modal-title fs-5" id="formModalLabel">Tambah Data Motor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/barang/tambah" method="post">
            <input type="hidden" name="id" id="id">
              <div class="mb-3">
                <label for="nama_motor" class="form-label">Nama Motor</label>
                <input type="text" class="form-control" id="nama_motor" name="nama_motor" required>
              </div>

              <div class="mb-3">
                <label for="jumlah_motor" class="form-label">Jumlah Motor</label>
                <input type="number" class="form-control" id="jumlah_motor" name="jumlah_motor" required>
              </div>
                
              <div class="mb-3">
              <label for="supplier">Pilih Supplier</label>
              <select name="id_supplier" id="supplier" class="form-control" required>
                    <option value="">-- Pilih Supplier --</option>
                    <?php foreach ($data['suppliers'] as $supplier) : ?>
                        <option value="<?= $supplier['id_supplier']; ?>"><?= $supplier['nama_supplier']; ?></option>
                    <?php endforeach; ?>
                </select>
               </div>

              <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
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
