<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Author.php';
require_once 'classes/Book.php';
require_once 'classes/Author.php';
require_once 'classes/Publisher.php';
require_once 'classes/Genre.php';

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];

if ($user->role_id != 1) {
    header("Location: logout.php");
}

try {
    $books = Book::all();
}
catch (Exception $ex) {
    die($ex->getMessage());
}
?>

<!DOCTYPE HTML>
<html lang="en">
    
<head>
    
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php require 'utils/styles.php'; ?>
    
    <title>Holmes & Watson | Bookstore | Books Index</title>
    
</head>

<body>
    
    <?php require 'utils/admin_navbar.php'; ?>
    
    <div class="container">
        <div class="row filter-row">
            <div class="col-12 col-xl-6 col-lg-6 col-md-4 col-sm-6 table-name-col">
                <h2 class="section-heading">Books</h2>
            </div>
            
            <div class="col-12 col-xl-2 offset-xl-4 col-lg-3 offset-lg-3 col-md-4 offset-md-4 col-sm-6">
                <a class="btn btn-primary" href="admin_books_create.php" role="button">Add a book</a>
            </div>
            
        </div>
        
        <div class="row table-row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table">
                        
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author(s)</th>
                                <th>Genre</th>
                                <th>Format</th>
                                <th>ISBN</th>
                                <th>Year</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach ($books as $book) { ?>
                                <tr data-id="<?= $book->id ?>">
                                    <td><a href="admin_books_show.php?id=<?= $book->id ?>"><?= $book->title ?></a></td>
                                    <td>
                                        <?php foreach ($authors = Author::findByBookId($book->id) as $author) { ?>
                                            <?= $author->first_name ?> <?= $author->last_name ?><br/>
                                        <?php } ?> 
                                    </td>
                                    <td><?= Genre::find($book->genre_id)->genre ?></td>
                                    <td><?= $book->format ?></td>
                                    <td><?= $book->isbn ?></td>
                                    <td><?= $book->year ?></td>
                                    <td><?= $book->price ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <?php require 'utils/am_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
    
</html>

