<?php
/*
 * https://github.com/shuv1824
 * https://linkedin.com/in/shuv1824
 * Shah Nawaz Shuvo
 * Email: shahnawaz.shuvo1824@gmail.com
 * Skype: shuvo1824@hotmail.com
 */

 class Topic{
   // init DB variable
   private $db;

   // Constructor
   function __construct(){
     $this->db = new Database;
   }

   /*
    * Get all topics
    */
   public function getAllTopics(){
     $this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
                        INNER JOIN users
                        ON topics.user_id = users.id
                        INNER JOIN categories
                        ON topics.category_id = categories.id
                        ORDER BY topics.create_date DESC");

    // Assign result Set
    $results = $this->db->resultset();
    return $results;
   }

   /*
    * Get topics by Category
    */
   public function getByCategory($category_id){
     $this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
                        INNER JOIN users
                        ON topics.user_id = users.id
                        INNER JOIN categories
                        ON topics.category_id = categories.id
                        WHERE topics.category_id = :category_id
                        ORDER BY topics.create_date DESC");
    $this->db->bind(':category_id', $category_id);
    // Assign result Set
    $results = $this->db->resultset();
    return $results;
   }

   /*
    * Get topics by User
    */
   public function getByUser($user_id){
     $this->db->query("SELECT topics.*, categories.*, users.username, users.avatar FROM topics
                        INNER JOIN categories
                        ON topics.category_id = categories.id
                        INNER JOIN users
                        ON topics.user_id = users.id
                        WHERE topics.user_id = :user_id
                        ORDER BY topics.create_date DESC");
    $this->db->bind(':user_id', $user_id);
    // Assign result Set
    $results = $this->db->resultset();
    return $results;
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
    * Get total number of Topics
    */
    public function getTotalTopics(){
      $this->db->query("SELECT * FROM topics");
      $rows = $this->db->resultset();
      return $this->db->rowCount();
    }

    /*
     * Get Category by ID
     */
    public function getCategory($category_id){
      $this->db->query("SELECT * FROM categories WHERE id = :category_id");
      $this->db->bind(':category_id', $category_id);

      // Assign row
      $row = $this->db->single();
      return $row;
    }

    /*
     * Get total number of Categories
     */
     public function getTotalCategories(){
       $this->db->query("SELECT * FROM categories");
       $rows = $this->db->resultset();
       return $this->db->rowCount();
     }

     /*
      * Get total number of Replies
      */
      public function getTotalReplies(){
        $this->db->query("SELECT * FROM replies");
        $rows = $this->db->resultset();
        return $this->db->rowCount();
      }

      /*
       * Get Topic by ID
       */
      public function getTopic($id){
        $this->db->query("SELECT topics.*, users.username, users.name, users.avatar FROM topics
                          INNER JOIN users
                          ON topics.user_id = users.id
                          WHERE topics.id = :id");
        $this->db->bind(':id', $id);

        // Assign row
        $row = $this->db->single();
        return $row;
      }

      /*
       * Get Topic Replies
       */
      public function getReplies($topic_id){
        $this->db->query("SELECT replies.*, users.* FROM replies
                          INNER JOIN users
                          ON replies.user_id = users.id
                          WHERE replies.topic_id = :topic_id");
        $this->db->bind(':topic_id', $topic_id);

        // Assign row
        $results = $this->db->resultset();
        return $results;
      }

      /*
       * Create topic
       */
      public function create($data){
        $this->db->query(
          "INSERT INTO topics (category_id, user_id, title, body, last_activity)
          VALUES (:category_id, :user_id, :title, :body, :last_activity)"
        );
        // Bind values
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':last_activity', $data['last_activity']);

        // Execute
        if($this->db->execute()){
          return true;
        }else{
          return false;
        }
      }

      /*
       * Add Replies
       */
      public function reply($data){
        // Insert query
        $this->db->query(
          "INSERT INTO replies (topic_id, user_id, body) VALUES (:topic_id, :user_id, :body)"
        );
        // Bind values
        $this->db->bind(':topic_id', $data['topic_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);

        // Execute
        if($this->db->execute()){
          return true;
        }else{
          return false;
        }
      }
 }
