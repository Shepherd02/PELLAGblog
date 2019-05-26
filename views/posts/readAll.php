<?php if (!isset($_SESSION['user_id'])) {
    header('Location: /pellag/index.php?controller=User&action=logIn', true, 302);
} ?>

<?php if (isset($allPosts) && is_array($allPosts) && count($allPosts) !== 0) : ?>

    <div class="dashboardcard">
        <h5 style="text-align: center">SEARCH POSTS</h5>
        <input type="text" id="search-data" name="searchData" class="form-control"
               placeholder="Post Title..."
               autocomplete="off"/>
        <small class="form-text text-muted">Word length should be greater than 3</small>

        <div id="search-result-container" style="display:none; ">
        </div>
    </div>

    <?php foreach ($allPosts as $Post) : ?>
        <div class="card card-post">
            <div class="card-header">
                <h5 class="card-title"><?= $Post['post_title']; ?></h5>
            </div>
            <div class="card-body">
                <p class="card-text post-text text-truncate"
                   style="word-wrap: break-word;"><?= $Post['post_content']; ?></p>
                <div class="btn-group-sm" role="group" aria-label="Basic example">
                    <a class="btn btn-custom"
                       href='?controller=Post&action=read&post_id=<?= $Post['post_id']; ?>'>
                        READ MORE
                    </a>
                    <a class="btn-custom btn"
                       href='?controller=Comment&action=showAllComments&post_id=<?= $Post['post_id']; ?>'>
                        <i class="far fa-comments"></i> <?= $Post['allCommentsCounts']; ?></a>

                </div>

            </div>
            <div class="card-footer">
                <small class="text-muted">Created
                    by <?= $Post['first_name'] . ' ' . $Post['last_name']; ?></small>
            </div>
        </div>
    <?php endforeach; ?>

<?php else : ?>

    <div class="dashboardcard button-center">
        <blockquote class="author-bio">You have no posts yet...</blockquote>
    </div>
    <div class="button-center">
        <a href="index.php?controller=Post&action=create" class="btn-custom btn btn-center">Let's get started!</a>
    </div>
<?php endif; ?>

