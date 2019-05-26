<?php if (!isset($_SESSION['user_id'])) {
    header('Location: /pellag/index.php?controller=User&action=logIn', true, 302);
} ?>

<div class="form-container" style="text-align: center; padding: 0; width: 70%; margin: 0 auto">

    <div class="dashboardcard">
        <h5 style="text-align: center">UPDATE INSTAGRAM</h5>
        <form id="editinstagram" method="post" action="">

            <div class="form-group">
                <label for="editinstagram"></label>
                <input name="editinstagram" id="editinstagram" type="text" class="form-control" required
                       placeholder="Update your Instagram handler"/>
            </div>

            <input type="submit" id="editinstagram" class="btn btn-custom"/>

        </form>
    </div>
</div>
