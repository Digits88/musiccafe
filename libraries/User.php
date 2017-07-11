<?php
/*
 * https://github.com/shuv1824
 * https://linkedin.com/in/shuv1824
 * Shah Nawaz Shuvo
 * Email: shahnawaz.shuvo1824@gmail.com
 * Skype: shuvo1824@hotmail.com
 */

 /*
  * User class
  * Register Users and stuffs
  */
class User{
  // init DB variable
  private $db;
  // Constructor
  function __construct(){
    $this->db = new Database;
  }
  /*
   * Register the user
   */
  public function register($data){
    // Insert query
    $this->db->query("INSERT INTO users (name, email, avatar, username, password, about, last_activity)
                    VALUES (:name, :email, :avatar, :username, :password, :about, :last_activity)");
    // Bind values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':avatar', $data['avatar']);
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':password', $data['password']);
    $this->db->bind(':about', $data['about']);
    $this->db->bind(':last_activity', $data['last_activity']);

    // Execute
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }
  /*
   * Upload user avatar
   */
  public function uploadAvatar(){
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["avatar"]["name"]);
    $extension = end($temp);

    if((($_FILES["avatar"]["type"] == "image/gif")
          || ($_FILES["avatar"]["type"] == "image/jpeg")
          || ($_FILES["avatar"]["type"] == "image/jpg")
          || ($_FILES["avatar"]["type"] == "image/pjpeg")
          || ($_FILES["avatar"]["type"] == "image/x-png")
          || ($_FILES["avatar"]["type"] == "image/png"))
          && ($_FILES["avatar"]["size"] < 50000)
          && in_array($extension, $allowedExts)){
            if($_FILES["avatar"]["error"] > 0){
              redirect('register.php', $_FILES["avatar"]["error"], 'error' );
            }else{
              if(file_exists("images/avatars/". $_FILES["avatar"]["name"])){
                redirect('register.php', 'File already exists', 'error' );
              }else{
                move_uploaded_file($_FILES["avatar"]["tmp_name"], "images/avatars/". $_FILES["avatar"]["name"]);

                return true;
              }
            }
          }else{
            redirect('register.php', 'Invalid file type', 'error' );
          }
  }

  /*
   * Get User by ID
   */
  public function getUser($user_id){
    $this->db->query("SELECT * FROM users WHERE id = :user_id");
    $this->db->bind(':user_id', $user_id);

    // Assign row
    $row = $this->db->single();
    return $row;
  }

  /*
   * Get Total number of Users
   */
  public function getTotalUsers(){
    $this->db->query("SELECT * FROM users");
    $rows = $this->db->resultset();
    return $this->db->rowCount();
  }

  /*
   * User Login
   */
  public function login($username, $password){
    $this->db->query("SELECT * FROM users
                      WHERE username = :username
                      AND password = :password");

    // Bind values
    $this->db->bind(":username", $username);
    $this->db->bind(":password", $password);

    $row = $this->db->single();

    // Check rows
    if($this->db->rowCount() > 0){
      $this->setUserData($row);
      return true;
    }else{
      return false;
    }
  }

  /*
   * Set User Data
   */
  private function setUserData($row){
    $_SESSION['is_logged_in'] = true;
    $_SESSION['user_id'] = $row->id;
    $_SESSION['username'] = $row->username;
    $_SESSION['name'] = $row->name;
  }

  /*
   * User Logout
   */
  public function logout($row){
    unset($_SESSION['is_logged_in']);
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['name']);

    return true;
  }
}
