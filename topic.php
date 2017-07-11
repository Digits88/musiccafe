<?php require('core/init.php'); ?>

<?php
// Create Topic object
$topic = new Topic;
// Get ID from URL
$topic_id = $_GET['id'];
// Get template & assign vars
$template = new Template('templates/topic.php');

// Process Replies
if(isset($_POST['do_reply'])){
  // Create data array
  $data = array();
  $data['topic_id'] = $_GET['id'];
  $data['body'] = $_POST['body'];
  $data['user_id'] = getUser()['user_id'];

  // Create Validator object
  $validate = new Validator;

  // Required Fields
  $field_array = array("body");

  if($validate->isRequired($field_array)){
    // Reply
    if($topic->reply($data)){
      redirect("topic.php?id=".$topic_id, "Your reply has been posted", "success");
    }else{
      redirect("topic.php?id=".$topic_id, "Something went wrong with your reply", "error");
    }
  }
}

// Assign Vars
$template->topic = $topic->getTopic($topic_id);
$template->replies = $topic->getReplies($topic_id);
$template->title = $topic->getTopic($topic_id)->title;

// Display template
echo $template;
