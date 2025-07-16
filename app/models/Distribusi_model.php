<?php

class Distribusi_model {
    private $table = "distribusi";
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllDistribusi() {
        $query = "SELECT d.*, b.nama_motor 
                  FROM {$this->table} d
                  JOIN barang b ON d.id_barang = b.id";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getDistribusiById($id_distribusi) {
        $query = "SELECT * FROM {$this->table} WHERE id_distribusi = :id_distribusi";
        $this->db->query($query);
        $this->db->bind(":id_distribusi", $id_distribusi);
        return $this->db->single();
    }

    public function tambahDataDistribusi($data) {
        if (empty($data['id_barang']) || empty($data['jumlah']) || empty($data['tujuan']) || empty($data['tanggal_kirim']) || empty($data['status'])) {
            return false;
        }
    
        try {
            // Mulai transaksi
            $this->db->beginTransaction();
    
            // Ambil jumlah motor dari tabel barang
            $queryBarang = "SELECT jumlah_motor FROM barang WHERE id = :id_barang";
            $this->db->query($queryBarang);
            $this->db->bind(":id_barang", $data['id_barang']);
            $barang = $this->db->single();
    
            if (!$barang) {
                $this->db->rollback(); // Rollback jika barang tidak ditemukan
                return false;
            }
    
            // Periksa apakah stok mencukupi
            if ($barang['jumlah_motor'] < $data['jumlah']) { 
                $this->db->rollback(); // Rollback jika stok tidak cukup
                return -1;
            }
    
            // Kurangi jumlah motor di tabel barang
            $newJumlah = $barang['jumlah_motor'] - $data['jumlah'];
            $updateBarangQuery = "UPDATE barang SET jumlah_motor = :newJumlah WHERE id = :id_barang";
            $this->db->query($updateBarangQuery);
            $this->db->bind(":newJumlah", $newJumlah);
            $this->db->bind(":id_barang", $data['id_barang']);
    
            if (!$this->db->execute()) {
                $this->db->rollback(); // Rollback jika update gagal
                return false;
            }
    
            // Tambahkan data distribusi
            $query = "INSERT INTO distribusi (id_barang, jumlah, tujuan, tanggal_kirim, status) 
                      VALUES (:id_barang, :jumlah, :tujuan, :tanggal_kirim, :status)";
            $this->db->query($query);
            $this->db->bind(":id_barang", $data['id_barang']);
            $this->db->bind(":jumlah", $data['jumlah']);
            $this->db->bind(":tujuan", $data['tujuan']);
            $this->db->bind(":tanggal_kirim", $data['tanggal_kirim']);
            $this->db->bind(":status", $data['status']);
    
            if (!$this->db->execute()) {
                $this->db->rollback(); // Rollback jika insert gagal
                return false;
            }
    
            $this->db->commit(); // Commit jika semua query berhasil
            return $this->db->rowCount();
        } catch (Exception $e) {
            $this->db->rollback(); // Rollback jika terjadi error
            return false;
        }
    }
       
    public function ubahDataDistribusi($data) {
        // Ambil data distribusi lama
        $query = "SELECT id_barang, jumlah FROM {$this->table} WHERE id_distribusi = :id_distribusi";
        $this->db->query($query);
        $this->db->bind(":id_distribusi", $data['id_distribusi']);
        $oldDistribusi = $this->db->single();
    
        if (!$oldDistribusi) {
            return 0; // Jika data tidak ditemukan
        }
    
        $id_barang = $oldDistribusi['id_barang'];
        $jumlah_lama = $oldDistribusi['jumlah'];
        $jumlah_baru = $data['jumlah'];
    
        // Hitung selisih perubahan jumlah
        $selisih = $jumlah_baru - $jumlah_lama; // Bisa positif (menambah) atau negatif (mengurangi)
    
        // Cek stok hanya jika ada penambahan jumlah distribusi
        if ($selisih > 0) {
            // Ambil stok saat ini dari tabel barang
            $query = "SELECT jumlah_motor FROM barang WHERE id = :id_barang";
            $this->db->query($query);
            $this->db->bind(":id_barang", $id_barang);
            $stokBarang = $this->db->single();
    
            if (!$stokBarang || $stokBarang['jumlah_motor'] < $selisih) {
                return "Stok tidak mencukupi"; // Jika stok kurang, hentikan proses update
            }
        }
    
        // Update jumlah_motor di tabel barang
        $query = "UPDATE barang SET jumlah_motor = jumlah_motor - :selisih WHERE id = :id_barang";
        $this->db->query($query);
        $this->db->bind(":selisih", $selisih);
        $this->db->bind(":id_barang", $id_barang);
        $this->db->execute();
    
        // Update data distribusi
        $query = "UPDATE {$this->table} SET 
                  tujuan = :tujuan, 
                  tanggal_kirim = :tanggal_kirim, 
                  status = :status, 
                  jumlah = :jumlah 
                  WHERE id_distribusi = :id_distribusi";
    
        $this->db->query($query);
        $this->db->bind(":tujuan", $data['tujuan']);
        $this->db->bind(":tanggal_kirim", $data['tanggal_kirim']);
        $this->db->bind(":status", $data['status']);
        $this->db->bind(":jumlah", $jumlah_baru);
        $this->db->bind(":id_distribusi", $data['id_distribusi']);
    
        $this->db->execute();     
        return $this->db->rowCount();
    }
    
    public function hapusDataDistribusi($id_distribusi) {
        // 1. Ambil data distribusi sebelum dihapus
        $querySelect = "SELECT id_barang, jumlah FROM {$this->table} WHERE id_distribusi = :id_distribusi";
        $this->db->query($querySelect);
        $this->db->bind(":id_distribusi", $id_distribusi);
        $distribusi = $this->db->single();
    
        if (!$distribusi) {
            return 0; // Jika data distribusi tidak ditemukan
        }
    
        // 2. Kembalikan stok barang
        $queryUpdate = "UPDATE barang SET jumlah_motor = jumlah_motor + :jumlah WHERE id = :id_barang";
        $this->db->query($queryUpdate);
        $this->db->bind(":jumlah", $distribusi['jumlah']);
        $this->db->bind(":id_barang", $distribusi['id_barang']);
        $this->db->execute();
    
        // 3. Hapus data distribusi
        $queryDelete = "DELETE FROM {$this->table} WHERE id_distribusi = :id_distribusi";
        $this->db->query($queryDelete);
        $this->db->bind(":id_distribusi", $id_distribusi);
        $this->db->execute();
    
        return $this->db->rowCount();
    }
    
}
