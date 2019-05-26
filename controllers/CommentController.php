<?php

    require_once 'models/User.php';
    require_once 'models/Post.php';

    class CommentController
    {

        /**
         * @return false|string
         */
        public function create()
        {
            // we expect a url of form ?controller=Comment&action=create
            // if it's a GET request display a blank form for creating a new product
            // else it's a POST so add to the database and redirect to readAll action
            if (isset($_GET['post_id']) && $_SESSION['user_id']) {
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    return render('views/posts/commentPost.php');
                }
                Comment::add();
                $context['allComments'] = Comment::find_by_post($_GET['post_id']);
                header("Location: /pellag/index.php?controller=Comment&action=showAllComments&post_id={$_GET['post_id']}", true, 302);

            }
        }

        public function showAllComments()
        {
            // we expect a url of form ?controller=Comment&action=showAllComments&id=x
            // without an id we just redirect to the error page as we need the
            // post id to find it in the database
            if (isset($_GET['post_id'])) {
                try {
                    // we use the given id to get the correct post
                    $context['allComments'] = Comment::find_by_post($_GET['post_id']);
                    return render('views/posts/showAllComments.php', $context);

                } catch (Exception $ex) {
                    return call('Pages', 'error');
                }
            }
            return call('Pages', 'error');
        }


        public function delete()
        {
            if ($_GET['comment_id']) {

                try {
                    $post = Post::find_by_comment($_GET['comment_id']);
                    Comment::remove($_GET['comment_id']);
                    header("Location: /pellag/index.php?controller=Post&action=read&post_id={$post['post_id']}", true, 302);
                } catch (Exception $ex) {
                    return call('Pages', 'error');
                }
            }

            return call('Pages', 'error');

        }
    }