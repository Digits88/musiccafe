<?php include('includes/header.php'); ?>

<form role="form" method="post" action="create.php">
  <div class="form-group">
    <label>Topic Title</label><input type="text" class="form-control" name="title" placeholder="Enter a title">
  </div>
  <div class="form-group">
    <label>Category</label>
    <select class="form-control" name="category"></option>
    <?php foreach (getCategories() as $category):?>
      <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
    <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label>Topic Body</label>
    <textarea name="body" id="body" rows="10" cols="80" class="form-control"></textarea>
    <script>CKEDITOR.replace('body');</script>
  </div>
  <input type="submit" name="do_create" value="Create" class="btn btn-success">
</form>

<?php include('includes/footer.php'); ?>
