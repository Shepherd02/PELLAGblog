<?php if (!isset($_SESSION['user_id'])) {
    header('Location: /pellag/index.php?controller=User&action=logIn', true, 302);
} ?>

<div class="form-container" style="text-align: center; padding: 0; width: 70%; margin: 0 auto">

            <div class="dashboardcard">
                <h5 style="text-align: center">CREATE NEW POST</h5>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_title"></label>
                <input type="text" class="form-control" name="post_title" id="post_title" placeholder="Post title"
                       required/>
            </div>

            <div class="form-group">
                <label for="post_content"></label>
                <textarea rows="5" maxlength="7500" class="md-textarea form-control" name="post_content" id="post_content" placeholder="Post Content"></textarea>
                <small class="form-text text-muted">7500 characters</small>
            </div>

            <button type="submit" name="createpost" class="btn btn-custom"><i class="fas fa-save"></i> PUBLISH</button>

        </form>
    </div>

</div>