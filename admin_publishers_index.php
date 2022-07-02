<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Publisher.php';

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];

if ($user->role_id != 1) {
    header("Location: logout.php");
}

try {
    $publishers = Publisher::all();
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
    
    <title>Holmes & Watson | Bookstore | Publishers Index</title>
    
</head>

<body>
    
    <?php require 'utils/admin_navbar.php'; ?>
    
    <div class="container">
        
        <div class="row filter-row">
            <div class="col-12 col-xl-6 col-lg-6 col-md-4 col-sm-6 table-name-col">
                <h2 class="section-heading">Publishers</h2>
            </div>
            
            <div class="col-12 col-xl-3 offset-xl-3 col-lg-3 offset-lg-3 col-md-4 offset-md-4 col-sm-6">
                <a class="btn btn-primary" href="admin_publishers_create.php" role="button">Add a publisher</a>
            </div>
        </div>
        
        <div class="row table-row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table">
                        
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Headquarters</th>
                                <th>Website</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach ($publishers as $publisher) { ?>
                                <tr data-id="<?= $publisher->id ?>">
                                    <td><a href="admin_publishers_show.php?id=<?= $publisher->id ?>"><?= $publisher->name ?></a></td>
                                    <td><?= $publisher->address ?></td>
                                    <td><?= $publisher->website ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <?php require 'utils/am_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
    
</html>

