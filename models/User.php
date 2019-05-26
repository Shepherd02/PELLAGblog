<?php
    require_once 'Model.php';

    /**
     * Created by PhpStorm.
     * User: Art3mis
     * Date: 2019-04-14
     * Time: 11:22
     */
    class User extends Model
    {

        // we define 3 attributes
        public $user_id;
        public $first_name;
        public $last_name;
        public $bio;
        public $email;
        public $password;
        public $date_created;
        public $last_login;

    public function __construct($user_id, $first_name, $date_created, $last_name, $bio, $email, $password, $last_login, $twitter_handle, $instagram_handle)
        {
            parent::__construct();
            $this->user_id = $user_id;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->date_created = $date_created;
            $this->bio = $bio;
            $this->email = $email;
            $this->password = $password;
            $this->last_login = $last_login;
            $this->twitter_handle = $twitter_handle;
            $this->instagram_handle = $instagram_handle;
        }

        public static function create()

        {
            $pdo = MY_PDO::getInstance();

            //If the POST var "register" exists (our submit button), then we can
            //assume that the user has submitted the registration form.
            if (isset($_POST['registerUser'])) {

                //Retrieve the field values from our registration form.
                $first_name = !empty($_POST['first_name']) ? trim($_POST['first_name']) : null;
                $last_name = !empty($_POST['last_name']) ? trim($_POST['last_name']) : null;
                $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
                $bio = !empty($_POST['bio']) ? trim($_POST['bio']) : null;
                $date_created = date('Y-m-d');
                $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
                $confirm_password =!empty($_POST['confirm_password']) ? trim($_POST['confirm_password']) :null;


                //Now, we need to check if the supplied username already exists.
                $sql = 'SELECT COUNT(blog_site.blog_user.email) AS num FROM blog_site.blog_user WHERE email = :email';

                $stmt = $pdo->prepare($sql);

                //Bind the provided username to our prepared statement.
                $stmt->bindValue(':email', $email);

                //Execute.
                $stmt->execute();

                //Fetch the row.

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                //If the provided username already exists - error is displayed using AJAX
                //
                //If user ignores AJAX statment, they are redirected back to the register page
                if ($row['num'] > 0) {
                    die(header('Location: /pellag/index.php?controller=User&action=registerUser', true, 302));
                }
                
                if ($_POST["password"] === $_POST["confirm_password"]) {
                    // success!
                
                //Hash the password as we do NOT want to store our passwords in plain text.
                $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
                //Construct the SQL statement and prepare it.
                $sql = 'Insert into blog_site.blog_user(first_name, last_name, date_created, email, bio, password) values (:first_name, :last_name, :date_created, :email, :bio, :password)';
                $stmt = $pdo->prepare($sql);
                //Bind the provided username to our prepared statement.
                $stmt->bindValue(':first_name', $first_name);
                $stmt->bindValue(':last_name', $last_name);
                $stmt->bindValue(':date_created', $date_created);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':bio', $bio);
                $stmt->bindValue(':password', $passwordHash);
                //Execute the statement and insert the new account.
                $result = $stmt->execute();
                //If the signup process is successful.
                if ($result) {
                    //What you do here is up to you!
                    // Redirect to the home page.
                echo '<script type="text/javascript">';
                echo 'alert("Registration successful");';
                echo 'window.location.href = "/pellag/index.php?controller=User&action=logIn";';
                echo '</script>';
                   }
                }else {
                    die(header('Location: /pellag/index.php?controller=User&action=registerUser', true, 302));
                }
            }
        }

        public static function login()
        {
            $pdo = MY_PDO::getInstance();
            //If the POST var "login" exists (our submit button), then we can
            //assume that the user has submitted the login form.
            if (isset($_POST['login'])) {
                //Retrieve the field values from our login form.
                $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
                $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

                //Retrieve the user account information for the given email - does this email exists in DB.
                $sql = 'SELECT * FROM blog_site.blog_user WHERE email = :email';
                $stmt = $pdo->prepare($sql);
                //Bind value.
                $stmt->bindValue(':email', $email);
                //Execute.
                $stmt->execute();
                //Fetch row.
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                //Compare the passwords.
                $validPassword = password_verify($passwordAttempt, $user['password']);
                //If $validPassword is TRUE, the login has been successful.
                if ($validPassword) {
                    //update last loggined in
                    $query = 'UPDATE blog_site.blog_user SET last_login = NOW() WHERE email = :email';
                    $statement = $pdo->prepare($query);
                    $statement->bindValue(':email',$email);
                    $statement->execute();
                    //Provide the user with a login session.
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['bio'] = $user ['bio'];
                    $_SESSION['twitter_handle'] = $user ['twitter_handle'];
                    $_SESSION['instagram_handle'] = $user ['instagram_handle'];
                    $_SESSION['logged_in'] = time();
                    header('Location: /pellag/index.php?controller=User&action=dashboard', true, 302);
                } else {
                    //$validPassword was FALSE. Passwords do not match.
                   ?> <script> alert ("You have entered an invalid email/password")</script> <?php
                }
            }
        }


        public static function logout()
        {
            $pdo = MY_PDO::getInstance();

            //If the POST var "login" exists (our submit button), then we can
            //assume that the user has submitted the login form.
            if (isset($_POST['logout'])) {

                // make sure you don't do unset($_SESSION);
                unset($_SESSION['user_id']);
                session_destroy();
                // Redirect to the home page.
                header('Location: /pellag/index.php', true, 302);

            }
        }


        public static function editBio()
        {
            $pdo = MY_PDO::getInstance();

            if (isset($_POST['editBio'])) {

            $bio=$_POST['bio'];
            $user_id =$_SESSION['user_id'];

            //Execute the query

           $sql = 'UPDATE blog_site.blog_user SET bio = :bio WHERE user_id = :user_id';
           $stmt = $pdo->prepare($sql);
           $stmt ->bindValue(':user_id', $user_id);
           $stmt ->bindValue(':bio', $bio);
           $stmt -> execute();


            echo '<script type="text/javascript">';
            echo 'alert ("Update successful - please log back in");';
            echo 'window.location.href = "index.php?controller=User&action=logOut";';
            echo '</script>';

            }
        }

        public static function editTwitter()
        {
            $pdo = MY_PDO::getInstance();

            if (isset($_POST['edittwitter'])) {

            $twitter_handle=$_POST['edittwitter'];
            $user_id =$_SESSION['user_id'];

            //Execute the query

           $sql = 'UPDATE blog_site.blog_user SET blog_user.twitter_handle = :twitter_handle WHERE blog_user.user_id = :user_id';
           $stmt = $pdo->prepare($sql);
           $stmt ->bindValue(':user_id', $user_id);
           $stmt ->bindValue(':twitter_handle', $twitter_handle);
           $stmt -> execute();


            echo '<script type="text/javascript">';
            echo 'alert ("Update successful - please log back in");';
            echo 'window.location.href = "index.php?controller=User&action=logOut";';
            echo '</script>';

            }
        }

        public static function editInstagram()
        {
            $pdo = MY_PDO::getInstance();

            if (isset($_POST['editinstagram'])) {

            $instagram_handle=$_POST['editinstagram'];
            $user_id =$_SESSION['user_id'];

            //Execute the query

           $sql = 'UPDATE blog_site.blog_user SET blog_user.instagram_handle = :instagram_handle WHERE blog_user.user_id = :user_id';
           $stmt = $pdo->prepare($sql);
           $stmt ->bindValue(':user_id', $user_id);
           $stmt ->bindValue(':instagram_handle', $instagram_handle);
           $stmt -> execute();


            echo '<script type="text/javascript">';
            echo 'alert ("Update successful - please log back in");';
            echo 'window.location.href = "index.php?controller=User&action=logOut";';
            echo '</script>';

            }
        }
    }
 