<?php if (!isset($_SESSION['user_id'])) {
    header('Location: /pellag/index.php?controller=User&action=logIn', true, 302);
} ?>

<?php if (isset($allComments) && is_array($allComments) && count($allComments) !== 0) : ?>
    <div class="dashboardcard">
        <h5><?= $allComments[0]['post_title']; ?></h5>
        <small> created
            by <?= $allComments[0]['first_name']; ?> <?= $allComments[0]['last_name']; ?></small>
    </div>

    <ul class="dashboardcard">

        <h5><?= count($allComments) === 1 ? count($allComments) . ' COMMENT' : count($allComments) . ' COMMENTS'; ?></h5>

        <?php foreach ($allComments as $Comment) : ?>
            <li class="list-group-item dashboardcard">
                <small>Comment created 
                    by <?= $_SESSION['first_name']; ?> 
                </small>
                <button type="button" class="btn btn-info collapsed"
                        data-toggle="collapse"
                        data-target="#comment-<?= $Comment['comment_id']; ?>">
                    More
                </button>
                <div id="comment-<?= $Comment['comment_id']; ?>" class="collapse">
                    <?= $Comment['comment_content']; ?>
                </div>
                <!--    only comment author or post_author can delete the post-->
                <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] === $Comment['comment_author'] ||
                        $_SESSION['user_id'] === $Comment['post_author'])) : ?>
                    <div>
                        <small class="btn-group-sm" role="group" aria-label="Basic example">
                            <a class="btn btn-warning"
                               href='?controller=Comment&action=delete&comment_id=<?= $Comment['comment_id']; ?>'>
                                DELETE
                            </a>
                        </small>
                    </div>
                <?php endif ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="btn-group-sm" style="text-align: center;" role="group" aria-label="Create a comment">
        <a class="btn btn-custom"
           href='?controller=Post&action=read&post_id=<?= $_GET['post_id']; ?>'>
            <i class="fas fa-backward"></i> BACK TO THE POST
        </a>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id']) : ?>
            <a class="btn btn-custom"
               href='?controller=Comment&action=create&post_id=<?= $_GET['post_id']; ?>'>
                <i class="fas fa-comment"></i> ADD A COMMENT
            </a>
        <?php endif ?>
    </div>

<?php else : ?>

    <div class="dashboardcard button-center">
        <blockquote class="author-bio">This post does not have any comments yet</blockquote>
    </div>
    <div class="button-center">
        <div class="btn-group-sm" style="text-align: center;" role="group" aria-label="Create a comment">

            <a class="btn btn-custom"
               href='?controller=Post&action=read&post_id=<?= $_GET['post_id']; ?>'>
                <i class="fas fa-backward"></i> BACK TO THE POST
            </a>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id']) : ?>
                <a class="btn btn-custom"
                   href='?controller=Comment&action=create&post_id=<?= $_GET['post_id']; ?>'>
                    <i class="fas fa-comment"></i> ADD A COMMENT
                </a>
            <?php endif ?>
        </div>

    </div>


<?php endif ?>
