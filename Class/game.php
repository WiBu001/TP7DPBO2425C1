<?php
require_once 'config/db.php';

class Game {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // READ - ambil semua game dengan nama genre
    public function getAllGames() {
        $query = "SELECT g.*, ge.genre_name 
                  FROM games g 
                  LEFT JOIN genres ge ON g.genre_id = ge.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE - tambah game baru
    public function createGame($title, $price, $genre_id, $developer) {
        $stmt = $this->db->prepare(
            "INSERT INTO games (title, price, genre_id, developer) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$title, $price, $genre_id, $developer]);
    }

    // UPDATE - ubah game
    public function updateGame($id, $title, $price, $genre_id, $developer) {
        $stmt = $this->db->prepare(
            "UPDATE games SET title = ?, price = ?, genre_id = ?, developer = ? WHERE id = ?"
        );
        return $stmt->execute([$title, $price, $genre_id, $developer, $id]);
    }

    // DELETE - hapus game
    public function deleteGame($id) {
        $stmt = $this->db->prepare("DELETE FROM games WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // GET BY ID
    public function getGameById($id) {
        $stmt = $this->db->prepare("SELECT * FROM games WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
    