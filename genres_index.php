<?php
require_once 'classes/Genre.php';
require_once 'classes/Book.php';
require_once 'classes/Author.php';

try {
    $genres = Genre::all();
}
catch (Exception $ex) {
    die($ex->getMessage());
}
?>
<!DOCTYPE html>
<html>
    
<head>
    
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php require 'utils/styles.php'; ?>
    
    <title>Holmes & Watson | Bookstore | Genres Index</title>
    
</head>

<body>
    
    <?php require 'utils/u_navbar.php'; ?>
    
    <!-- Page Banner -->
    <div class="jumbotron jumbotron-fluid banner genres-banner">
        <div class="jumbotron-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-xl-2 col-lg-2 col-md-4 jumbotron-content">
                        <h3 class="jumbotron-heading">Genres</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->
    
    <div class="container">
        
        <div class="row genres-list-row">
            <?php foreach ($genres as $genre) { ?>
                <div class="col-6 col-xl-4 col-lg-4 col-md-4 col-sm-6 genre-card">
                    <h3 class="genre-card-label">
                        <a href="genres_show.php?id=<?= $genre->id ?>"><?= $genre->genre ?></a>
                    </h3>
                </div>
            <?php } ?>
        </div>
        
    </div>
    
    <?php require 'utils/u_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
    
</html>
