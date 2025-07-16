<?php
class Supplier_model {
    private $table = 'supplier'; // Pastikan ini sesuai dengan nama tabel di database
    private $db;

    public function __construct() {
        $this->db = new Database(); // Pastikan class Database sudah ada dan berfungsi
    }

    public function getAllSuppliers() {
        $this->db->query("SELECT id_supplier, nama_supplier, no_telp, alamat FROM " . $this->table);
        return $this->db->resultSet();
    }
    
}
