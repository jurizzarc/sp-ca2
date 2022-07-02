<?php
require_once 'classes/Author.php';
require_once 'classes/Gump.php';
require_once 'utils/functions.php';

try {
    $validator = new GUMP();

    $_POST = $validator->sanitize($_POST);

    $validation_rules = array(
        'last_name' => 'required|min_len,1|max_len,30',
        //'first_name' => 'required|min_len,1|max_len,30',
        'about' => 'required|min_len,1|max_len,1000'
    );
    $filter_rules = array(
        'last_name' => 'trim|sanitize_string',
        //'first_name' => 'trim|sanitize_string',
        'about' => 'trim|sanitize_string'
    );

    $validator->validation_rules($validation_rules);
    $validator->filter_rules($filter_rules);

    $validated_data = $validator->run($_POST);

    if($validated_data === false) {
        $errors = $validator->get_errors_array();
    }
    else {
        $errors = array();
    }

    if (!empty($errors)) {
        throw new Exception("There were errors. Please fix them.");
    }

    $author = new Author();
    $author->last_name = $validated_data['last_name'];
    $author->first_name = $validated_data['first_name'];
    $author->about = $validated_data['about'];

    $author->save();

    header("Location: admin_authors_index.php");
}
catch (Exception $ex) {
    require 'admin_authors_create.php';
}
?>
