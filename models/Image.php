<?php

    require_once 'Model.php';

    class Image extends Model
    {

        // we define attributes
        public $gallery_id;
        public $user_id;
        public $image_title;
        public $image_description;
        public $image_name;
        public $date_added;


        const AllowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        const InputKey = 'uploaded_file';

        public function __construct($gallery_id, $user_id, $image_title, $image_description, $image_name, $date_added)
        {
            parent::__construct();
            $this->gallery_id = $gallery_id;
            $this->user_id = $user_id;
            $this->image_title = $image_title;
            $this->image_description = $image_description;
            $this->image_name = $image_name;
            $this->date_added = $date_added;

        }

        public static function upload()
        {
            $pdo = MY_PDO::getInstance();

            //Retrieve the field values from our registration form.
            $user_id = $_SESSION ['user_id'];
            $image_title = filter_input(INPUT_POST, 'image_title', FILTER_SANITIZE_SPECIAL_CHARS);
            $image_description = filter_input(INPUT_POST, 'image_description', FILTER_SANITIZE_SPECIAL_CHARS);
            $image_name = $_FILES['uploaded_file']['name'];
            $date_added = date();

            if ($_FILES['uploaded_file']['type'] === 'image/gif'
                || $_FILES["uploaded_file"]["type"] === "image/jpeg"
                || $_FILES["uploaded_file"]["type"] === "image/jpg"
                || $_FILES["uploaded_file"]["type"] === "image/png"
                && $_FILES["uploaded_file"]["size"] < (2 * 1024 * 1024)) {

                if ($_FILES["uploaded_file"]["error"] > 0) {
                    echo "Return Code:" . $_FILES["uploaded_file"]["error"] . "";
                } else {

                    move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], 'views/images/'.$image_name);

                    // image details into database table
                    $sql = 'INSERT INTO blog_site.gallery (user_id, image_title, image_description, image_name, date_added) VALUES(:user_id, :image_title, :image_description, :image_name, :date_added)';
                    $stmt = $pdo->prepare($sql);

                    $stmt->bindValue(':user_id', $user_id);
                    $stmt->bindValue(':image_title', $image_title);
                    $stmt->bindValue(':image_description', $image_description);
                    $stmt->bindValue(':image_name', $image_name);
                    $stmt->bindValue(':date_added', $date_added);

                    //Execute the statement and insert the new account.
                    $stmt->execute();
                }
            }
        }


        public static function viewAll()
        {
            $pdo = MY_PDO::getInstance();

            $sqlQuery = <<<EOT
SELECT * FROM blog_site.gallery
  LEFT JOIN blog_site.blog_user user on gallery.user_id = user.user_id 
ORDER BY gallery.date_added DESC
EOT;


            /** @var MY_PDO $pdo */
            $result = $pdo->run($sqlQuery);

            if ($result) {
                $Images = $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $Images = array();
            }

            return $Images;

        }

        /**
         * @return array
         */
        public static function tenMostRecent()
        {
            $pdo = MY_PDO::getInstance();

            $sqlQuery = 'SELECT * FROM blog_site.gallery LEFT JOIN blog_site.blog_user bu on gallery.user_id = bu.user_id ORDER BY gallery.date_added desc LIMIT 10';

            /** @var MY_PDO $pdo */
            $result = $pdo->run($sqlQuery);

            if ($result) {
                $allImages = $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $allImages = array();
            }

            return $allImages;

        }

        public static function remove($gallery_id)
        {
            $pdo = MY_PDO::getInstance();
            //make sure $id is an integer
            $gallery_id = intval($gallery_id);
            $sql = 'delete FROM blog_site.gallery WHERE gallery.gallery_id = :gallery_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':gallery_id', $gallery_id);
            $result = $stmt->execute();
        }
    }
    