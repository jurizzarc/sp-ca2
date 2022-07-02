<?php
require_once 'classes/Publisher.php';
require_once 'classes/Gump.php';
require_once 'utils/functions.php';

try {
    $validator = new GUMP();

    $_POST = $validator->sanitize($_POST);

    $validation_rules = array(
        'id' => 'required|integer|min_numeric,1',
        'name' => 'required|min_len,1|max_len,50',
        'address' => 'required|min_len,1|max_len,250',
        //'phone' => 'required|min_len,1|max_len,50',
        //'email' => 'required|min_len,1|max_len,50',
        'website' => 'required|min_len,1|max_len,100'
    );
    $filter_rules = array(
    	'id' => 'trim|sanitize_numbers',
        'name' => 'trim|sanitize_string',
        'address' => 'trim|sanitize_string',
        //'phone' => 'trim|sanitize_string',
        //'email' => 'trim|sanitize_string',
        'website' => 'trim|sanitize_string'
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
    $publisher = Publisher::find($id);
    $publisher->name = $validated_data['name'];
    $publisher->address = $validated_data['address'];
    $publisher->phone = $validated_data['phone'];
    $publisher->email = $validated_data['email'];
    $publisher->website = $validated_data['website'];
    $publisher->save();

    header("Location: admin_publishers_index.php");
}
catch (Exception $ex) {
    require 'publishers_edit.php';
}
?>
