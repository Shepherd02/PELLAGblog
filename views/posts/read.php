<?php if (!isset($_SESSION['user_id'])) {
    header('Location: /pellag/index.php?controller=User&action=logIn', true, 302);
} ?>

<div class="form-container">
    <div class="card card-post">
        <div class="card-header" style="text-align: center">
            <h5 class="card-title"><?= $individualPost['post_title']; ?></h5>
            <p class="card-text post-text"><?= $individualPost['first_name']; ?> <?= $individualPost['last_name']; ?></p>
            <p class="card-text post-text"><i class="fas fa-calendar-day"></i> <?= $individualPost['date_created']; ?>
            </p>
        </div>
        <div class="card-body">
            <p class="card-text post-text"><?= $individualPost['post_content']; ?></p>
        </div>
        <div class="card-footer">
            <a class="btn btn-custom"
               href='?controller=Comment&action=showAllComments&post_id=<?= $individualPost['post_id']; ?>'>
                <i class="far fa-comments"></i> <?= $individualPost['allCommentsCounts']; ?></a>
        </div>

    </div>

    <!--    only author can delete the post-->

    <div class="btn-group-sm" style="text-align: center;" role="group" aria-label="Delete the post">
        <a class="btn btn-custom"
           href='?controller=Post&action=readAll'>
            BACK TO ALL POSTS
        </a>
        <?php if ($_SESSION['user_id'] && $_SESSION['user_id'] === $individualPost['user_id']) : ?>
            <a class="btn btn-success"
               href='?controller=Post&action=update&post_id=<?= $individualPost['post_id']; ?>'>
                UPDATE
            </a>
            <a class="btn btn-warning"
               href='?controller=Post&action=delete&post_id=<?= $individualPost['post_id']; ?>'>
                DELETE
            </a>
        <?php endif ?>
    </div>


</div>


<!--    <a class="btn btn-secondary"
        href='?controller=Post&action=update&post_id=<?php echo $individualpost['post_id']; ?>'>
        Update Post
    </a>

-->
<!--    <?php // $file = 'views/images/' . $post->name . '.jpeg'; ?>

    <?php // if (file_exists($file)) : ?>
        <img src='$file' width='150'/>
    <?php // else : ?>
        <img src='views/images/standard/_noproductimage.png' width='150'/>
    <?php // endif; ?>
-->

	
