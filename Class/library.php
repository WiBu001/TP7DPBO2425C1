<?php
require_once 'config/db.php';

class Library {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // READ - ambil semua library dengan join user & games
    public function getAllLibraries() {
        $query = "SELECT l.*, u.username, g.title 
                  FROM library l
                  LEFT JOIN users u ON l.user_id = u.id
                  LEFT JOIN games g ON l.game_id = g.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function createLibrary($user_id, $game_id, $acquired_date, $time_played) {
        $stmt = $this->db->prepare(
            "INSERT INTO library (user_id, game_id, acquired_date, time_played) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$user_id, $game_id, $acquired_date, $time_played]);
    }

    // UPDATE
    public function updateLibrary($id, $user_id, $game_id, $acquired_date, $time_played) {
        $stmt = $this->db->prepare(
            "UPDATE library SET user_id = ?, game_id = ?, acquired_date = ?, time_played = ? WHERE id = ?"
        );
        return $stmt->execute([$user_id, $game_id, $acquired_date, $time_played, $id]);
    }

    // DELETE
    public function deleteLibrary($id) {
        $stmt = $this->db->prepare("DELETE FROM library WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // GET BY ID
    public function getLibraryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM library WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
