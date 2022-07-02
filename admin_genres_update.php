<?php
require_once 'classes/Genre.php';
require_once 'classes/Gump.php';
require_once 'utils/functions.php';

try {
    $validator = new GUMP();

    $_POST = $validator->sanitize($_POST);

    $validation_rules = array(
        'id' => 'required|integer|min_numeric,1',
        'genre' => 'required|min_len,1|max_len,30'
    );
    $filter_rules = array(
    	'id' => 'trim|sanitize_numbers',
        'genre' => 'trim|sanitize_string'
    );

    $validator->validation_rules($validation_rules);
    $validator->filter_rules($filter_rules);

    $validated_data = $validator->run($_POST);

    if($validated_data === false) {
        $errors = $validator->get_errors_array();
    }
    else {
        $errors = array();

        //dd($_FILES);
    }

    if (!empty($errors)) {
        throw new Exception("There were errors. Please fix them.");
    }

    $id = $validated_data['id'];
    $genre = Genre::find($id);
    $genre->genre = $validated_data['genre'];
    $genre->save();

    header("Location: admin_genres_index.php");
}
catch (Exception $ex) {
    require 'admin_genres_edit.php';
}
?>
