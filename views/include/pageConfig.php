<?php

    switch ($_SERVER['REQUEST_URI']) {

        case '/pellag/index.php?controller=Pages&action=home':
            $CURRENT_PAGE = 'home';
            $PAGE_TITLE = 'Home';
            break;
        case '/pellag/index.php?controller=Post&action=readAll':
            $CURRENT_PAGE = 'readAll';
            $PAGE_TITLE = 'All Posts';
            break;
        case '/pellag/index.php?controller=Post&action=create':
            $CURRENT_PAGE = 'create';
            $PAGE_TITLE = 'Create New Post';
            break;
        case '/pellag/index.php?controller=User&action=logIn':
            $CURRENT_PAGE = 'logIn';
            $PAGE_TITLE = 'Login';
            break;
        case '/pellag/index.php?controller=User&action=registerUser':
            $CURRENT_PAGE = 'registerUser';
            $PAGE_TITLE = 'Register';
            break;
        case '/pellag/index.php?controller=User&action=dashboard':
            $CURRENT_PAGE = 'dashboard';
            $PAGE_TITLE = 'dashboard';
            break;
        default:
            $CURRENT_PAGE = 'home';
            $PAGE_TITLE = 'Home';
    }

