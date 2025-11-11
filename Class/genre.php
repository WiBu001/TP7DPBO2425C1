<?php
require_once 'config/db.php';

class Genre {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // READ
    public function getAllGenres() {
        $stmt = $this->db->prepare("SELECT * FROM genres");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function createGenre($genre_name) {
        $stmt = $this->db->prepare("INSERT INTO genres (genre_name) VALUES (?)");
        return $stmt->execute([$genre_name]);
    }

    // UPDATE
    public function updateGenre($id, $genre_name) {
        $stmt = $this->db->prepare("UPDATE genres SET genre_name = ? WHERE id = ?");
        return $stmt->execute([$genre_name, $id]);
    }

    // DELETE
    public function deleteGenre($id) {
        $stmt = $this->db->prepare("DELETE FROM genres WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // GET BY ID
    public function getGenreById($id) {
        $stmt = $this->db->prepare("SELECT * FROM genres WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
