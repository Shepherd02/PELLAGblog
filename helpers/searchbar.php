<?php

 require_once '../models/Model.php';

$pdo = MY_PDO::getInstance(); 
          $key = isset($_POST['search-data']) ? $_POST['search-data'] : null;

          $array = array();
	 
	  $sql="SELECT * FROM blog_site.blog_post WHERE post_title LIKE '%{$key}%'"; 
	   
	  $result=$pdo ->prepare ($sql); 
          $result -> execute();
	  //-create  while loop and loop through result set 
	  while($row=$result->fetch(PDO::FETCH_ASSOC))
          {
            $array[] = [$row['post_title'], $row['post_id']];
          }
          echo json_encode($array);
           
	  

