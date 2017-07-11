<?php require('core/init.php'); ?>

<?php
// Create Topic Object
$topic = new Topic;

// Create Validator Object
$validate = new Validator;

// Get template & assign vars
$template = new Template('templates/create.php');

if(isset($_POST['do_create'])){
  $data = array();
  $data['title'] = $_POST['title'];
  $data['body'] = $_POST['body'];
  $data['category_id'] = $_POST['category'];
  $data['user_id'] = getUser()['user_id'];
  $data['last_activity'] = date('Y-m-d H:j:s');

  // Required Fields
  $fields_array = array('title', 'body', 'category');

  if($validate->isRequired($fields_array)){
    if($topic->create($data)){
      redirect("index.php", "Your Topic has been posted", "success");
    }else{
      redirect("index.php", "Please fill in all required fields", "error");
    }
  }
}
// Assign Vars
$template->totalCategories = $topic->getTotalCategories();

// Display template
echo $template;
