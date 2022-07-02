<?php
require_once 'classes/Book.php';
//require_once 'classes/Author.php';
require_once 'classes/Genre.php';
require_once 'classes/Publisher.php';
require_once 'classes/Gump.php';
require_once 'utils/functions.php';

try {
    $validator = new GUMP();

    $_POST = $validator->sanitize($_POST);

    $validation_rules = array(
        'id' => 'required|integer|min_numeric,1',
        'title' => 'required|min_len,1|max_len,1000',
        'genre_id' => 'required|integer|min_numeric,1',
        'description' => 'required|min_len,1|max_len,10000',
        'format' => 'required|min_len,1|max_len,10',
        'pages' => 'required|integer|min_numeric,1',
        'isbn' => 'required|numeric|exact_len,13|min_numeric,0',
        'year' => 'required|numeric|exact_len,4|min_numeric,1900',
        'price' => 'required|float|min_numeric,0',
        //'imprint' => 'required|min_len,1|max_len,40',
        'publisher_id' => 'required|integer|min_numeric,1'
    );
    $filter_rules = array(
    	'id' => 'trim|sanitize_numbers',
        'title' => 'trim|sanitize_string',
        'genre_id' => 'trim|sanitize_numbers',
        'description' => 'trim|sanitize_string',
        'format' => 'trim|sanitize_string',
        'pages' => 'trim|sanitize_numbers',
        'isbn' => 'trim|sanitize_numbers',
        'year' => 'trim|sanitize_numbers',
        'price' => 'trim|sanitize_floats',
        //'imprint' => 'trim|sanitize_string',
        'publisher_id' => 'trim|sanitize_numbers'
    );

    $validator->validation_rules($validation_rules);
    $validator->filter_rules($filter_rules);

    $validated_data = $validator->run($_POST);

    if($validated_data === false) {
        $errors = $validator->get_errors_array();
    }
    else {
        $errors = array();
        
        $genre_id = $validated_data['genre_id'];
        $genre = Genre::find($genre_id);
        $publisher_id = $validated_data['publisher_id'];
        $publisher = Publisher::find($publisher_id);
        
        if ($publisher === false) {
            $errors['publisher_id'] = "Invalid publisher";
        } else if ($genre === false) {
            $errors['genre_id'] = "Invalid genre";
        }

        //dd($_FILES);

        try {
            $coverImageFile = imageFileUpload('cover', false, 1000000, array('jpg', 'jpeg', 'png', 'gif'));
        }
        catch (Exception $e) {
            $errors['cover'] = $e->getMessage();
        }
    }

    if (!empty($errors)) {
        throw new Exception("There were errors. Please fix them.");
    }

    $id = $validated_data['id'];
    
    $book = Book::find($id);
    
    $book->title = $validated_data['title'];
    $book->genre_id = $validated_data['genre_id'];
    $book->description = $validated_data['description'];
    $book->format = $validated_data['format'];
    $book->pages = $validated_data['pages'];
    $book->isbn = $validated_data['isbn'];
    $book->year = $validated_data['year'];
    $book->price = $validated_data['price'];
    $book->imprint = $validated_data['imprint'];
    $book->publisher_id = $validated_data['publisher_id'];
    if ($coverImageFile != null) {
        if ($book->cover != null && $book->cover != 'uploads/book_default.png' && file_exists($book->cover)) {
            unlink($book->cover);
        }
        $book->cover = $coverImageFile;
    }
    $book->save();
    
    if (isset($_POST['author_id'])) {
        $book->setAuthors($_POST['author_id']);
    }

    header("Location: admin_books_index.php");
}
catch (Exception $ex) {
    require 'admin_books_edit.php';
}
?>
