<div class="jumbotron jumbotron-nav">
    <img src="views/images/pellag-logo.png" href="index.php?controller=Pages&action=home" alt="Banner"
         class="img-responsive">
    
    <nav class="navbar navbar-expand-lg navbar-light">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($CURRENT_PAGE === 'home') ? 'active' : ''; ?>"
                       href="index.php?controller=Pages&action=home"><i class="fas fa-home"></i> HOME</a>
                </li>
                <?php if (isset($_SESSION['user_id']) === true) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($CURRENT_PAGE === 'readAll') ? 'active' : '' ?>"
                           href="index.php?controller=Post&action=readAll"><i class="fas fa-columns"></i> POSTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($CURRENT_PAGE === 'viewAll') { ?> active <?php } ?>"
                           href="index.php?controller=Image&action=viewAll"><i class="fas fa-camera-retro"></i> GALLERY</a>
                    </li>

                    <!--CREATORS LODGE-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="true" aria-expanded="false"> CREATORS LODGE</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item <?= ($CURRENT_PAGE === 'create') ? 'active' : '' ?>"
                               href="index.php?controller=Post&action=create"><i class="fas fa-pen-nib"></i> NEW
                                POST</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?= ($CURRENT_PAGE === 'upload') ? 'active' : '' ?>"
                               href="index.php?controller=Image&action=upload"><i class="far fa-file-image"></i> UPLOAD
                                IMAGE</a>
                        </div>
                    </li>


                <?php endif; ?>


                <!--USER RELATED MENUS-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false"> USER</a>
                    <div class="dropdown-menu">
                        <?php if (isset($_SESSION['user_id']) === true) : ?>
                            <a class="dropdown-item <?php if ($CURRENT_PAGE === 'dashboard') { ?> active <?php } ?>"
                               href="index.php?controller=User&action=dashboard"><i class="fas fa-user-circle"></i> DASHBOARD</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?= ($CURRENT_PAGE === 'logOut') ? 'active' : '' ?>"
                               href="index.php?controller=User&action=logOut"><i class="fas fa-sign-out-alt"></i>
                                LOGOUT</a>
                        <?php else: ?>

                            <a class="dropdown-item <?= ($CURRENT_PAGE === 'registerUser') ? 'active' : '' ?>"
                               href="index.php?controller=User&action=registerUser"><i class="fas fa-user-plus"></i>
                                REGISTER</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?= ($CURRENT_PAGE === 'logIn') ? 'active' : '' ?>"
                               href="index.php?controller=User&action=logIn"><i class="fas fa-sign-in-alt"></i>
                                LOGIN</a>

                        <?php endif; ?>

                    </div>

                </li>

            </ul>
        </div>

    </nav>
</div>



