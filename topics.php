<?php require('core/init.php'); ?>

<?php
// Create Topic Object
$topic = new Topic;
// Create User Object
$user = new User;

// Get category from URL
$category = isset($_GET['category']) ? $_GET['category'] : null ;

// Get user from URL
$user_id = isset($_GET['user']) ? $_GET['user'] : null ;

// Get template & assign vars
$template = new Template('templates/topics.php');

// Assign template variables
if(isset($category)){
  $template->topics = $topic->getByCategory($category);
  $template->title = 'Posts in "'. $topic->getCategory($category)->name .'"';
}

// Check for user filter
if(isset($user)){
  $template->topics = $topic->getByUser($user_id);
  $template->title = 'Posts by "'. $user->getUser($user_id)->username .'"';
}

if(!isset($category) && !isset($user_id)){
  $template->topics = $topic->getAllTopics();
  $template->title = 'Posts in All Categories';
}

$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();

// Display template
echo $template;
