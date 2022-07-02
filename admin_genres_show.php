<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Genre.php';
require_once 'classes/Book.php';
require_once 'classes/Author.php';
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
    
    <?php require 'utils/admin_navbar.php'; ?>
    
    <div class="container">
        <div class="row filter-row">
            <div class="col-12 col-xl-6 col-lg-6 col-md-4 genre-name-col">
                <h3 class="section-heading"><?= $genre->genre ?></h3>
            </div>
            
            <div class="col-6 col-xl-2 offset-xl-2 col-lg-3 col-md-4">
                <a class="btn btn-primary" href="admin_genres_edit.php?id=<?= $genre->id ?>" role="button">Edit</a>
            </div>
            
            <div class="col-6 col-xl-2 col-lg-3 col-md-4">
                <a class="btn btn-secondary" href="admin_genres_delete.php?id=<?= $genre->id ?>" role="button">Delete</a>
            </div>
        </div>
        
        <div class="row table-row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table">
                        
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Authors(s)</th>
                                <th>Format</th>
                                <th>ISBN</th>
                                <th>Year</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach ($bookAuthors as $bookAuthor) { ?>
                                <tr data-id="<?= $bookAuthor->id ?>">
                                    <td><a href="admin_books_show.php?id=<?= $bookAuthor->book_id ?>"> <?= Book::find($bookAuthor->book_id)->title ?></a></td>
                                    <td>
                                        <?php foreach ($authors = Author::findByBookId($bookAuthor->book_id) as $author) { ?>
                                            <?= $author->first_name ?> <?= $author->last_name ?><br>
                                        <?php } ?>
                                    </td>
                                    <td><?= Book::find($bookAuthor->book_id)->format ?></td>
                                    <td><?= Book::find($bookAuthor->book_id)->isbn ?></td>
                                    <td><?= Book::find($bookAuthor->book_id)->year ?></td>
                                    <td><?= Book::find($bookAuthor->book_id)->price ?></td>
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