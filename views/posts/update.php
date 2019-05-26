<div class="form-container" style="text-align: center; padding: 0; width: 70%; margin: 0 auto">

    <div class="dashboardcard">
        <h5 style="text-align: center">UPDATE THE POST</h5>

        <form action="" id="updatepost" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_title"></label>
                <input type="text" value="<?= $individualPost['post_title']; ?>" class="form-control" name="post_title"
                       id="post_title" placeholder="Post title"
                       required/>
            </div>
            <div class="form-group">
                <label for="post_content"></label>
                <textarea rows="3" maxlength="7500" class="md-textarea form-control" name="post_content"
                          id="post_content"
                          placeholder="Post Content"><?= $individualPost['post_content']; ?></textarea>
                <small class="form-text text-muted">7500 characters</small>
            </div>

            <button type="submit" name="updatepost" class="btn btn-custom"><i class="fas fa-save"></i> UPDATE</button>

        </form>
    </div>
</div>