<?php

class Barang_model {
    private $table = "barang";
    private $db;

    public function __construct() {
        $this->db = new Database(); // Inisialisasi database
    }

    public function getAllBarang() {
        $query = "SELECT {$this->table}.*, supplier.nama_supplier, supplier.no_telp, supplier.alamat
                  FROM {$this->table} 
                  JOIN supplier ON {$this->table}.id_supplier = supplier.id_supplier";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    
    public function getBarangById($id) {
        $query = "SELECT {$this->table}.*, supplier.nama_supplier 
                  FROM {$this->table} 
                  JOIN supplier ON {$this->table}.id_supplier = supplier.id_supplier
                  WHERE {$this->table}.id = :id";
    
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function tambahDataBarang($data) {
        $query = "INSERT INTO {$this->table} (nama_motor, jumlah_motor, id_supplier, tanggal_masuk) 
                  VALUES (:nama_motor, :jumlah_motor, :id_supplier, :tanggal_masuk)";
    
        $this->db->query($query);
        $this->db->bind(':nama_motor', $data['nama_motor']);
        $this->db->bind(':jumlah_motor', $data['jumlah_motor']);
        $this->db->bind(':id_supplier', $data['id_supplier']);
        $this->db->bind(':tanggal_masuk', $data['tanggal_masuk']);
    
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataBarang($data) {
        $query = "UPDATE {$this->table} 
                  SET nama_motor = :nama_motor, 
                      jumlah_motor = :jumlah_motor, 
                      id_supplier = :id_supplier, 
                      tanggal_masuk = :tanggal_masuk 
                  WHERE id = :id";
    
        $this->db->query($query);
        $this->db->bind(':nama_motor', $data['nama_motor']);
        $this->db->bind(':jumlah_motor', $data['jumlah_motor']);
        $this->db->bind(':id_supplier', $data['id_supplier']); 
        $this->db->bind(':tanggal_masuk', $data['tanggal_masuk']);
        $this->db->bind(':id', $data['id']); 
    
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataBarang($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }
}
