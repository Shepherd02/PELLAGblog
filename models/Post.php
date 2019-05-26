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

            $sqlQuery = <<<EOT
SELECT *, (SELECT COUNT(comment_id) FROM blog_site.comment WHERE blog_site.comment.post_id = blog_site.blog_post.post_id) as allCommentsCounts
FROM blog_site.blog_post  
  LEFT JOIN blog_site.blog_user user on blog_post.user_id = user.user_id 
ORDER BY blog_post.date_created DESC
EOT;
            /** @var MY_PDO $pdo */
            $result = $pdo->run($sqlQuery);

            if ($result) {
                $allPosts = $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $allPosts = array();
            }


            return $allPosts;

        }

        /**
         * @return array
         */
        public static function tenMostRecent()
        {
            $pdo = MY_PDO::getInstance();

            $sqlQuery = 'SELECT * FROM blog_site.blog_post LEFT JOIN blog_site.blog_user bu on blog_post.user_id = bu.user_id ORDER BY blog_post.date_created desc LIMIT 10';

            /** @var MY_PDO $pdo */
            $result = $pdo->run($sqlQuery);

            if ($result) {
                $allPosts = $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $allPosts = array();
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

            $sqlQuery = <<<EOT
SELECT *, (SELECT COUNT(comment_id) FROM blog_site.comment 
WHERE blog_site.comment.post_id = blog_site.blog_post.post_id) as allCommentsCounts
FROM blog_site.blog_post  
  LEFT JOIN blog_site.blog_user user on blog_post.user_id = user.user_id 
WHERE blog_post.post_id = :post_id
EOT;

            $result = $pdo->run($sqlQuery, array('post_id' => $post_id));

            $post = $result->fetch(PDO::FETCH_ASSOC);

            if ($post) {
                return $post;
            }

            $post = array();

            return $post;

        }

        /**
         * @param $comment_id
         * @return mixed
         */
        public static function find_by_comment($comment_id)
        {
            $pdo = MY_PDO::getInstance();
            //use intval to make sure $id is an integer
            $comment_id = intval($comment_id);

            $sqlQuery = <<<EOT
SELECT * FROM blog_site.blog_post 
  LEFT JOIN blog_site.comment on comment.post_id = blog_post.post_id 
WHERE comment.comment_id = :comment_id
EOT;

            $result = $pdo->run($sqlQuery, array('comment_id' => $comment_id));

            $post = $result->fetch(PDO::FETCH_ASSOC);

            if ($post) {
                return $post;
            }

            $post = array();

            return $post;

        }

        public static function update($post_id)
        {
            $pdo = MY_PDO::getInstance();

            $post_id = intval($post_id);

            //Retrieve the field values from our registration form./*/
            $post_title = $_POST['post_title'];
            $post_content = $_POST['post_content'];
            $last_update = date('Y-m-d');
            //Construct the SQL statement and prepare it.
            $sql = 'UPDATE blog_site.blog_post set blog_post.post_title= :post_title, blog_post.post_content = :post_content, blog_post.last_update= :last_update where blog_post.post_id = :post_id';
            $stmt = $pdo->prepare($sql);

            //Bind the provided username to our prepared statement.
            $stmt->bindValue(':post_id', $post_id);
            $stmt->bindValue(':post_title', $post_title);
            $stmt->bindValue(':post_content', $post_content);
            $stmt->bindValue(':last_update', $last_update);

            //Execute the statement and insert the new account.
            $result = $stmt->execute();

        }

        public static function add()
        {
            $pdo = MY_PDO::getInstance();

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

        }

        public static function remove($post_id)
        {
            $pdo = MY_PDO::getInstance();
            //make sure $id is an integer
            $post_id = intval($post_id);
            $sql = 'delete FROM blog_site.blog_post WHERE blog_post.post_id = :post_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':post_id', $post_id);
            $result = $stmt->execute();
        }

        public static function getMyPosts()
        {
            $pdo = MY_PDO::getInstance();

            $user_id = $_SESSION ['user_id'];


            $sqlQuery = 'SELECT * FROM blog_site.blog_post JOIN blog_site.blog_user bu on blog_post.user_id = bu.user_id WHERE blog_post.user_id=:user_id';

            $result = $pdo->run($sqlQuery, ['user_id' => $user_id]);

            if ($result) {
                $myPosts = $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $myPosts = array();
            }

            return $myPosts;

        }


    }
