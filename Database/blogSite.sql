# Drop anything lingering around.
DROP DATABASE IF EXISTS blogsite;
DROP DATABASE IF EXISTS blog_site;

# Create a database
CREATE DATABASE IF NOT EXISTS blog_site;
use blog_site;

# TABLES 
# Create table for users
CREATE TABLE IF NOT EXISTS blog_user
(
  user_id          int          not null primary key AUTO_INCREMENT,
  first_name       varchar(30)  not null,
  last_name        varchar(50)  not null,
  bio              varchar(255),
  email            varchar(255) not null,
  password         varchar(255) not null,
  date_created     timestamp    not null,
  last_login       timestamp,
  twitter_handle   varchar(255),
  instagram_handle varchar(255)
);

# Create table for posts	
CREATE TABLE IF NOT EXISTS blog_post
(
  post_id      int  not null primary key AUTO_INCREMENT,
  user_id      int  not null,
  post_content text,
  date_created timestamp not null,
  last_update  timestamp,
  post_title   varchar(100),
  FOREIGN KEY (user_id) REFERENCES blog_user (user_id)
    ON DELETE CASCADE

);

# Create table for comments	
CREATE TABLE IF NOT EXISTS comment
(
  comment_id      int  not null primary key AUTO_INCREMENT,
  post_id         int  not null,
  comment_content varchar(255),
  date_created    timestamp not null,
  user_id         int  not null,
  FOREIGN KEY (user_id) REFERENCES blog_user (user_id)
    ON DELETE CASCADE,
  FOREIGN KEY (post_id) REFERENCES blog_post (post_id)
    ON DELETE CASCADE

);

CREATE TABLE `gallery`
(
  `gallery_id`        int(11)      NOT NULL primary key AUTO_INCREMENT,
  `user_id`           int          NOT NULL,
  `image_title`       varchar(255) NOT NULL,
  `image_description` varchar(255) NOT NULL,
  `image_name`        varchar(255) NOT NULL,
  `date_added`        timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES blog_user (user_id)
    ON DELETE CASCADE
);

# PROCEDURES

DELIMITER $$
# Stored procedure to create a user
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `AddUser`(INOUT `NewFirstName` VARCHAR(30), INOUT `NewLastName` VARCHAR(50),
                      INOUT `NewEmail` VARCHAR(25), INOUT `NewPassword` VARCHAR(15), INOUT `NewBio` VARCHAR(255))
INSERT INTO blog_user (first_name, last_name, email, password, bio)
VALUES (NewFirstName, NewLastName, NewEmail, NewPassword, NewBio)$$

# Stored procedure to add last login whenever a user logs in.
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `UpdateUserLastLogin`(INOUT `UserID` INT)
BEGIN
  UPDATE blog_user
  SET last_login = curdate()
  WHERE user_id = `UserID`;
END$$

# Stored procedure to delete a user
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `DeleteUser`(INOUT `UserID` INT)
BEGIN
  DELETE FROM blog_user WHERE user_id = `UserID`;
END$$

# Stored procedure to add a blog post
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `AddBlogPost`(INOUT `BlogTitle` VARCHAR(100), INOUT `BlogContent` TEXT, INOUT `UserID` INT,
                          INOUT `DateCreated` date)
INSERT INTO blog_post (post_title, post_content, user_id, date_created)
VALUES (BlogTitle, BlogContent, UserID, DateCreated)$$

# Stored procedure to edit a blog post
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `EditBlogPost`(INOUT `BlogTitle` VARCHAR(100), INOUT `BlogContent` TEXT, INOUT `PostID` INT)
BEGIN
  UPDATE blog_post
  SET last_update            = curdate(),
      blog_post.post_title   = `BlogTitle`,
      blog_post.post_content = `BlogContent`
  WHERE blog_post.post_id = `PostID`;
END$$

# Stored procedure to delete a blog post
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `DeleteBlogPost`(INOUT `PostID` INT)
BEGIN
  DELETE FROM blog_post WHERE blog_post.post_id = `PostID`;
END$$

# Stored procedure to add a comment
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `AddComment`(INOUT `CommentContent` VARCHAR(255), INOUT `PostID` TEXT, INOUT `UserID` INT,
                         INOUT `DateCreated` DATE)
