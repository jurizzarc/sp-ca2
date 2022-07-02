<?php
require_once 'utils/functions.php';
require_once 'classes/Book.php';
require_once 'classes/Publisher.php';
require_once 'classes/Author.php';
require_once 'classes/Genre.php';
require_once 'classes/Gump.php';

try {
    $validator = new GUMP();

    $_GET = $validator->sanitize($_GET);

    $validation_rules = array(
        'id' => 'required|integer|min_numeric,1'
    );
    $filter_rules = array(
    	'id' => 'trim|sanitize_numbers'
    );

    $validator->validation_rules($validation_rules);
    $validator->filter_rules($filter_rules);

    $validated_data = $validator->run($_GET);

    if($validated_data === false) {
        $errors = $validator->get_errors_array();
        throw new Exception("Invalid book id: " . $errors['id']);
    }

    $id = $validated_data['id'];
    $book = Book::find($id);
    $authors = Author::findByBookId($id);
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
    
    <title>Holmes & Watson | Bookstore | Book Details</title>
    
</head>

<body>
    
    <?php require 'utils/u_navbar.php'; ?>
    
    <div class="container">
        <!-- Book Details Row Start -->
        <div class="row details-row">
            
            <!-- Cover Image -->
            <div class="col-10 offset-1 col-xl-3 offset-xl-1 col-lg-3 offset-lg-1 col-md-4 offset-md-0 col-sm-10">
                <img src="<?= $book->cover ?>" class="img-fluid" alt="<?= $book->isbn ?>">
            </div>
            
            <!-- Book details start -->
            <div class="col-10 offset-1 col-xl-6 col-lg-6 col-md-7 col-sm-10 details-content">
                
                <!-- Author(s) -->
                <h4 class="book-author-lg">
                    <?php foreach ($authors as $author) { ?>
                        <a href="authors_show.php?id=<?= $author->id ?>">
                            <?= $author->first_name ?> <?= $author->last_name ?><br/> 
                        </a>
                    <?php } ?> 
                </h4>
                <!-- Title -->
                <h1 class="book-title-lg"><?= $book->title ?></h1>
                
                <div class="row book-info-a">
                    <div class="col-5 col-sm-5">
                        <div class="row">
                            <!-- Price -->
                            <div class="col info-item">
                                <h5 class="info-heading">Price</h5>
                                <p class="info-data">&euro;<?= $book->price ?></p>
                            </div>
                            <!-- Format -->
                            <div class="col info-item">
                                <h5 class="info-heading">Format</h5>
                                <p class="info-data"><?= $book->format ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-7 col-sm-7 button-column">
                        <a class="btn btn-primary" href="#" role="button">Add to basket</a>
                        <a class="btn btn-secondary" href="#" role="button">Add to wishlist</a>
                    </div>
                </div>
                
                <!-- Description -->
                <p class="synopsis">
                    <?= nl2br($book->description); ?>
                </p>
                
                <div class="row book-info-b">
                    <!-- Genre -->
                    <div class="col-12 col-sm-4 info-item">
                        <h5 class="info-heading">Genre</h5>
                        <p class="info-data"><?= Genre::find($book->genre_id)->genre ?></p>
                    </div>
                    
                    <!-- Pages -->
                    <div class="col-12 col-sm-4 info-item">
                        <h5 class="info-heading">Length</h5>
                        <p class="info-data"><p class="info-data"><?= $book->pages ?> Pages</p>
                    </div>
                    
                    <!-- Year -->
                    <div class="col-12 col-sm-4 info-item">
                        <h5 class="info-heading">Published in</h5>
                        <p class="info-data"><p class="info-data"><?= $book->year ?></p>
                    </div>
                    
                    <!-- ISBN -->
                    <div class="col-12 col-sm-4 info-item">
                        <h5 class="info-heading">ISBN</h5>
                        <p class="info-data"><p class="info-data"><?= $book->isbn ?></p>
                    </div>
                    
                    <!-- Imprint -->
                    <?php if (!empty($book->imprint)): ?>
                        <div class="col-12 col-sm-4 info-item">
                            <h5 class="info-heading">Imprint</h5>
                            <p class="info-data"><p class="info-data"><?= $book->imprint ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Publisher -->
                    <div class="col-12 col-sm-4 info-item">
                        <h5 class="info-heading">Publisher</h5>
                        <p class="info-data"><p class="info-data"><?= Publisher::find($book->publisher_id)->name ?></p>
                    </div>
                </div>
                
            </div>
            <!-- Book Details End -->
            
        </div>
        <!-- Book Details Row End -->
    </div>
    
    <!-- About the author banner -->
    <?php foreach ($authors as $author) { ?>
    <div class="jumbotron jumbotron-fluid about-author-banner">
        <div class="container">
            <div class="row">
                
                <div class="col-12 about-author-banner-header">
                    <h5 class="info-heading">About the author</h5>
                    <h1 class="book-author"><?= $author->first_name ?> <?= $author->last_name ?></h1>
                </div>
                <div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                    <p class="about-author"><?= nl2br($author->about); ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- About the author banner end -->
    
    <!-- Recommendations -->
    <div class="container recommendations-container">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <h3 class="section-heading">Recommended for you</h3>
            </div>
        </div>
        
        <div class="row books-row">
            <?php foreach ($bookAuthors = Book::recommendationsByGenreId($book->genre_id, $book->id) as $bookAuthor) { ?>
                <div class="col-6 col-xl-2 col-lg-3 col-md-4 col-sm-6 book-card">
                    <!-- Cover Image -->
                    <div class="book-cover-sm">
                        <a href="books_show.php?id=<?= $bookAuthor->book_id ?>">
                            <img src="<?= Book::find($bookAuthor->book_id)->cover ?>" class="img-fluid" alt="<?= Book::find($bookAuthor->book_id)->isbn ?>">
                        </a>
                    </div>
                    <!-- Card Body -->
                    <div class="book-card-body">
                        <a href="books_show.php?id=<?= $bookAuthor->book_id ?>">
                            <?php if (strlen(Book::find($bookAuthor->book_id)->title) > 30) { ?>
                                <h5 class="book-title-sm"><?= nl2br(substr(Book::find($bookAuthor->book_id)->title,0,31)); ?>...</h5>
                            <?php } else if (strlen(Book::find($bookAuthor->book_id)->title) < 30)  { ?>
                                <h5 class="book-title-sm"><?= Book::find($bookAuthor->book_id)->title ?></h5>
                            <?php } ?>
                        </a>
                        <h6 class="book-author-sm">
                            <?php foreach ($authors = Author::findByBookId($bookAuthor->book_id) as $author) { ?>
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
