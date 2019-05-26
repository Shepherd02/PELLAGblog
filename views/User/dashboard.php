<?php if (!isset($_SESSION['user_id'])) {
    header('Location: /pellag/index.php?controller=User&action=logIn', true, 302);
} ?>

<div class="dashboardheader">
    <h2 class="gray">Welcome, <?php echo $_SESSION['first_name']; ?>!</h2>
</div>

<div class="dashboardrow">

    <div class="dashboardleftcolumn">

        <?php if ($myPosts === []) : ?>
            <div class="dashboardcard button-center">
                <blockquote class="author-bio">You have no posts yet...</blockquote>
            </div>
            <div class="button-center">
                <a href="index.php?controller=Post&action=create" class="btn btn-custom btn-center">Let's get
                    started!</a>
            </div>
        <?php else: ?>

            <?php foreach ($myPosts as $Post) : ?>
                <div class="dashboardcard">

                    <li class="list-group-item"><?= $Post['post_title'] ?><br>
                        <small> created by <?= $Post['first_name']; ?> <?= $Post['last_name']; ?></small>
                        <button type="button" class="btn-info btn btn-custom collapsed" data-toggle="collapse"
                                data-target="#mypost-<?= $Post['post_id']; ?>">
                            Open
                        </button>
                        <div id="mypost-<?= $Post['post_id']; ?>" class="collapse">
                            <?= $Post['post_content']; ?>
                        </div>
                    </li>

                </div>
            <?php endforeach; ?>
        <?php endif ?>
    </div>


    <div class="dashboardrightcolumn">

        <div class="dashboardcard">
            <h5 style="text-align: center">SEARCH POSTS</h5>
            <input type="text" id="search-data" name="searchData" class="form-control"
                   placeholder="Post Title..."
                   autocomplete="off"/>
            <small class="form-text text-muted">Word length should be greater than 3</small>

            <div id="search-result-container" style="display:none; ">
            </div>
        </div>

        <div class="dashboardcard">

            <h5>ABOUT ME</h5>
            <?php if ($_SESSION['bio']) : ?>
                <div style="margin: 1rem auto">
                    <blockquote class="author-bio">
                        <?= $_SESSION['bio']; ?>
                    </blockquote>
                </div>
                <a href="index.php?controller=User&action=editBio" class="btn btn-custom"><i
                            class="fas fa-user-edit"></i></a>
            <?php else : ?>
                <div style="margin: 1rem auto">
                    <blockquote class="author-bio">
                        No bio written yet...
                    </blockquote>
                </div>
                <a href="index.php?controller=User&action=editBio" class="btn btn-custom">ADD</a>
            <?php endif ?>

        </div>
        <div class="dashboardcard">

            <h5>MOST RECENT POSTS</h5>

            <ul class="list-group list-group-flush posts-dashboard">
                <?php foreach ($allPosts as $Post) : ?>
                    <li class="list-group-item">
                        <a href="index.php?controller=Post&action=read&post_id=<?= $Post['post_id']; ?>">
                            <?= $Post['post_title']; ?>
                        </a>
                        <br>
                        <small> created on <?= $Post['date_created']; ?>
                            by <?= $Post['first_name']; ?> <?= $Post['last_name']; ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
            <br>
            <a href="index.php?controller=Post&action=readAll" class="btn btn-custom">ALL POSTS</a>
        </div>

        <div class="dashboardcard">
            <h5>FOLLOW ME</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <?php if ($_SESSION['twitter_handle']): ?>

                        <div class="social-media-buttons mb-2">
                            <a class="social-media" href="https://www.twitter.com/<?= $_SESSION['twitter_handle']; ?>">
                                <i class="fab fa-twitter fa-2x"></i> <?= $_SESSION['twitter_handle']; ?></a>
                        </div>
                        <div class="social-media-buttons mb-2">
                            <a href="index.php?controller=User&action=editTwitter" class="btn btn-custom"><i
                                        class="fas fa-user-edit"></i></a>
                        </div>


                    <?php else : ?>
                        <div class="social-media-buttons mb-2">
                            <p><i class="fab fa-twitter fa-2x"></i> No account linked</p>
                        </div>
                        <div class="social-media-buttons mb-2">
                            <a href="index.php?controller=User&action=editTwitter" class="btn btn-custom"><i
                                        class="fas fa-user-edit"></i></a>
                        </div>

                    <?php endif ?>
                </li>

                <li class="list-group-item"></i>
                    <?php if ($_SESSION['instagram_handle']): ?>

                        <div class="social-media-buttons mb-2">
                            <a class="social-media"
                               href="https://www.instagram.com/<?= $_SESSION['instagram_handle']; ?>">
                                <i class="fab fa-instagram fa-2x"></i> <?= $_SESSION['instagram_handle']; ?></a>
                        </div>

                        <div class="social-media-buttons mb-2">
                            <a href="index.php?controller=User&action=editInstagram" class="btn btn-custom">
                                <i class="fas fa-user-edit"></i></a>
                        </div>


                    <?php else : ?>
                        <div class="social-media-buttons mb-2">
                            <p><i class="fab fa-instagram fa-2x"></i> No account linked</p>
                        </div>
                        <div class="social-media-buttons mb-2">
                            <a href="index.php?controller=User&action=editInstagram" class="btn btn-custom">
                                <i class="fas fa-user-edit"></i></a>
                        </div>

                    <?php endif ?>
                </li>
            </ul>

        </div>
    </div>
</div>


