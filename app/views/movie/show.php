<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search Results</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Movie Search Results</h1>
        <a href="/movie/index">Back to Search</a>
        <?php if ($data['movie'] && isset($data['movie']['Title'])): ?>
            <div class="card">
                <h2><?php echo $data['movie']['Title']; ?></h2>
                <h4><?php echo $data['movie']['Year']; ?></h4>
                <ul>
                    <li><strong>Rated:</strong> <?php echo $data['movie']['Rated']; ?></li>
                    <li><strong>Released:</strong> <?php echo $data['movie']['Released']; ?></li>
                    <li><strong>Runtime:</strong> <?php echo $data['movie']['Runtime']; ?></li>
                    <li><strong>Genre:</strong> <?php echo $data['movie']['Genre']; ?></li>
                    <li><strong>Director:</strong> <?php echo $data['movie']['Director']; ?></li>
                    <li><strong>Writer:</strong> <?php echo $data['movie']['Writer']; ?></li>
                    <li><strong>Actors:</strong> <?php echo $data['movie']['Actors']; ?></li>
                    <li><strong>Plot:</strong> <?php echo $data['movie']['Plot']; ?></li>
                    <li><strong>Language:</strong> <?php echo $data['movie']['Language']; ?></li>
                    <li><strong>Country:</strong> <?php echo $data['movie']['Country']; ?></li>
                    <li><strong>Awards:</strong> <?php echo $data['movie']['Awards']; ?></li>
                    <li><strong>Poster:</strong> <img src="<?php echo $data['movie']['Poster']; ?>" alt="Poster"></li>
                </ul>
            </div>
        <?php else: ?>
            <div class="alert">No movie found.</div>
        <?php endif; ?>
    </div>
</body>
</html>
