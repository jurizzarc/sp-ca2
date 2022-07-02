<?php
require_once 'utils/functions.php';
require_once 'classes/Book.php';
require_once 'classes/Author.php';

try {
    $books = Book::all();
}
catch (Exception $ex) {
    die($ex->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php require 'utils/styles.php'; ?>
    
    <title>Holmes & Watson | Bookstore | Books Index</title>
    
</head>

<body>
    
    <?php require 'utils/u_navbar.php'; ?>
    
    <!-- Page Banner -->
    <div class="jumbotron jumbotron-fluid banner books-banner">
        <div class="jumbotron-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-7 col-xl-3 col-lg-3 col-md-5 jumbotron-content">
                        <h3 class="jumbotron-heading">
                            Shop all books
                        </h3>
                        <p class="jumbotron-para">
                            Browse our catalogue of books available on Paperback and Hardback.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->
    
    <div class="container">
        
        <div class="row filter-row">
            <div class="col-7 offset-5 col-xl-3 offset-xl-9 col-lg-4 offset-lg-8 col-md-5 offset-md-7">
                <form>
                    <div class="form-group">
                        <select class="custom-select">
                            <option selected>Sort By</option>
                            <option value="title-asc">Title (A-Z)</option>
                            <option value="title-desc">Title (Z-A)</option>
                            <option value="year-asc">Year (New to Old)</option>
                            <option value="year-desc">Year (Old to New)</option>
                            <option value="price-asc">Lowest Price</option>
                            <option value="price-desc">Highest Price</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row books-row">
            
            <!-- Book Cards -->
            <?php foreach ($books as $book) { ?>
                <div class="col-6 col-xl-2 col-lg-3 col-md-4 col-sm-6 book-card">
                    <!-- Cover Image -->
                    <div class="book-cover-sm">
                        <a href="books_show.php?id=<?= $book->id ?>">
                            <img src="<?= $book->cover ?>" class="img-fluid" alt="<?= $book->isbn ?>">
                        </a>
                    </div>
                    <!-- Card Body -->
                    <div class="book-card-body">
                        <a href="books_show.php?id=<?= $book->id ?>">
                            <?php if (strlen($book->title) > 30) { ?>
                                <h5 class="book-title-sm"><?= nl2br(substr($book->title,0,31)); ?>...</h5>
                            <?php } else if (strlen($book->title) < 30)  { ?>
                                <h5 class="book-title-sm"><?= $book->title ?></h5>
                            <?php } ?>
                        </a>
                        <h6 class="book-author-sm">
                            <?php foreach ($authors = Author::findByBookId($book->id) as $author) { ?>
                                <a href="authors_show.php?id=<?= $author->id ?>">
                                    <?= $author->first_name ?> <?= $author->last_name ?><br>
                                </a>
                            <?php } ?> 
                        </h6>
                    </div>
                </div>
            <?php } ?>
            
        </div>
        
    </div>
    
    <?php require 'utils/u_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
    
    
</html>
