<!--pageConfig has all the info about what is the
$CURRENT_PAGE and how to display Title in the browser's Tab-->
<?php include 'views/include/pageConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--head has all the info about what should be in the html head,
    also it loads all the meta only on the Home Page-->
    <?php include 'views/include/head.php'; ?>
    <!--Add the custom CSS link-->
    <link rel="stylesheet" type="text/css" href='views/css/styles.css'/>
</head>

<body>

<?php require_once 'Database/MY_PDO.php'; ?>
<!--each page has two components, the controller and action
so any other link must contain those components-->

<?php if (isset($_GET['controller'], $_GET['action'])) :
    $controller = $_GET['controller'];
    $action = $_GET['action'];
else :
    $controller = 'Pages';
    $action = 'home'; ?>
<?php endif; ?>


<header>
    <!--Page holding all navigation elements-->
    <?php include 'views/include/navigation.php'; ?>
</header>


<main class="main-content">
    <!--main component-->
    <div class="container">
        <?php echo $content; ?>
    </div>
</main>

<footer id="footer">
    <div class="container footer-container">
        <span class="text-muted">&copy; Pellag </span>
        <img id="upper_right" src="views/images/skylogo.jpg" href="index.php?controller=Pages&action=home" alt="Banner"
             class="img-responsive" width="240" height="75">
    </div>
</footer>


</body>

</html>

<script>
    var images = [
        'views/images/background/yellow.png',
        'views/images/background/blue.png',
        'views/images/background/red.png',
        'views/images/background/dark-blue.png'];

    setInterval(function () {
        var url = images[Math.floor(Math.random() * images.length)];
        document.body.style.backgroundImage = 'url(' + url + ')';
    }, 10000);
</script>
