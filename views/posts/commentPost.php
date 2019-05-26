<?php if (!isset($_SESSION['user_id'])) {
    header('Location: /pellag/index.php?controller=User&action=logIn', true, 302);
} ?>

<div class="form-container" style="text-align: center; padding: 0; width: 70%; margin: 0 auto">

    <div class="dashboardcard">
        <h5 style="text-align: center">ADD COMMENT</h5>
        <?php if ($_SESSION['user_id']) : ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="comment_content"></label>
                    <textarea rows="3" maxlength="250" class="md-textarea form-control" name="comment_content"
                              id="comment_content" placeholder="Please make your comment here"></textarea>
                    <small class="form-text text-muted">250 characters</small>
                </div>

                <button type="submit" name="create_comment" class="btn btn-custom">PUBLISH COMMENT</button>

            </form>
        <?php endif ?>
    </div>
</div>
