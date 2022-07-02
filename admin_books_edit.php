<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Book.php';
require_once 'classes/Author.php';
require_once 'classes/Genre.php';
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
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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
        
        $book_authors = Author::findByBookId($book->id);
        $book_author_ids = array_map(function($author) { return $author->id; }, $book_authors);

        $publishers = Publisher::all();
        $authors = Author::all();
        $genres = Genre::all();
    }
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
    
    <title>Holmes & Watson | Bookstore | Add a book</title>   
    
</head>

<body>
    
    <?php require 'utils/admin_navbar.php'; ?>
    
    <div class="container">
        
        <form method="POST" action="admin_books_update.php" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $book->id ?>" />
            <div class="row lg-form-row">
                <div class="col-12 col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                    <div class="row form-header-row">
                        <div class="col-12 col-sm-12">
                            <h2 class="form-heading">Edit book</h2>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <!-- Title Field -->
                        <div class="form-group col-12 col-sm-12">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="<?= old('title', $book->title) ?>" />
                            <h6 class="error"><?php error('title'); ?></h6>
                        </div>
                        
                        <!-- Author Field -->
                        <div class="col-12 col-sm-12">
                            <label for="author_id[]">Author</label>
                        </div>
                        <div class="form-group col-12 col-sm-12">
                            <?php foreach ($authors as $author) { ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="author_id[]" 
                                           value="<?= $author->id ?>" <?= (in_array($author->id, $book_author_ids))?"checked":"" ?>>
                                    <label class="form-check-label" for="author_id[]">
                                        <?= $author->last_name ?> <?= $author->first_name ?>
                                    </label>
                                </div>
                            <?php } ?>
                            <h6 class="error"><?php error('author_id[]'); ?></h6>
                        </div>
                        
                        <!-- Genre Field -->
                        <div class="form-group col-12 col-sm-6">
                            <label for="genre">Genre</label>
                            <select class="custom-select" id="genre_id" name="genre_id">
                                <option value=""></option>
                                <?php foreach ($genres as $genre) { ?>
                                    <option value="<?= $genre->id ?>" <?= ($genre->id == $book->genre_id)?"selected":"" ?>><?= $genre->genre ?></option>
                                <?php } ?>
                            </select>
                            <h6 class="error"><?php error('genre_id'); ?></h6>
                        </div>
                        
                        <!-- ISBN Field -->
                        <div class="form-group col-6 col-sm-6">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control" id="isbn" name="isbn" 
                                   value="<?= old('isbn', $book->isbn) ?>" />
                            <h6 class="error"><?php error('isbn'); ?></h6>
                        </div>
                        
                        <!-- Format Field -->
                        <div class="form-group col-6 col-sm-4">
                            <label for="format">Format</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="format" id="paperback" 
                                       value="Paperback">
                                <label class="form-check-label" for="paperback">Paperback</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="format" id="hardback" 
                                       value="Hardback">
                                <label class="form-check-label" for="hardback">Hardback</label>
                            </div>
                            <h6 class="error"><?php error('format'); ?></h6>
                        </div>
                        
                        <!-- Year Field -->
                        <div class="form-group col-6 col-sm-4">
                            <label for="year">Year Published</label>
                            <input type="text" class="form-control" id="year" name="year" 
                                   value="<?= old('year', $book->year) ?>" />
                            <h6 class="error"><?php error('year'); ?></h6>
                        </div>
                        
                        <!-- Pages Field -->
                        <div class="form-group col-6 col-sm-4">
                            <label for="pages">Length</label>
                            <input type="text" class="form-control" id="pages" name="pages" 
                                   value="<?= old('pages', $book->pages) ?>" />
                            <h6 class="error"><?php error('pages'); ?></h6>
                        </div>
                        
                        <!-- Price Field -->
                        <div class="form-group col-6 col-sm-6">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" 
                                   value="<?= old('price', $book->price) ?>" />
                            <h6 class="error"><?php error('price'); ?></h6>
                        </div>
                        
                        <!-- Imprint Field -->
                        <div class="form-group col-6 col-sm-6">
                            <label for="imprint">Imprint</label>
                            <input type="text" class="form-control" id="imprint" name="imprint" 
                                   value="<?= old('imprint', $book->imprint) ?>" />
                        </div>
                        
                        <!-- Publisher Field -->
                        <div class="form-group col-12 col-sm-12">
                            <label for="publisher">Publisher</label>
                            <select class="custom-select" id="publisher_id" name="publisher_id">
                                <option value=""></option>
                                <?php foreach ($publishers as $publisher) { ?>
                                    <option value="<?= $publisher->id ?>" <?= ($publisher->id == $book->publisher_id)?"selected":"" ?>><?= $publisher->name ?></option>
                                <?php } ?>
                            </select>
                            <h6 class="error"><?php error('publisher_id'); ?></h6>
                        </div>
                        
                        <!-- Description Field -->
                        <div class="form-group col-12 col-sm-12">
                            <label for="description">Synopsis</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $book->description) ?></textarea>
                            <h6 class="error"><?php error('description'); ?></h6>
                        </div>
                        
                        <!-- Cover Image Field -->
                        <div class="form-group col-12 col-sm-12">
                            <label for="cover">Cover Image</label>
                            <div class="book-md-lg">
                                <img src="<?= $book->cover ?>" class="img-fluid" alt="<?= $book->title ?>">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cover" name="cover" />
                                <label class="custom-file-label" for="cover">Choose file</label>
                            </div>
                            <h6 class="error"><?php error('cover'); ?></h6>
                        </div>
                        
                    </div>
                    
                    <div class="row form-buttons-row">
                        <div class="col-6 col-sm-4 offset-sm-4">
                            <a href="admin_books_index.php" class="btn btn-secondary">Cancel</a>
                        </div>
                        <div class="col-6 col-sm-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </form>
        
        
    </div>
    
    <?php require 'utils/am_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
    
</html>