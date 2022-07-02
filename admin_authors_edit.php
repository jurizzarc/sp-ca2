<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
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
            throw new Exception("Invalid author id: " . $errors['id']);
        }

        $id = $validated_data['id'];
        $author = Author::find($id);
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
    
    <title>Holmes & Watson | Bookstore | Edit author</title>   
    
</head>

<body>
    
    <?php require 'utils/admin_navbar.php'; ?>
    
    <div class="container">
        
        <form method="POST" action="admin_authors_update.php" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $author->id ?>" />
            <div class="row lg-form-row">
                <div class="col-12 col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset md-2">
                    <div class="row form-header-row">
                        <div class="col-12 col-sm-12">
                            <h3 class="form-heading">Edit author</h3>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <!-- First Name Field -->
                        <div class="form-group col-12 col-sm-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" 
                                   value="<?= old('first_name', $author->first_name) ?>" />
                            <h6 class="error"><?php error('first_name'); ?></h6>
                        </div>
                        
                        <!-- Last Name Field -->
                        <div class="form-group col-12 col-sm-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" 
                                   value="<?= old('last_name', $author->last_name) ?>" />
                            <h6 class="error"><?php error('last_name'); ?></h6>
                        </div>
                        
                        <!-- About Field -->
                        <div class="form-group col-12 col-sm-12">
                            <label for="about">Biography</label>
                            <textarea class="form-control" id="about" name="about" rows="3"><?= old('about', $author->about) ?></textarea>
                            <h6 class="error"><?php error('about'); ?></h6>
                        </div>
                        
                    </div>
                    
                    <div class="row form-buttons-row">
                        <div class="col-6 col-sm-4 offset-sm-4">
                            <a href="admin_authors_index.php" class="btn btn-secondary">Cancel</a>
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
