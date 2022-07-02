<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Book.php';
require_once 'classes/Publisher.php';
require_once 'classes/Author.php';
require_once 'classes/Genre.php';
require_once 'classes/Gump.php';

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];

if ($user->role_id != 1) {
    header("Location: logout.php");
}

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

<!DOCTYPE HTML>
<html>
    
<head>
    
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php require 'utils/styles.php'; ?>
    
    <title>Holmes & Watson | Bookstore | Book Details</title>
    
</head>

<body>
    
    <?php require 'utils/admin_navbar.php'; ?>
    
    <div class="container">
        <!-- Book Details Row Start -->
        <div class="row details-row">
            
            <!-- Cover Image -->
            <div class="col-10 offset-1 col-xl-3 offset-xl-1 col-lg-3 offset-lg-1 col-md-4 offset-md-0 col-sm-10">
                <img src="<?= $book->cover ?>" class="img-fluid" alt="<?= $book->title ?>">
            </div>
            
            <!-- Other book details -->
            <div class="col-10 offset-1 col-xl-6 col-lg-6 col-md-7 col-sm-10 details-content">
                <div class="row details-heading-row">
                    <div class="col col-sm-12">
                        <h3 class="details-heading">Book Details</h3>
                    </div>
                </div>
                
                <div class="row info-tiles">
                    
                    <!-- Title -->
                    <div class="col-12 col-sm-6 info-item">
                        <h5 class="info-heading">Title</h5>
                        <p class="info-data"><?= $book->title ?></p>
                    </div>
                    <!-- Author(s) -->
                    <div class="col-12 col-sm-6 info-item">
                        <h5 class="info-heading">Author(s)</h5>
                        <p class="info-data">
                            <?php foreach ($authors as $author) { ?>
                                <?= $author->first_name ?> <?= $author->last_name ?><br/> 
                            <?php } ?> 
                        </p>
                    </div>
                    <!-- Genre -->
                    <div class="col-6 col-sm-4 info-item">
                        <h5 class="info-heading">Genre</h5>
                        <p class="info-data"><?= Genre::find($book->genre_id)->genre ?></p>
                    </div>
                    <!-- Format -->
                    <div class="col-6 col-sm-4 info-item">
                        <h5 class="info-heading">Format</h5>
                        <p class="info-data"><?= $book->format ?></p>
                    </div>
                    <!-- Pages -->
                    <div class="col-6 col-sm-4 info-item">
                        <h5 class="info-heading">Length</h5>
                        <p class="info-data"><?= $book->pages ?> Pages</p>
                    </div>
                    <!-- ISBN -->
                    <div class="col-6 col-sm-4 info-item">
                        <h5 class="info-heading">ISBN</h5>
                        <p class="info-data"><?= $book->isbn ?></p>
                    </div>
                    <!-- Year -->
                    <div class="col-6 col-sm-4 info-item">
                        <h5 class="info-heading">Year Published</h5>
                        <p class="info-data"><?= $book->year ?></p>
                    </div>
                    <!-- Price -->
                    <div class="col-6 col-sm-4 info-item">
                        <h5 class="info-heading">Price</h5>
                        <p class="info-data">&euro;<?= $book->price ?></p>
                    </div>
                    <!-- Imprint -->
                    <?php if (!empty($book->imprint)): ?>
                        <div class="col-12 col-sm-4 info-item">
                            <h5 class="info-heading">Imprint</h5>
                            <p class="info-data"><?= $book->imprint ?></p>
                        </div>
                    <?php endif; ?>
                    <!-- Publisher -->
                    <div class="col-12 col-sm-8 info-item">
                        <h5 class="info-heading">Publisher</h5>
                        <p class="info-data"><?= Publisher::find($book->publisher_id)->name ?></p>
                    </div>
                    <!-- Description -->
                    <div class="col-12 col-sm-12 info-item">
                        <h5 class="info-heading">Synopsis</h5>
                        <p class="info-data"><?= nl2br($book->description); ?></p>
                    </div>
                </div>
                
                <div class="row action-buttons-row">
                    <div class="col-6 col-sm-4 offset-sm-4">
                        <a class="btn btn-primary" href="admin_books_edit.php?id=<?= $book->id ?>" role="button">Edit</a>
                    </div>
                    <div class="col-6 col-sm-4">
                        <a class="btn btn-secondary" href="admin_books_delete.php?id=<?= $book->id ?>" role="button">Delete</a>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    
    
    <?php require 'utils/am_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
    
    
</html>