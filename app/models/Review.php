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

    public function generateAIReview($movieTitle) {
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=" . $_ENV['GOOGLE_API_KEY'];

        $data = array(
            "contents" => array(
                array(
                    "role" => "user",
                    "parts" => array(
                        array(
                            "text" => "Please give a review of the movie " . $movieTitle . " with an average rating of 4 out of 5."
                        )
                    )
                )
            )
        );

        $json_data = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            error_log('Curl error: ' . $curlError);
            return false;
        }

        $responseData = json_decode($response, true);
        if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            return $responseData['candidates'][0]['content']['parts'][0]['text'];
        } else {
            return false;
        }
    }
}
?>
