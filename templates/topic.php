<?php include('includes/header.php'); ?>

<ul id="topics">
  <li id="main-topic" class="topic topic">
    <div class="row">
      <div class="col-md-2">
        <div class="user-info">
          <img src="images/avatars/<?php echo $topic->avatar; ?>" alt="Avatar" class="avatar pull-left">
          <ul>
            <li><strong><?php echo $topic->username; ?></strong></li>
            <li><?php echo userPostCount($topic->user_id); ?> Posts</li>
            <li><a href="<?php echo BASE_URI; ?>topics.php?user=<?php echo $topic->user_id; ?>">View Topics</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-10">
        <div class="topic-content pull-right">
            <p><?php echo $topic->body; ?></p>
        </div>
      </div>
    </div>
  </li>

  <?php foreach($replies as $reply): ?>
  <li class="topic topic">
    <div class="row">
      <div class="col-md-2">
        <div class="user-info">
          <img src="images/avatars/<?php echo $reply->avatar; ?>" alt="Avatar" class="avatar pull-left">
          <ul>
            <li><strong><?php echo $reply->username; ?></strong></li>
            <li><?php echo userPostCount($reply->user_id); ?> Posts</li>
            <li><a href="<?php echo BASE_URI; ?>topics.php?user=<?php echo $reply->user_id; ?>">View Topics</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-10">
        <div class="topic-content pull-right">
            <?php echo $reply->body; ?>
        </div>
      </div>
    </div>
  </li>
  <?php endforeach; ?>
</ul>

<h3>Reply to topic</h3>
<?php if(isLoggedIn()): ?>
<form role="form" method="post" action="topic.php?id=<?php echo $topic->id;?>">
  <div class="form-group">
    <textarea name="body" id="body" rows="10" cols="80" class="form-control"></textarea>
    <script>CKEDITOR.replace('reply');</script>
  </div>
  <input type="submit" name="do_reply" value="Reply" class="btn btn-success">
</form>
<?php else: ?>
  <p style="color:orange">Please login to Reply.</p>
<?php endif; ?>

<?php include('includes/footer.php'); ?>
