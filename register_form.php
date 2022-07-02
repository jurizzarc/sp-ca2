<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php require 'utils/styles.php'; ?>
    
    <title>Holmes & Watson | Bookstore | Register</title>   
    
</head>

<body> 
    
    <div class="vertical-center">
        <div class="container">

            <div class="row brand-header">
                <div class="col-12">
                    <a href="index.php">
                        <img src="images/brand.png" class="img-fluid" alt="Brand Logo">
                    </a>
                </div>
            </div>

            <form method="POST" action="register.php" role="form" enctype="multipart/form-data">

                <div class="row account-form-row">
                    <div class="col-10 offset-1 col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-6 offset-md-3 
                         col-sm-8 offset-sm-2">

                        <div class="row">
                            <!-- First Name Field -->
                            <div class="form-group col-12 col-sm-12">
                                <input type="text" class="form-control" id="first_name" name="first_name" 
                                    value="<?= old('first_name') ?>" placeholder="First Name" />
                                <h6 class="error"><?php error('first_name'); ?></h6>
                            </div>

                            <!-- Last Name Field -->
                            <div class="form-group col-12 col-sm-12">
                                <input type="text" class="form-control" id="last_name" name="last_name" 
                                   value="<?= old('last_name') ?>" placeholder="Last Name" />
                                <h6 class="error"><?php error('last_name'); ?></h6>
                            </div>
                            
                            <!-- Username Field -->
                            <div class="form-group col-12 col-sm-12">
                                <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= old('username') ?>" placeholder="Username" />
                                <h6 class="error"><?php error('username'); ?></h6>
                            </div>
                            
                            <!-- Password Field -->
                            <div class="form-group col-12 col-sm-12">
                                <input type="password" class="form-control" id="password" name="password" 
                                   value="" placeholder="Password" />
                                <h6 class="error"><?php error('password'); ?></h6>
                            </div>
                            
                            <!-- Password Confirmation Field -->
                            <div class="form-group col-12 col-sm-12">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
                                   value="" placeholder="Confirm Password" />
                                <h6 class="error"><?php error('password_confirmation'); ?></h6>
                            </div>
                        </div>

                        <div class="row account-form-buttons-row">
                            <div class="col-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

            <div class="row bottom-text-row">
                <div class="col-12">
                    <h5>
                        Already have an account?
                        <a href="login_form.php">Sign in here</a>
                    </h5>
                </div>
            </div>

        </div> 
    </div>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
    
</html>