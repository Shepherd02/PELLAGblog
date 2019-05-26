<?php

    // Renders the given php file defining all keys in the associative array 'context' as local variables.
    /**
     * @param $path
     * @param array $context
     * @return false|string
     */
    function render($path, $context = array())
    {
        // Turn on output buffering, capture output.
        ob_start();
        // Make the keys in $context available as local variables in the included $path.
        extract($context, EXTR_OVERWRITE);
        // Include template located at $path.
        include $path;
        // Capture output in string $output.
        $output = ob_get_contents();
        // Turn off output buffering.
        ob_end_clean();
        return $output;
    }

    /**
     * @param $controller
     * @param $action
     * @param $param
     * @return mixed
     */
    function call($controller, $action, $param = NULL)
    {
        // require the file that matches the controller name
        require_once 'controllers/' . $controller . 'controller.php';

        // create a new instance of the needed controller
        if ($controller === 'Pages') {
            $controller = new PagesController();
        } else {
            //for all data-driven pages use a specific Controller class
            //we need the model to query the database later in the process
            require_once 'models/' . $controller . '.php';
            $controllerClassName = $controller . 'Controller';
            $controller = new $controllerClassName();
        }
        // call the requested action
        return $controller->{$action}($param);
    }

    function route()
    {
        // For validation we list the allowed controllers and their actions
        // Add an entry for each new controller and its actions
        $controllers = array(
            'Pages' => ['home', 'error',],
            'User' => ['logIn', 'logOut', 'registerUser', 'dashboard', 'editBio', 'editTwitter', 'editInstagram',],
            'Post' => ['readAll', 'read', 'create', 'delete', 'update'],
            'Image' => ['upload', 'delete', 'gallery', 'viewAll'],
            'Comment' => ['create', 'showAllComments', 'delete'],
            'controllerXXX' => ['actionYYY', 'actionZZZ'],
        );

        if (isset($_GET['controller'], $_GET['action'])) {
            $controller = $_GET['controller'];
            $action = $_GET['action'];
        } else {
            $controller = 'Pages';
            $action = 'home';
        }

        // check that the requested controller and action are both allowed
        // if someone tries to access something else they will be redirected
        // to the error action of the pages controller
        if (array_key_exists($controller, $controllers) && in_array($action, $controllers[$controller], TRUE)) {
            return call($controller, $action);
        }
        return call('Pages', 'error');
    }
