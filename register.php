<?php require('core/init.php'); ?>

<?php
// Create Topic Object
$topic = new Topic;

// Create User Object
$user = new User;

// Create Validator Object
$validate = new Validator;

if(isset($_POST['register'])){
  $data = array();
  $data['name'] = $_POST['name'];
  $data['email'] = $_POST['email'];
  $data['username'] = $_POST['username'];
  $data['password'] = md5($_POST['password']);
  $data['password2'] = md5($_POST['password2']);
  $data['about'] = $_POST['about'];
  $data['last_activity'] = date("Y-m-d H:i:s");

  // Set required fields
  $fields = array('name', 'email', 'username', 'password', 'password2');

  // Validate inputs
  if($validate->isRequired($fields)){
    if($validate->isValidEmail($data['email'])){
      if($validate->passwordMatch($data['password'], $data['password2'])){
        // Upload avatar image
        if($user->uploadAvatar()){
          $data['avatar'] = $_FILES['avatar']['name'];
        }else{
          $data['avatar'] = 'noimage.png';
        }
        // Register User
        if($user->register($data)){
          redirect('index.php', 'You are registered and can now login', 'success');
        }else{
          redirect('index.php', 'Something went wrong with registration', 'error');
        }
      }else{
        redirect('register.php', 'Your passwords did not match', 'error');
      }
    }else{
      redirect('register.php', 'Please enter a valid email address', 'error');
    }
  }else{
    redirect('register.php', 'Please Fillup all the required fields', 'error');
  } // end of validator
} // end of if - isset

// Get template & assign vars
$template = new Template('templates/register.php');

// Assign Vars

// Display template
echo $template;
