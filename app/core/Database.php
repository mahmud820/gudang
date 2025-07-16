<?php

// Kelas Database untuk mengelola koneksi dan query database menggunakan PDO
class Database {
  // Konfigurasi database (diambil dari constant yang sudah didefinisikan sebelumnya)
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $name = DB_NAME;

  private $dbh;  // Database handler
  private $stmt; // Statement handler

  // Constructor untuk menghubungkan ke database saat objek Database dibuat
  public function __construct()
  {
      // Data Source Name (DSN) untuk koneksi ke MySQL menggunakan PDO
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name;

      // Opsi tambahan untuk meningkatkan kinerja dan menangani error dengan baik
      $option = [
        PDO::ATTR_PERSISTENT => true, // Menggunakan koneksi yang persisten
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Menampilkan error dalam bentuk Exception
      ];

      try {
        // Membuat koneksi ke database menggunakan PDO
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
      } catch(PDOException $e) {
          // Jika terjadi error dalam koneksi, tampilkan pesan error
          die($e->getMessage());
      }
  }

  // Method untuk menyiapkan query SQL
  public function query($query) {
    $this->stmt = $this->dbh->prepare($query);
  }

  // Method untuk binding parameter ke dalam query yang sudah disiapkan
  public function bind($param, $value, $type = null) {
    if (is_null($type)) {
        switch (true) {
          case is_int($value):
            $type = PDO::PARAM_INT; // Jika nilai berupa integer
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL; // Jika nilai berupa boolean
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL; // Jika nilai berupa NULL
            break;
          default:
            $type = PDO::PARAM_STR; // Defaultnya dianggap sebagai string
        }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  // Method untuk mengeksekusi query
  public function execute() {
    return $this->stmt->execute();
  }

  // Method untuk mengambil banyak data (result set) dalam bentuk array asosiatif
  public function resultSet() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Method untuk mengambil satu data saja dalam bentuk array asosiatif
  public function single() {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Method untuk menghitung jumlah baris yang terpengaruh oleh query
  public function rowCount() {
    return $this->stmt->rowCount();
  }

  // Method untuk mengambil informasi error terakhir dari PDO
  public function errorInfo() {
    return $this->stmt->errorInfo();
  }

  // Method untuk memulai transaksi database
  public function beginTransaction() {
    return $this->dbh->beginTransaction();
  }

  // Method untuk menyimpan transaksi jika berhasil
  public function commit() {
    return $this->dbh->commit();
  }

  // Method untuk membatalkan transaksi jika terjadi error
  public function rollback() {
    return $this->dbh->rollBack();
  }
}
