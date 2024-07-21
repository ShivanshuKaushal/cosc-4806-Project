<?php include 'app/views/templates/header.php'; ?>
    <div class="container">
        <h1>Search Movie</h1>
        <form method="GET" action="index.php">
            <input type="hidden" name="url" value="movie/search">
            <input type="text" name="search" placeholder="Enter movie title" required>
            <button type="submit">Search</button>
        </form>
    </div>
<?php include 'app/views/templates/footer.php'; ?>