INSERT INTO comment (comment_content, post_id, user_id, date_created)
VALUES (CommentContent, PostID, UserID, DateCreated)$$

# Stored procedure to delete a comment
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `DeleteComment`(INOUT `CommentID` INT)
BEGIN
  DELETE FROM comment WHERE comment_id = `CommentID`;
END$$

# Stored procedure to select all blog posts, ordered by date created
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `SelectAllPosts`() NO SQL
BEGIN
  SELECT *
  FROM blog_post
  ORDER BY date_created;
END$$

# Stored procedure to select blog posts belonging to a particular user
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `SearchPostsByAuthor`(INOUT `AuthorID` INT)
BEGIN
  SELECT *
  FROM blog_post
  WHERE blog_post.user_id = `AuthorID`
  ORDER BY date_created;
END$$

# Stored procedure to select blog posts with a particular postID
CREATE
  DEFINER =`root`@`localhost`
  PROCEDURE `SearchPostsByID`(INOUT `PostID` INT)
BEGIN
  SELECT *
  FROM blog_post
  WHERE blog_post.post_id = `PostID`;
END$$

# End of procedures

# USERS AND PRIVELEGES
# Create customer user
DROP USER 'blogger'@'%';
CREATE USER 'blogger'@'%' IDENTIFIED BY 'basicbl099er';
GRANT USAGE ON *.* TO 'blogger'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

# Grant priveleges to customer
GRANT SELECT, INSERT, UPDATE, DELETE ON `blog_site`.`blog_post` TO 'blogger'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON `blog_site`.`blog_user` TO 'blogger'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON `blog_site`.`comment` TO 'blogger'@'%';

# Allow customer to access stored procedures
GRANT EXECUTE ON PROCEDURE AddBlogPost TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE AddComment TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE AddUser TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE DeleteBlogPost TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE DeleteComment TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE DeleteUser TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE EditBlogPost TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE EditComment TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE SearchPostsByAuthor TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE SearchPostsByID TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE SelectAllPosts TO 'blogger'@'%';
GRANT EXECUTE ON PROCEDURE UpdateUserLastLogin TO 'blogger'@'%';

# Create admin user
DROP USER 'admin'@'%';
CREATE USER 'admin'@'%' IDENTIFIED BY 'iminchar9e';
GRANT USAGE ON *.* TO 'admin'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

# Grant priveleges to admin
GRANT SELECT, INSERT, UPDATE, DELETE, REFERENCES ON `blog_site`.`blog_post` TO 'admin'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE, REFERENCES ON `blog_site`.`blog_user` TO 'admin'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE, REFERENCES ON `blog_site`.`comment` TO 'admin'@'%';

# Allow admin to access stored procedures
GRANT EXECUTE ON PROCEDURE AddBlogPost TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE AddComment TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE AddUser TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE DeleteBlogPost TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE DeleteComment TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE DeleteUser TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE EditBlogPost TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE EditComment TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE SearchPostsByAuthor TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE SearchPostsByID TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE SelectAllPosts TO 'admin'@'%';
GRANT EXECUTE ON PROCEDURE UpdateUserLastLogin TO 'admin'@'%';

# Create developer user
DROP USER 'developer'@'%';
CREATE USER 'developer'@'%' IDENTIFIED BY 'igotdap0w3r';
GRANT USAGE ON *.* TO 'developer'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

# Grant priveleges to developer
GRANT ALL ON `blog_site`.`blog_post` TO 'developer'@'%';
GRANT ALL ON `blog_site`.`blog_user` TO 'developer'@'%';
GRANT ALL ON `blog_site`.`comment` TO 'developer'@'%';

# Allow developer to access stored procedures
GRANT EXECUTE ON PROCEDURE AddBlogPost TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE AddComment TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE AddUser TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE DeleteBlogPost TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE DeleteComment TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE DeleteUser TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE EditBlogPost TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE EditComment TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE SearchPostsByAuthor TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE SearchPostsByID TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE SelectAllPosts TO 'developer'@'%';
GRANT EXECUTE ON PROCEDURE UpdateUserLastLogin TO 'developer'@'%';