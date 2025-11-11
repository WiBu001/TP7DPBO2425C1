<?php
require_once 'config/db.php';

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // READ - ambil semua user
    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE - tambah user baru
    public function createUser($username, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, $password]);
    }

    // UPDATE - ubah data user
    public function updateUser($id, $username, $password = null) {
        if ($password !== null) {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
            return $stmt->execute([$username, $password, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET username = ? WHERE id = ?");
            return $stmt->execute([$username, $id]);
        }
    }

    // DELETE - hapus user
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // GET BY ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
