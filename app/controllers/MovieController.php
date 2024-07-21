<?php

class MovieController extends Controller {
    private $reviewModel;

    public function __construct() {
        $this->reviewModel = $this->model('Review');
    }

    public function index() {
        $this->view('movie/search');
    }

    public function search() {
        $title = $_GET['search'] ?? '';
        $movieModel = $this->model('Movie');
        $movie = $movieModel->getMovieByTitle($title);
        $reviews = $this->reviewModel->getReviews($movie['imdbID']);
        $this->view('movie/show', ['movie' => $movie, 'reviews' => $reviews]);
    }

    public function addReview() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $movie_id = $_POST['movie_id'];
            $review_text = $_POST['review_text'];
            $stars = $_POST['stars'];

            if ($this->reviewModel->addReview($name, $email, $movie_id, $review_text, $stars)) {
                header('Location: index.php?url=movie/search&search=' . urlencode($_POST['movie_title']));
                exit();
            } else {
                echo 'Failed to add review. Please try again.';
            }
        }
    }
    public function generateAIReview() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $movie_title = $_POST['movie_title'];
            $aiReview = $this->reviewModel->generateAIReview($movie_title);

            if ($aiReview) {
                echo 'AI Review: ' . $aiReview;
            } else {
                echo 'Failed to generate AI review. Please try again.';
            }
        }
    }
}
?>
