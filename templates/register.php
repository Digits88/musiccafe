<?php include('includes/header.php'); ?>

<form action="register.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Name*</label><input type="text" class="form-control" name="name" placeholder="Enter your name">
  </div>
  <div class="form-group">
    <label>Email Address*</label><input type="email" class="form-control" name="email" placeholder="Enter your email">
  </div>
  <div class="form-group">
    <label>Choose Username*</label><input type="text" class="form-control" name="username" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label>Password*</label><input type="password" class="form-control" name="password" placeholder="Enter password">
  </div>
  <div class="form-group">
    <label>Confirm Password*</label><input type="password" class="form-control" name="password2" placeholder="Enter password again">
  </div>
  <div class="form-group">
    <label>Upload Avatar</label><input type="file" class="form-control" name="avatar">
    <p class="help-block"></p>
  </div>
  <div class="form-group">
    <label>About Me</label>
    <textarea name="about" id="about" rows="6" cols="80" class="form-control" placeholder="Tell us about yourself (Optional)"></textarea>
  </div>
  <input type="submit" name="register" value="Register" class="btn btn-primary">
</form>

<?php include('includes/footer.php'); ?>
