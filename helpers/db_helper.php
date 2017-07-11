<?php
/*
 * Get number of Replies per topic
 */
function replyCount($topic_id){
  $db = new Database;
  $db->query("SELECT * FROM replies WHERE topic_id = :topic_id");
  $db->bind(':topic_id', $topic_id);
  // Assign rows
  $rows = $db->resultset();
  // Get count
  return $db->rowCount();
}

/*
 * Get all categories
 */
function getCategories(){
  $db = new Database;
  $db->query("SELECT * FROM categories");
  $results = $db->resultset();
  return $results;
}

/*
 * User Posts
 */
function userPostCount($user_id){
  $db = new Database;
  $db->query("SELECT * FROM topics WHERE user_id = :user_id");
  $db->bind(':user_id', $user_id);
  // Assign rows
  $rows = $db->resultset();
  // Get count
  $topic_count = $db->rowCount();

  $db->query("SELECT * FROM replies WHERE user_id = :user_id");
  $db->bind(':user_id', $user_id);
  // Assign rows
  $rows = $db->resultset();
  // Get count
  $reply_count = $db->rowCount();

  return $topic_count + $reply_count;
}
