<?php
    /**
     * Created by PhpStorm.
     * User: Art3mis
     * Date: 2019-04-15
     * Time: 17:51
     */
    require_once 'Model.php';

    class Comment extends Model
    {
        // Defined attributes
        public $comment_id;
        public $post_id;
        public $user_id;
        public $comment_content;
        public $date_created;


        /**
         * Comment constructor.
         * @param $comment_id
         * @param $post_id
         * @param $user_id
         * @param $comment_content
         * @param $date_created
         */
        public function __construct($comment_id, $post_id, $user_id, $comment_content, $date_created)
        {
            parent::__construct();
            $this->comment_id = $comment_id;
            $this->post_id = $post_id;
            $this->user_id = $user_id;
            $this->comment_content = $comment_content;
            $this->date_created = $date_created;
        }

        /**
         * Get all comments ever written
         *
         * @return mixed
         */
        public static function allComments()
        {
            $pdo = MY_PDO::getInstance();
            //use intval to make sure $id is an integer

            $sqlQuery = 'SELECT *, comment.user_id as comment_author, bp.user_id as post_author FROM blog_site.comment LEFT JOIN blog_site.blog_post bp on comment.post_id = bp.post_id LEFT JOIN blog_site.blog_user bu on bp.user_id = bu.user_id';
            $result = $pdo->run($sqlQuery);

            //may be only one or many comments with same post_id
            $comments = $result->fetchAll(PDO::FETCH_ASSOC); // array of objects

            if ($comments) {
                return $comments;
            }
            $comments = array();

            return $comments;

        }

        /**
         * @return array
         */
        public static function tenMostRecent()
        {
            $pdo = MY_PDO::getInstance();

            $sqlQuery = 'SELECT * FROM blog_site.comment LEFT JOIN blog_site.blog_post bp on comment.post_id = bp.post_id ORDER BY comment.date_created desc LIMIT 10';

            /** @var MY_PDO $pdo */
            $result = $pdo->run($sqlQuery);

            if ($result) {
                $allComments = $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $allComments = array();
            }

            return $allComments;

        }


        /**
         * Get all comments for this specific post id; will be displayed when clicked on all comments
         *
         * @param $post_id
         * @return mixed
         */
        public static function find_by_post($post_id)
        {
            $pdo = MY_PDO::getInstance();
            //use intval to make sure $id is an integer

            $post_id = intval($post_id);

            $sqlQuery = 'SELECT *, comment.user_id as comment_author, bp.date_created as post_date, bp.user_id as post_author FROM blog_site.comment LEFT JOIN blog_site.blog_post bp on comment.post_id = bp.post_id LEFT JOIN blog_site.blog_user bu on bp.user_id = bu.user_id WHERE comment.post_id = :post_id';
            $result = $pdo->run($sqlQuery, array('post_id' => $post_id));

            //may be only one or many comments with same post_id
            $comments = $result->fetchAll(PDO::FETCH_ASSOC); // array of objects

            if ($comments) {
                return $comments;
            }
            $comments = array();

            return $comments;

        }


        /**
         * Get comment by comment id
         *
         * @param $comment_id
         * @return mixed
         */
        public static function find_by_comment($comment_id)
        {
            $pdo = MY_PDO::getInstance();
            //use intval to make sure $id is an integer
            $comment_id = intval($comment_id);

            $sqlQuery = 'SELECT * FROM blog_site.comment WHERE comment.comment_id = :comment_id';
            $result = $pdo->run($sqlQuery, array('post_id' => $comment_id));

            //read details of one comment with this ID
            $comment = $result->fetch(PDO::FETCH_ASSOC);

            if ($comment) {
                return $comment;
            }

            $comment = array();

            return $comment;


        }

        /**
         * Create new comment for available post_id
         *
         */
        public static function add()
        {
            $pdo = MY_PDO::getInstance();

            //If the POST var "create_comment" exists (our submit button), then we can
            //assume that the user has submitted the registration form.

            if (isset($_GET['post_id'], $_POST['create_comment'])) {

                //Retrieve the field values from our comment form.
                $user_id = $_SESSION ['user_id'];
                $post_id = $_GET['post_id'];
                $comment_content = filter_input(INPUT_POST, 'comment_content', FILTER_SANITIZE_SPECIAL_CHARS);
                $date_created = date('Y-m-d');

                //Construct the SQL statement and prepare it.
                $sql = 'Insert into blog_site.comment(user_id, post_id, comment_content, date_created) values (:user_id, :post_id, :comment_content, :date_created)';
                $stmt = $pdo->prepare($sql);

                //Bind the provided username to our prepared statement.
                $stmt->bindValue(':user_id', $user_id);
                $stmt->bindValue(':post_id', $post_id);
                $stmt->bindValue(':comment_content', $comment_content);
                $stmt->bindValue(':date_created', $date_created);

                //Execute the statement and insert the new account.
                $result = $stmt->execute();

            }

        }

        public static function remove($comment_id)
        {
            $pdo = MY_PDO::getInstance();
            //make sure $id is an integer
            $comment_id = intval($comment_id);

            $sql = 'delete FROM blog_site.comment WHERE comment.comment_id = :comment_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':comment_id', $comment_id);

            $stmt->execute();

        }


    }