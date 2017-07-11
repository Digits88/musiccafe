<?php
/*
 * Redirect to page
 */
function redirect($page = false, $message = null, $message_type = null){
  if(is_string($page)){
    $location = $page;
  }else{
    $location = $_SERVER['SCRIPT_NAME'];
  }

  // Check for message
  if($message != null){
    // Set message
    $_SESSION['message'] = $message;
  }

  // Check for type
  if($message_type != null){
    // Set message type
    $_SESSION['message_type'] = $message_type;
  }

  // redirect
  header("location: ". $location);
  exit;
}

/*
 * Display message
 */
function displayMessage(){
  if(!empty($_SESSION['message'])){
    // Assign message var
    $message = $_SESSION['message'];

    if(!empty($_SESSION['message_type'])){
      // Assign message type var
      $message_type = $_SESSION['message_type'];

      // Create output
      if($message_type == 'error'){
        echo '<div class="alert alert-danger">' .$message. '</div>';
      }else{
        echo '<div class="alert alert-success">' .$message. '</div>';
      }
    }

    // Unset Message
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
  }else{
    echo '';
  }
}

/*
 * Check if logged in
 */
function isLoggedIn(){
  if(isset($_SESSION['is_logged_in'])){
    return true;
  }else{
    return false;
  }
}

/*
 * Get logged in user info
 */
function getUser(){
  $userArray = array();
  $userArray['user_id'] = $_SESSION['user_id'];
  $userArray['username'] = $_SESSION['username'];
  $userArray['name'] = $_SESSION['name'];

  return $userArray;
}
