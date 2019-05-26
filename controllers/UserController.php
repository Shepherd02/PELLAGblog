<?php

    require_once "models/Post.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    class UserController
    {
        public function registerUser()
        {
            // we expect a url of form ?controller=User&action=register
            // if it's a GET request display a blank form for creating a new product
            // else it's a POST so add to the database and redirect to readAll action

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return render('views/user/registerUser.php');
            }
            User::create();
            return render('views/user/registerUser.php');
        }

        public function logIn()
        {
            // we expect a url of form ?controller=User&action=register
            // if it's a GET request display a blank form for creating a new product
            // else it's a POST so add to the database and redirect to readAll action

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return render('views/user/logIn.php');
            }
            User::login();
            return render('views/user/logIn.php');
        }

        public function logOut()
        {
            // we expect a url of form ?controller=User&action=register
            // if it's a GET request display a blank form for creating a new product
            // else it's a POST so add to the database and redirect to readAll action

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return render('views/user/logout.php');
            }
            User::logout();
            return render('views/user/logout.php');
        }
        
        public function dashboard()
        {
            $context['allPosts'] = Post::tenMostRecent();
            $context['myPosts'] = Post::getMyPosts();

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return render('views/user/dashboard.php', $context);
            }
            User::dashboard();
            
            return render('views/user/dashboard.php', $context);
        }
        
        public function editBio()
        {
          if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return render('views/user/editBio.php');
            }
            User::editBio();
            return render('views/user/editBio.php');
        }
        
                
         public function edittwitter()
        {
          if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return render('views/user/editTwitter.php');
            }
            User::edittwitter();
            return render('views/user/editTwitter.php');
        }
        
        public function editinstagram()
        {
          if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return render('views/user/editInstagram.php');
            }
            User::editinstagram();
            return render('views/user/editInstagram.php');
        }

    }