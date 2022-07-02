<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Author.php';

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];

if ($user->role_id != 1) {
    header("Location: logout.php");
}

try {
    $a_authors = Author::selectByLastName(a);
    $b_authors = Author::selectByLastName(b);
    $c_authors = Author::selectByLastName(c);
    $d_authors = Author::selectByLastName(d);
    $e_authors = Author::selectByLastName(e);
    $f_authors = Author::selectByLastName(f);
    $g_authors = Author::selectByLastName(g);
    $h_authors = Author::selectByLastName(h);
    $i_authors = Author::selectByLastName(i);
    $j_authors = Author::selectByLastName(j);
    $k_authors = Author::selectByLastName(k);
    $l_authors = Author::selectByLastName(l);
    $m_authors = Author::selectByLastName(m);
    $n_authors = Author::selectByLastName(n);
    $o_authors = Author::selectByLastName(o);
    $p_authors = Author::selectByLastName(p);
    $q_authors = Author::selectByLastName(q);
    $r_authors = Author::selectByLastName(r);
    $s_authors = Author::selectByLastName(s);
    $t_authors = Author::selectByLastName(t);
    $u_authors = Author::selectByLastName(u);
    $v_authors = Author::selectByLastName(v);
    $w_authors = Author::selectByLastName(w);
    $y_authors = Author::selectByLastName(y);
    $z_authors = Author::selectByLastName(z);
}
catch (Exception $ex) {
    die($ex->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php require 'utils/styles.php'; ?>
    
    <title>Holmes & Watson | Bookstore | Authors Index</title>
    
</head>

<body>
    
    <?php require 'utils/admin_navbar.php'; ?>

    <div class="container">
        
        <div class="row filter-row">
            <div class="col-12 col-xl-6 col-lg-6 col-md-4 col-sm-6 table-name-col">
                <h2 class="section-heading">Authors</h2>
            </div>
            
            <div class="col-12 col-xl-3 offset-xl-3 col-lg-3 offset-lg-3 col-md-4 offset-md-4 col-sm-6">
                <a class="btn btn-primary" href="admin_authors_create.php" role="button">Add an author</a>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group A -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">A</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($a_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group B -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">B</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($b_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group C -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">C</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($c_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group D -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">D</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($d_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group E -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">E</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($e_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group F -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">F</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($f_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group g -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">G</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($g_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group H -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">H</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($h_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group I -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">I</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($i_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group J -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">J</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($j_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group K -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">K</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($k_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group L -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">L</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($l_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group M -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">M</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($m_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group N -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">N</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($n_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group O -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">O</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($o_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group P -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">P</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($p_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group Q -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">Q</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($q_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group R -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">R</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($r_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group S -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">S</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($s_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group T -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">T</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($t_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group U -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">U</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($u_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group V -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">V</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($v_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group W -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">W</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($w_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group Y -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">Y</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($y_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="row authors-list-row">
            <!-- Group Z -->
            <div class="col-12 letter-heading-col">
                <h2 class="letter">Z</h2>
            </div>
            <div class="col-12 authors-list-col">
                <div class="row">
                    <?php foreach ($z_authors as $author) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 author-item">
                            <a href="admin_authors_show.php?id=<?= $author->id ?>">
                                <?= $author->last_name ?>, <?= $author->first_name ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
    </div>
    
    <?php require 'utils/am_footer.php'; ?>
    
    <?php require 'utils/scripts.php'; ?>
    
</body>
 
</html>