<?php
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
        throw new Exception("Invalid author id: " . $errors['id']);
    }

    $id = $validated_data['id'];
    $author = Author::find($id);
    $books = Book::findByAuthorId($id);
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
    
    <title>Holmes & Watson | Bookstore | Author Details</title>
    
</head>

<body>
    
    <?php require 'utils/u_navbar.php'; ?>
    
    <div class="container">
        
        <div class="row page-header-row">
            <div class="col-12">
                <h5 class="info-heading">Author</h5>
                <h1 class="book-author"><?= $author->first_name ?> <?= $author->last_name ?></h1>
            </div>
        </div>
        
        <div class="row author-books-row">
            
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
                            <?= $book->year ?>
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
