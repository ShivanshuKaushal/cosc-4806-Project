<?php
require_once 'app/Database.php';

class Review {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function addReview($name, $email, $movie_id, $review, $stars) {
        $stmt = $this->pdo->prepare("INSERT INTO review (name, email, movie_id, review, stars) VALUES (:name, :email, :movie_id, :review, :stars)");
        return $stmt->execute(['name' => $name, 'email' => $email, 'movie_id' => $movie_id, 'review' => $review, 'stars' => $stars]);
    }

    public function getReviews($movie_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM review WHERE movie_id = :movie_id ORDER BY created_at DESC");
        $stmt->execute(['movie_id' => $movie_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
