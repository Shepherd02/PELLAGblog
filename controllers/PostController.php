<?php

    require_once 'models/Comment.php';

    class PostController
    {
        public function readAll()
        {
            // Store all the posts in a variable
            $context['allPosts'] = Post::all();
            //$context['allCommentsCounts'] = Comment::allCommentsCounts();
            return render('views/posts/readAll.php', $context);
        }

        public function read()
        {
            // we expect a url of form ?controller=posts&action=show&id=x
            // without an id we just redirect to the error page as we need the
            // post id to find it in the database
            if (isset($_GET['post_id'])) {
                try {
                    // we use the given id to get the correct post
                    $context['individualPost'] = Post::find($_GET['post_id']);
                    return render('views/posts/read.php', $context);

                } catch (Exception $ex) {
                    return call('Pages', 'error');
                }
            }
            return call('Pages', 'error');
        }

        /**
         * @return false|string
         */
        public function create()
        {
            // we expect a url of form ?controller=posts&action=create
            // if it's a GET request display a blank form for creating a new product
            // else it's a POST so add to the database and redirect to readAll action

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return render('views/posts/create.php');
            }
            Post::add();
            $context['allPosts'] = Post::all();
            header('Location: /pellag/index.php?controller=Post&action=readAll', true, 302);
        }

        public function update()
        {
            // pre-populates the form
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                if (isset($_GET['post_id'])) {
                    try {
                        // we use the given id to get the correct post

                        $context['individualPost'] = Post::find($_GET['post_id']);
                        return render('views/posts/update.php', $context);

                    } catch (Exception $ex) {
                        return call('Pages', 'error');
                    }
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_GET['post_id'])) {
                    try {
                        // we use the given id to get the correct post
                        Post::update($_GET['post_id']);
                        //$context['allPosts'] = Post::all();
                        header('Location: /pellag/index.php?controller=Post&action=readAll', true, 302);

                    } catch (Exception $ex) {
                        return call('Pages', 'error', $ex);
                    }
                }
            }

            return call('Pages', 'error');
        }


        public function delete()
        {
            Post::remove($_GET['post_id']);
            $context['allPosts'] = Post::all();
            return render('views/posts/readAll.php', $context);
        }
    }
