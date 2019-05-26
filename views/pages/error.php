<?php if ($exception): ?>
    <div class="form-container">
        <div class="alert alert-warning" role="alert">
            <?php xdebug_print_function_stack($exception); ?>
        </div>
    </div>
<?php endif ?>