<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav">
        <?php
        require_once 'utils/functions.php';
        
        echo '<li><a href="books_index.php">Books</a></li>';
        echo '<li><a href="authors_index.php">Authors</a></li>';
        echo '<li><a href="genres_index.php">Genres</a></li>';
        echo '<li><a href="publishers_index.php">Publishers</a></li>';
        
        if (!is_logged_in()) {
            echo '<li><a href="login_form.php">Login</a></li>';
            echo '<li><a href="register_form.php">Register</a></li>';
        } else {
            $user = $_SESSION['user'];
            if ($user->role_id == 1) {
                $home = 'admin_dashboard.php';
            } else if ($user->role_id == 2) {
                $home = 'manager_dashboard.php';
            } else if ($user->role_id == 3) {
                $home = 'index.php';
            }
            echo '<li><a href="logout.php">Logout</a></li>';
        }
        ?>
        </ul>
    </div>
</nav>
