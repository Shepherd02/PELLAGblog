<?php
    // Initialize the session.
    session_start();

    // Global user object, is populated from the database by looking up the user,
    // via the 'user_id' SESSION variable populated in the login form.
    require_once 'Database/MY_PDO.php';
    $user = NULL;
    if (isset($_SESSION['user_id'])) {
        $pdo = MY_PDO::getInstance();
        $stmt = $pdo->prepare('SELECT * FROM blog_user WHERE user_id = :user_id');
        $stmt->bindValue(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Parse the url and determine which controller to route to and call it.
    // It returns a string representing the content to be placed in the body
    // of the page.
    require_once 'routes.php';
    $context['content'] = route();
    // Render the html template, and populated the context with a 'content'
    // variable representing the page content.
    echo render('template.php', $context);
