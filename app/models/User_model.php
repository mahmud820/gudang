<?php
class User_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getUserByUsername($username) {
        $this->db->query("SELECT * FROM user WHERE username = :username"); // sesuaikan dengan nama tabel: `user`
        $this->db->bind(':username', $username);
        return $this->db->single();
    }
}
