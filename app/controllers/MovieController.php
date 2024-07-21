<?php
class MovieController extends Controller {
    public function index() {
        $this->view('movie/search');
    }

    public function search() {
        $title = $_GET['search'] ?? '';
        $movieModel = $this->model('Movie');
        $movie = $movieModel->getMovieByTitle($title);
        $this->view('movie/show', ['movie' => $movie]);
    }
}
?>
