<?php

    require_once 'Model.php';

    class Post extends Model
    {
        // we define 3 attributes
        public $post_id;
        public $user_id;
        public $post_content;
        public $post_title;
        public $date_created;

        public function __construct($post_id, $user_id, $post_title, $post_content, $date_created)
        {
            parent::__construct();
            $this->post_id = $post_id;
            $this->user_id = $user_id;
            $this->post_title = $post_title;
            $this->post_content = $post_content;
            $this->date_created = $date_created;
        }

        /**
         * @return array
         */
        public static function all()
        {
            $pdo = MY_PDO::getInstance();

            $sqlQuery = 'SELECT * FROM blog_site.blog_post LEFT JOIN blog_site.blog_user bu on blog_post.user_id = bu.user_id';

            /** @var MY_PDO $pdo */
            $result = $pdo->run($sqlQuery);

            if ($result)
            {
                $allPosts = $result->fetchAll(PDO::FETCH_ASSOC);
            }

            return $allPosts;

        }

        /**
         * @param $post_id
         * @return mixed
         */
        public static function find($post_id)
        {
            $pdo = MY_PDO::getInstance();
            //use intval to make sure $id is an integer
            $post_id = intval($post_id);

            $sqlQuery = 'SELECT * FROM blog_site.blog_post WHERE blog_post.post_id = :post_id';
            $result = $pdo->run($sqlQuery, array('post_id' => $post_id));

            $post = $result->fetch(PDO::FETCH_ASSOC);

            if ($post) {
                return $post;
            }
            //replace with a more meaningful exception
            throw Exception('A real exception should go here');

        }

        public static function update($post_id)
        {
            $pdo = MY_PDO::getInstance();
            
            $sqlQuery = 'Update blog_post set post_title=:post_title, date_created=:date_created, user_id=:user_id, post_content=:post_content where post_id=:post_id';
            $req = $pdo->run($sqlQuery);

            // set name and price parameters and execute
            if (isset($_POST['post_title']) && $_POST['post_title'] !== '') {
                $filteredPostTitle = filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if (isset($_POST['post_content']) && $_POST['post_content'] !== '') {
                $filteredPostContent = filter_input(INPUT_POST, 'post_content', FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if (isset($_POST['user_id']) && $_POST['user_id'] !== '') {
                $filteredPostAuthor = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if (isset($_POST['date_created']) && $_POST['date_created'] !== '') {
                $date_created = $_POST['date_created'];
            }

            $post_title = $filteredPostTitle;
            $post_content = $filteredPostContent;
            $user_id = $filteredPostAuthor;


            $req->bindParam(':post_id', $post_id);
            $req->bindParam(':user_id', $user_id);
            $req->bindParam(':post_title', $post_title);
            $req->bindParam(':post_content', $post_content);
            $req->bindParam(':date_created', $date_created);

            $req->execute();

            //upload product image if it exists
          if (!empty($_FILES[self::InputKey]['name'])) {
              Post::upload($post_title);
           }

        }

                public static function add()
        {
            $pdo = MY_PDO::getInstance();

            //If the POST var "register" exists (our submit button), then we can
            //assume that the user has submitted the registration form.
            if (isset($_POST['createpost'])) {
                
                //Retrieve the field values from our registration form.
                $user_id = $_SESSION ['user_id'];
                $post_title = filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_SPECIAL_CHARS);
                $post_content = filter_input(INPUT_POST, 'post_content', FILTER_SANITIZE_SPECIAL_CHARS);
                $date_created = date('Y-m-d');
                
                //Construct the SQL statement and prepare it.
                $sql = 'Insert into blog_site.blog_post(user_id, post_title, post_content, date_created) values (:user_id, :post_title, :post_content, :date_created)';
                $stmt = $pdo->prepare($sql);

                //Bind the provided username to our prepared statement.
                $stmt->bindValue(':user_id', $user_id);
                $stmt->bindValue(':post_title', $post_title);
                $stmt->bindValue(':post_content', $post_content);
                $stmt->bindValue(':date_created', $date_created);

                //Execute the statement and insert the new account.
                $result = $stmt->execute();

            
            Post::uploadFile($post_title);
    }
        }
const AllowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
const InputKey = 'myUploader';

//die() function calls replaced with trigger_error() calls
//replace with structured exception handling
public static function uploadFile(string $post_title) {

	if (empty($_FILES[self::InputKey])) {
		//die("File Missing!");
                trigger_error("File Missing!");
	}

	if ($_FILES[self::InputKey]['error'] > 0) {
		trigger_error("Handle the error! " . $_FILES[InputKey]['error']);
	}


	if (!in_array($_FILES[self::InputKey]['type'], self::AllowedTypes)) {
		trigger_error("Handle File Type Not Allowed: " . $_FILES[self::InputKey]['type']);
	}

	$tempFile = $_FILES[self::InputKey]['tmp_name'];
        $path = "/Applications/XAMPP/xamppfiles/htdocs/Pellag/views/images/";
	$destinationFile = $path . $post_title . '.jpeg';

	if (!move_uploaded_file($tempFile, $destinationFile)) {
		trigger_error("Handle Error");
	}
		
	//Clean up the temp file
	if (file_exists($tempFile)) {
		unlink($tempFile); 
	}
}

        public static function remove($post_id)
        {
            //make sure $id is an integer
            $post_id = intval($post_id);
            $pdo = MY_PDO::getInstance();
            $sqlQuery = 'delete FROM blog_site.blog_post WHERE blog_post.post_id = :post_id';
            $pdo->run($sqlQuery, array('post_id' => $post_id));
        }

    }
