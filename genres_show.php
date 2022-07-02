<?php
require_once 'classes/Genre.php';
require_once 'classes/Book.php';
require_once 'classes/Author.php';
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
        throw new Exception("Invalid genre id: " . $errors['id']);
    }

    $id = $validated_data['id'];
    $genre = Genre::find($id);
    
    $bookAuthors = Book::findByGenreId($id);
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
    
    <title>Holmes & Watson | Bookstore | Genre Details</title>
    
</head>

<body>
    
    <?php require 'utils/u_navbar.php'; ?>
    
    <div class="container">
        
        <div class="row page-header-row">
            <div class="col-12">
                <h5 class="info-heading">Genre</h5>
                <h1 class="book-author"><?= $genre->genre ?></h1>
            </div>
        </div>
        
        <div class="row genre-books-row">
            
            <!-- Book Cards -->
            <?php foreach ($bookAuthors as $bookAuthor) { ?>
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
