<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Genre.php';

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];

if ($user->role_id != 1) {
    header("Location: logout.php");
}

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
    
    <?php require 'utils/admin_navbar.php'; ?>
    
    <div class="container">
        
        <div class="row filter-row">
            <div class="col-12 col-xl-6 col-lg-6 col-md-4 col-sm-6 table-name-col">
                <h2 class="section-heading">Genres</h2>
            </div>
            
            <div class="col-12 col-xl-2 offset-xl-4 col-lg-3 offset-lg-3 col-md-4 offset-md-4 col-sm-6">
                <a class="btn btn-primary" href="admin_genres_create.php" role="button">Add a genre</a>
            </div>
        </div>
        
        <div class="row genres-list-row">
            <?php foreach ($genres as $genre) { ?>
                <div class="col-6 col-xl-4 col-lg-4 col-md-4 col-sm-6 genre-card">
                    <h3 class="genre-card-label">
                        <a href="admin_genres_show.php?id=<?= $genre->id ?>"><?= $genre->genre ?></a>
                    </h3>
                </div>
            <?php } ?>
        </div>
        
    </div>
    
    
    <?php require 'utils/am_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
    
</html>