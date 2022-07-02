<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];

if ($user->role_id != 1) {
    header("Location: logout.php");
}
?>

<!DOCTYPE HTML>
<html lang="en">
    
<head>
    
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php require 'utils/styles.php'; ?>
    
    <title>Holmes & Watson | Bookstore | Add a publisher</title>   
    
</head>

<body>
    
    <?php require 'utils/admin_navbar.php'; ?>
    
    <div class="container">
        
        <form method="POST" action="admin_publishers_store.php" role="form" enctype="multipart/form-data">
            <div class="row lg-form-row">
                <div class="col-12 col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset md-2">
                    <div class="row form-header-row">
                        <div class="col-12 col-sm-12">
                            <h3 class="form-heading">Add a publisher</h3>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <!-- Name Field -->
                        <div class="form-group col-12 col-sm-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= old('name') ?>" />
                            <h6 class="error"><?php error('name'); ?></h6>
                        </div>
                        
                        <!-- Address Field -->
                        <div class="form-group col-12 col-sm-12">
                            <label for="address">Headquarters</label>
                            <input type="text" class="form-control" id="address" name="address" 
                                   value="<?= old('address') ?>" />
                            <h6 class="error"><?php error('address'); ?></h6>
                        </div>
                        
                        <!-- Phone Field -->
                        <div class="form-group col-12 col-sm-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" 
                                   value="<?= old('phone') ?>" />
                            <h6 class="error"><?php error('phone'); ?></h6>
                        </div>
                        
                        <!-- Phone Field -->
                        <div class="form-group col-12 col-sm-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" 
                                   value="<?= old('email') ?>" />
                            <h6 class="error"><?php error('email'); ?></h6>
                        </div>
                        
                        <!-- Website Field -->
                        <div class="form-group col-12 col-sm-12">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" 
                                   value="<?= old('website') ?>" />
                            <h6 class="error"><?php error('website'); ?></h6>
                        </div>
                        
                    </div>
                    
                    <div class="row form-buttons-row">
                        <div class="col-6 col-sm-4 offset-sm-4">
                            <a href="admin_publishers_index.php" class="btn btn-secondary">Cancel</a>
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