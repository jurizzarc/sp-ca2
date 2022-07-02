<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Book.php';
require_once 'classes/Author.php';
require_once 'classes/Publisher.php';
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
        throw new Exception("Invalid publisher id: " . $errors['id']);
    }

    $id = $validated_data['id'];
    $publisher = Publisher::find($id);
    $books = Book::findByPublisherId($id);
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
            
            <div class="col-12 col-xl-4 offset-xl-0 col-lg-4 offset-lg-0 col-md-8 offset-md-2 col-sm-12">
                <div class="row details-heading-row">
                    <div class="col-sm-12">
                        <h3 class="details-heading">Publisher Details</h3>
                    </div>
                </div>
                
                <div class="row info-tiles">
                    
                    <!-- Name -->
                    <div class="col-12 col-sm-12 info-item">
                        <h5 class="info-heading">Name</h5>
                        <p class="info-data"><?= $publisher->name ?></p>
                    </div>
                    
                    <!-- Address -->
                    <div class="col-12 col-sm-12 info-item">
                        <h5 class="info-heading">Headquarters</h5>
                        <p class="info-data"><?= $publisher->address ?></p>
                    </div>
                    
                    <!-- Phone -->
                    <?php if (!empty($publisher->email)): ?>
                        <div class="col-12 col-sm-12 info-item">
                            <h5 class="info-heading">Phone</h5>
                            <p class="info-data"><?= $publisher->phone ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Email -->
                    <?php if (!empty($publisher->email)): ?>
                        <div class="col-12 col-sm-12 info-item">
                            <h5 class="info-heading">Email</h5>
                            <p class="info-data"><?= $publisher->email ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Website -->
                    <div class="col-12 col-sm-12 info-item">
                        <h5 class="info-heading">Website</h5>
                        <a href="<?= $publisher->website ?>">
                            <p class="info-data-website"><?= $publisher->website ?></p>
                        </a>
                    </div>
                    
                </div>
                
                <div class="row action-buttons-row">
                    <div class="col-6 col-sm-5 offset-sm-2">
                        <a class="btn btn-primary" href="admin_publishers_edit.php?id=<?= $publisher->id ?>" role="button">Edit</a>
                    </div>
                    <div class="col-6 col-sm-5">
                        <a class="btn btn-secondary" href="admin_publishers_delete.php?id=<?= $publisher->id ?>" role="button">Delete</a>
                    </div>
                </div>
                
            </div>
            
            <div class="col-12 col-xl-7 offset-xl-1 col-lg-7 offset-lg-1 col-md-8 offset-md-2 col-sm-12 details-content">
                <div class="row details-heading-row">
                    <div class="col-sm-12">
                        <h3 class="details-heading">Publications</h3>
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
                                            <th>Author</th>
                                            <th>ISBN</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <?php foreach ($books as $book ) { ?>
                                            <tr>
                                                <td><a href="admin_books_show.php?id=<?= $book->id ?>" class="btn-link"><?= $book->title ?></a></td>
                                                <td>
                                                    <?php foreach ($authors = Author::findByBookId($book->id) as $author) { ?>
                                                        <?= $author->first_name ?> <?= $author->last_name ?><br/>
                                                    <?php } ?> 
                                                </td>
                                                <td><?= $book->isbn ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                
                                </table>
                            </div>
                        <?php } else { ?>
                            <h6 class="error">There are no books assigned to this publisher.</h6>
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