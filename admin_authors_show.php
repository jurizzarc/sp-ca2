<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
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

<!DOCTYPE HTML>
<html>
    
<head>
    
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php require 'utils/styles.php'; ?>
    
    <title>Holmes & Watson | Bookstore | Author Details</title>
    
</head>

<body>
    
    <?php require 'utils/admin_navbar.php'; ?> 
    
    <div class="container">
        <div class="row details-row">
            
            <div class="col-12 col-xl-6 offset-xl-0 col-lg-6 offset-lg-0 col-md-8 offset-md-2 col-sm-12">
                <div class="row details-heading-row">
                    <div class="col-sm-12">
                        <h3 class="details-heading">Author Details</h3>
                    </div>
                </div>
                
                <div class="row info-tiles">
                    
                    <!-- First name, Last name -->
                    <div class="col-12 col-sm-12 info-item">
                        <h5 class="info-heading">Name</h5>
                        <p class="info-data"><?= $author->first_name ?> <?= $author->last_name ?></p>
                    </div>
                    
                    <!-- About the author -->
                    <div class="col-12 col-sm-12 info-item">
                        <h5 class="info-heading">Biography</h5>
                        <p class="info-data"><?= nl2br($author->about); ?></p>
                    </div>
                    
                </div>
                
                <div class="row action-buttons-row">
                    <div class="col-6 col-sm-4 offset-sm-4">
                        <a class="btn btn-primary" href="admin_authors_edit.php?id=<?= $author->id ?>" role="button">Edit</a>
                    </div>
                    <div class="col-6 col-sm-4">
                        <a class="btn btn-secondary" href="admin_authors_delete.php?id=<?= $author->id ?>" role="button">Delete</a>
                    </div>
                </div>
                
            </div>
            
            <div class="col-12 col-xl-5 offset-xl-1 col-lg-5 offset-lg-1 col-md-8 offset-md-2 col-sm-12 details-content">
                <div class="row details-heading-row">
                    <div class="col-sm-12">
                        <h3 class="details-heading">Bibliography</h3>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (count($books) != 0) { ?>
                            <div class="table-responsive">
                                <table class="table">
                                
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>ISBN</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <?php foreach ($books as $book ) { ?>
                                            <tr>
                                                <td><a href="am_books_show.php?id=<?= $book->id ?>" class="btn-link"><?= $book->title ?></a></td>
                                                <td><?= $book->isbn ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                
                                </table>
                            </div>
                        <?php } else { ?>
                            <h6 class="error">There are no books assigned to this author.</h6>
                        <?php } ?>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    
    
    <?php require 'utils/am_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
  
    
</body>
    
</html>