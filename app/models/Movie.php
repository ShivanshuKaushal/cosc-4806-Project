<?php
class Movie {
    public function getMovieByTitle($title) {
        $url = OMDB_API_URL . '?apikey=' . OMDB_API_KEY . '&t=' . urlencode($title);
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}
?>
