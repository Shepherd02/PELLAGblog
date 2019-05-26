<?php


    class ImageController {

        public function upload()
        {
            // we expect a url of form ?controller=User&action=register
            // if it's a GET request display a blank form for creating a new product
            // else it's a POST so add to the database and redirect to readAll action
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    return render('views/posts/upload.php');
                case 'POST':
                    Image::upload();
                    header('Location: /pellag/index.php?controller=Image&action=viewAll', true, 302);
            }
        }
   
        public function viewAll()
        {
            // Store all the posts in a variable
            $context['allImages'] = Image::viewAll();
            return render('views/user/gallery.php', $context);
        }

        public function delete()
        {
            Image::remove($_GET['gallery_id']);
            $context['allImages'] = Image::viewAll();
            return render('views/user/gallery.php', $context);
        }
              
    }

