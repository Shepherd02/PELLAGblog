<?php

 require_once '../models/Model.php';
$pdo = MY_PDO::getInstance();
    
        function checkEmailExists($email) {
            return $email;
        }
    if (isset ($_REQUEST['email'])) {
            $email = $_REQUEST['email'];
            $sth = $pdo->prepare("SELECT email FROM blog_site.blog_user WHERE email = :email");
            $sth->bindValue(':email', $email);
            $sth ->execute();
            $result = $sth->fetchAll(PDO::FETCH_FUNC, "checkEmailExists");
            if (count($result) > 0 ){
               echo "true";  
            }  
            else{
                echo "false";          
            }
        }
