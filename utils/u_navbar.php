<div class="navbar-container">
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-custom">

            <!-- Brand -->
            <a class="navbar-brand" href="index.php">
                <img src="images/brand.png" class="img-fluid" alt="Brand Logo">
            </a>

            <!-- Menu Icon -->
            <button class="navbar-toggler order-first" type="button" data-toggle="collapse" 
                    data-target="#navbarLinks" aria-controls="navbarLinks" aria-expanded="false" 
                    aria-label="Toggle navbar links">
                <span class="lnr lnr-menu"></span>
            </button>

            <!-- Basket Icon -->
            <button class="navbar-toggler" type="button">
                <span class="lnr lnr-cart"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarLinks">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="books_index.php">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="authors_index.php">Authors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="genres_index.php">Genres</a>
                    </li>
                    <li class="nav-item d-none d-xl-block d-lg-block d-md-block">
                        <a class="nav-link" data-toggle="modal" data-target="#searchBar">
                            <span class="lnr lnr-magnifier"></span>
                        </a>
                    </li>
                    <li class="nav-item d-none d-xl-block d-lg-block d-md-block">
                        <a class="nav-link" href="#">
                            <span class="lnr lnr-cart"></span>
                        </a>
                    </li>
                    <!-- Dropdown Menu -->
                    <li class="nav-item d-none d-xl-block d-lg-block d-md-block">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="lnr lnr-user"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            require_once 'utils/functions.php';

                            if (!is_logged_in()) {
                                $user = $_SESSION['user'];
                                echo '<a class="dropdown-item" href="login_form.php">Log In</a>';
                                echo '<a class="dropdown-item" href="register_form.php">Register</a>';
                            } else {
                                echo '<a class="dropdown-item" href="#">Wish List</a>';
                                echo '<a class="dropdown-item" href="#">Orders</a>';
                                echo '<a class="dropdown-item" href="#">Settings</a>';
                                echo '<div class="dropdown-divider"></div>';
                                echo '<a class="dropdown-item" href="logout.php">Log Out</a>';
                            }
                            ?> 
                        </div>
                    </li>
                    
                    <!-- Dropdown Menu (Mobile) -->
                    <li class="nav-item d-block d-sm-block d-md-none">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Account
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            require_once 'utils/functions.php';

                            if (!is_logged_in()) {
                                $user = $_SESSION['user'];
                                echo '<a class="dropdown-item" href="login_form.php">Log In</a>';
                                echo '<a class="dropdown-item" href="register_form.php">Register</a>';
                            } else {
                                echo '<a class="dropdown-item" href="#">Wish List</a>';
                                echo '<a class="dropdown-item" href="#">Orders</a>';
                                echo '<a class="dropdown-item" href="#">Settings</a>';
                                echo '<a class="dropdown-item" href="logout.php">Log Out</a>';
                            }
                            ?> 
                        </div>
                    </li>
                    
                </ul>
                
                <form class="d-block d-sm-block d-md-none">
                    <div class="form-group">
                        <input type="search" class="form-control" id="search" placeholder="Search">
                    </div>
                </form>
                
            </div>

        </nav>
    </div>
    
    <!-- Modal for Search Bar -->
    <div class="modal fade" id="searchBar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="lnr lnr-cross"></span>
                            </button>
                        </div>
                        <div class="col-lg-12">
                            <form>
                                <div class="form-group">
                                    <input type="search" class="form-control" id="seach" 
                                           placeholder="Search book, author, series, ISBN, article">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
</div>