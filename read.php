
<div class="form-container">
    <p>This is the requested Post:</p>

    <p>Post ID: <?php echo $individualPost ['post_id']; ?></p>
    <p>Post Title: <?php echo $individualPost ['post_title']; ?></p>
    <p>Post Content: <?php echo $individualPost ['post_content']; ?></p>
    <?php 
    $_FILES = '/Applications/XAMPP/xamppfiles/htdocs/Pellag/views/images/' . $individualPost['post_title'] . '.jpeg';

    if (file_exists($_FILES)){
        $img = "<img src='$_FILES' width='150'/>";
        echo $img;
    }
   else {
        echo "<img src='/Applications/XAMPP/xamppfiles/htdocs/Pellag/views/images/standard/_noproductimage.png' width='250'/>";
   }
  ?> 
</div>

