<?php if (!isset($_SESSION['user_id'])) {
    header('Location: /pellag/index.php?controller=User&action=logIn', true, 302);
} ?>

<?php if (isset($allImages) && is_array($allImages) && count($allImages) !== 0) : ?>
    <div class="card-deck">
    <?php foreach ($allImages as $Image) : ?>
        <div class="card" style="min-width: 150px; flex: 0.3 0 0">
            <img alt="image" style="object-fit: contain; max-width:100%; height:auto;" class="card-img-top" src="views/images/<?= $Image['image_name']; ?>"/>
            <div class="card-header">
                <h5 class="card-title"><?= $Image['image_title']; ?></h5>
            </div>
            <div class="card-body">
                <p class="card-text post-text" style="word-wrap: break-word;">
                    <?= $Image['image_description']; ?>
                </p>
                <?php if ($_SESSION['user_id'] && $_SESSION['user_id'] === $Image['user_id']) : ?>
                    <a class="btn btn-warning"
                       href='?controller=Image&action=delete&gallery_id=<?= $Image['gallery_id']; ?>'>
                        DELETE
                    </a>
                <?php endif ?>
            </div>
            <div class="card-footer">
                <small class="text-muted">Created
                    by <?= $Image['first_name'] . ' ' . $Image['last_name']; ?></small>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

<?php else : ?>
    <div class="dashboardcard button-center">
        <blockquote class="author-bio">No images in the gallery yet... </blockquote>
    </div>
    <div class="button-center">
        <a href="index.php?controller=Image&action=upload" class="btn-custom btn btn-center">Let's get started!</a>
    </div>

<?php endif; ?>
