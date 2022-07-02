<?php
require_once 'utils/functions.php';
require_once 'classes/Book.php';
require_once 'classes/Author.php';

try {
    $books = Book::all();
    $newBooks = Book::newBookReleases();
    $peLibraryBooks = Book::PELibraryBooks();
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
    
    <title>Holmes & Watson | Bookstore</title>
    
</head>

<body>
    
    <?php require 'utils/u_navbar.php'; ?>
        
    <!-- Index Banner 1 -->
    <div class="jumbotron jumbotron-fluid jumbotron-index main-index-banner-one">
        <div class="jumbotron-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-7 col-xl-3 col-lg-3 col-md-5 jumbotron-content">
                        <h3 class="jumbotron-heading">
                            <a href=#">Top Books of<br /> the Month</a>
                        </h3>
                        <p class="jumbotron-para">
                            Penned by top authors, these books are unmissable!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Index Banner 1 end -->
    
    <div class="container">
        
        <!-- Section 1 Header -->
        <div class="row section-header-row">
            <div class="col-lg-9 col-md-9">
                <h3 class="section-heading">New Releases</h3>
            </div>
            
            <div class="col-lg-3 col-md-3 d-none d-md-block d-lg-block d-xl-block section-header-link">
                <a href="#">
                    <h4 class="view-more-link">View More</h4>
                </a>
            </div>
        </div>
        <!-- Section 1 Header End -->
        
        <!-- Section 1 Books Carousel -->
        <div class="row books-carousel-row">
           
            <!-- Book Card Slides -->
            <?php foreach ($newBooks as $book) { ?>
                <div class="col-6 col-xl-2 col-lg-3 col-md-4 col-sm-6 book-card-slide">
                    <!-- Cover Image -->
                    <div class="book-cover-sm">
                        <a href="books_show.php?id=<?= $book->id ?>">
                            <img src="<?= $book->cover ?>" class="img-fluid" alt="<?= $book->isbn ?>">
                        </a>
                    </div>
                    <!-- Card Body -->
                    <div class="book-card-body">
                        <a href="books_show.php?id=<?= $book->id ?>">
                            <?php if (strlen($book->title) > 30) { ?>
                                <h5 class="book-title-sm"><?= nl2br(substr($book->title,0,31)); ?>...</h5>
                            <?php } else if (strlen($book->title) < 30)  { ?>
                                <h5 class="book-title-sm"><?= $book->title ?></h5>
                            <?php } ?>
                        </a>
                        <h6 class="book-author-sm">
                            <?php foreach ($authors = Author::findByBookId($book->id) as $author) { ?>
                                <a href="authors_show.php?id=<?= $author->id ?>">
                                    <?= $author->first_name ?> <?= $author->last_name ?><br>
                                </a>
                            <?php } ?> 
                        </h6>
                    </div>
                </div>
            <?php } ?>
            
        </div>
        <!-- Section 1 Books Carousel End -->
        
        <!-- View More Link (Mobile only) -->
        <div class="row d-block d-sm-block d-md-none link-row">
            <div class="col-12">
                <a href="#">
                    <h4 class="view-more-link">View More</h4>
                </a>
            </div>
        </div>
        <!-- View More Link (Mobile Only) End -->
        
        <!-- Section 2 Header -->
        <div class="row section-header-row">
            <div class="col-lg-9 col-md-9">
                <h3 class="section-heading">The Penguin English Library<br/> 3 for &euro;15</h3>
            </div>
            
            <div class="col-lg-3 col-md-3 d-none d-md-block d-lg-block d-xl-block section-header-link">
                <a href="#">
                    <h4 class="view-more-link">View More</h4>
                </a>
            </div>
        </div>
        <!-- Section 2 Header End -->
        
        <!-- Section 2 Books Carousel -->
        <div class="row books-carousel-row">
           
            <!-- Book Card Slides -->
            <?php foreach ($peLibraryBooks as $book) { ?>
                <div class="col-6 col-xl-2 col-lg-3 col-md-4 col-sm-6 book-card-slide">
                    <!-- Cover Image -->
                    <div class="book-cover-sm">
                        <a href="books_show.php?id=<?= $book->id ?>">
                            <img src="<?= $book->cover ?>" class="img-fluid" alt="<?= $book->isbn ?>">
                        </a>
                    </div>
                    <!-- Card Body -->
                    <div class="book-card-body">
                        <a href="books_show.php?id=<?= $book->id ?>">
                            <?php if (strlen($book->title) > 30) { ?>
                                <h5 class="book-title-sm"><?= nl2br(substr($book->title,0,31)); ?>...</h5>
                            <?php } else if (strlen($book->title) < 30)  { ?>
                                <h5 class="book-title-sm"><?= $book->title ?></h5>
                            <?php } ?>
                        </a>
                        <h6 class="book-author-sm">
                            <?php foreach ($authors = Author::findByBookId($book->id) as $author) { ?>
                                <a href="authors_show.php?id=<?= $author->id ?>">
                                    <?= $author->first_name ?> <?= $author->last_name ?><br>
                                </a>
                            <?php } ?> 
                        </h6>
                    </div>
                </div>
            <?php } ?>
            
        </div>
        <!-- Section 2 Books Carousel End -->
        
        <!-- View More Link (Mobile only) -->
        <div class="row d-block d-sm-block d-md-none link-row">
            <div class="col-12">
                <a href="#">
                    <h4 class="view-more-link">View More</h4>
                </a>
            </div>
        </div>
        <!-- View More Link (Mobile Only) End -->

    </div>
    
    <!-- Index Banner 2 -->
    <div class="jumbotron jumbotron-fluid jumbotron-index main-index-banner-two">
        <div class="jumbotron-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-7 col-xl-3 col-lg-3 col-md-5 jumbotron-content">
                        <h3 class="jumbotron-heading">
                            <a href="#">Paperbacks We Love</a>
                        </h3>
                        <p class="jumbotron-para">
                            Buy 2, Get the 3rd Free!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Index Banner 2 end -->
    
    <!-- Section 3 -->
    <div class="container articles-container">
    
        <!-- Section 3 Header -->
        <div class="row section-header-row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <h3 class="section-heading">Recommended Reading</h3>
            </div>
        </div>
        <!-- Section 3 Header End -->
        
        <!-- Articles Row -->
        <div class="row">
            
            <!-- Article Cards -->
            <div class="col-12 col-xl-4 col-lg-4 col-md-4 col-sm-6 article-card">
                <!-- Article Card Cover -->
                <a href="#">
                    <img src="images/article1.jpg" class="img-fluid" alt="If Beale Street Could Talk (2019)">
                </a>
                
                <!-- Article Card Body -->
                <div class="article-card-body">
                    <a href="#">
                        <h6 class="article-category">Page to Screen</h6>
                    </a>
                    <a href="#">
                        <h4 class="article-title">15 Film and TV Adaptations to watch in 2019</h4>
                    </a>
                    <div class="article-info">
                        <h6 class="article-author">by H&amp;W Editors</h6>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-xl-4 col-lg-4 col-md-4 col-sm-6 article-card">
                <!-- Article Card Cover -->
                <a href="#">
                    <img src="images/article2.jpg" class="img-fluid" alt="Classic Books">
                </a>
                
                <!-- Article Card Body -->
                <div class="article-card-body">
                    <a href="#">
                        <h6 class="article-category">Recommendations</h6>
                    </a>
                    <a href="#">
                        <h4 class="article-title">100 Must-Read Classic Books</h4>
                    </a>
                    <div class="article-info">
                        <h6 class="article-author">by H&amp;W Readers</h6>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-xl-4 col-lg-4 col-md-4 col-sm-6 article-card">
                <!-- Article Card Cover -->
                <a href="#">
                    <img src="images/article3.jpg" class="img-fluid" alt="Journaling">
                </a>
                
                <!-- Article Card Body -->
                <div class="article-card-body">
                    <a href="#">
                        <h6 class="article-category">Features</h6>
                    </a>
                    <a href="#">
                        <h4 class="article-title">The Benefits of Journaling to Shape Your Future</h4>
                    </a>
                    <div class="article-info">
                        <h6 class="article-author">by Hannah Woodhead</h6>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Articles Row End -->
        
        <!-- More Articles Button -->
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12 col-sm-12 section-button">
                <a class="btn btn-primary" href="#" role="button">More Articles</a>
            </div>
        </div>
        
    </div>
    
    <?php require 'utils/u_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
    
</html>
