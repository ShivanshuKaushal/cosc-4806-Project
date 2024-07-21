<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search Results</title>
      <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <div class="container">
        <h1>Movie Search Results</h1>
        <a href="index.php?url=movie/index" class="back-link">Back to Search</a>
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
                <form method="POST" action="index.php?url=movie/generateAIReview">
                    <input type="hidden" name="movie_title" value="<?php echo $data['movie']['Title']; ?>">
                    <button type="submit">Ask AI for Review</button>
                </form>
            </div>
            <?php if (isset($data['aiReview'])): ?>
                <div class="card">
                    <h3>AI Review</h3>
                    <p><?php echo $data['aiReview']; ?></p>
                </div>
            <?php endif; ?>
            <div class="card review-form">
                <h3>Add a Review</h3>
                <form method="POST" action="index.php?url=movie/addReview">
                    <input type="hidden" name="movie_id" value="<?php echo $data['movie']['imdbID']; ?>">
                    <input type="hidden" name="movie_title" value="<?php echo $data['movie']['Title']; ?>">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="review_text" placeholder="Enter your review" required></textarea>
                    <label for="stars">Stars:</label>
                    <select name="stars" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit">Submit Review</button>
                </form>
            </div>
            <div class="card review-list">
                <h3>Reviews</h3>
                <?php if ($data['reviews']): ?>
                    <ul>
                        <?php foreach ($data['reviews'] as $review): ?>
                            <li><?php echo htmlspecialchars($review['review']); ?> (<?php echo $review['stars']; ?> stars) <br><small>by <?php echo $review['name']; ?> on <?php echo $review['created_at']; ?></small></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No reviews yet.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="alert">No movie found.</div>
        <?php endif; ?>
    </div>
</body>
</html>
