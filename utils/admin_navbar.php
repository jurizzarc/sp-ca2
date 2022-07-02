<div class="navbar-container">
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-custom">

            <!-- Brand -->
            <div class="navbar-brand">
                <img src="images/brand.png" class="img-fluid" alt="Brand Logo">
            </div>

            <!-- Menu Icon -->
            <button class="navbar-toggler order-first" type="button" data-toggle="collapse" 
                    data-target="#navbarLinks" aria-controls="navbarLinks" aria-expanded="false" 
                    aria-label="Toggle navbar links">
                <span class="lnr lnr-menu"></span>
            </button>
            
            <!-- Search Icon (Mobile) -->
            <button class="navbar-toggler" data-toggle="modal" data-target="#searchBar" type="button">
                <span class="lnr lnr-magnifier"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarLinks">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tables
                        </a>
                        <div class="dropdown-menu" style="margin-right:160px;" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="admin_books_index.php">Books</a>
                            <a class="dropdown-item" href="admin_authors_index.php">Authors</a>
                            <a class="dropdown-item" href="admin_genres_index.php">Genres</a>
                            <a class="dropdown-item" href="admin_publishers_index.php">Publishers</a>
                        </div>
                    </li>
                    <!-- Dropdown Menu -->
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                                echo $user->username;
                            ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            if (is_logged_in()) {
                                echo '<a class="dropdown-item" href="#">Dashboard</a>';
                                echo '<a class="dropdown-item" href="#">Settings</a>';
                                echo '<div class="d-none d-xl-block d-lg-block d-md-block dropdown-divider"></div>';
                                echo '<a class="dropdown-item" href="logout.php">Log Out</a>';
                            } 
                            ?> 
                        </div>
                    </li>
                    
                    <li class="nav-item d-none d-xl-block d-lg-block d-md-block">
                        <a class="nav-link" data-toggle="modal" data-target="#searchBar">
                            <span class="lnr lnr-magnifier"></span>
                        </a>
                    </li>
                </ul>
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

