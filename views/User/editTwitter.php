<?php if (!isset($_SESSION['user_id'])) {
    header('Location: /pellag/index.php?controller=User&action=logIn', true, 302);
} ?>

<div class="form-container" style="text-align: center; padding: 0; width: 70%; margin: 0 auto">

    <div class="dashboardcard">
        <h5 style="text-align: center"><i class="fab fa-twitter"></i> UPDATE TWITTER</h5>

        <form id="edittwitter" method="post" action="">

            <div class="form-group">
                <input name="edittwitter" id="edittwitter" type="text" class="form-control" placeholder="Update your Twitter handler" required/>
            </div>

            <input type="submit" id="edittwitter" class="btn btn-custom"/>

        </form>
    </div>
</div>

