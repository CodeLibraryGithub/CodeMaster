<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Insert and Retrieve data from MySQL database with ajax</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
  	<?php echo $comments; ?>
  	<form class="comment_form" enctype="multipart/form-data">
      <div>
        <label for="name">First Name:</label>
      	<input type="text" name="name" id="name">
      </div>
        <div>
      	<label for="last_name">Last Name:</label>
      	<input type="text" name="last_name" id="last_name">
      </div>
	  <div>
      	<label for="last_name">Profile Picture:</label>
      	<input type="file" name="photo" id="photo">
      </div>
      <div>
      	<label for="comment">Comment:</label>
      	<textarea name="comment" id="comment" cols="30" rows="5"></textarea>
      </div>
      <button type="submit" id="submit_btn">POST</button>
      <button type="button" id="update_btn" style="display: none;">UPDATE</button>
  	</form>
  </div>
</body>
</html>
<!-- Add JQuery -->
<script src="jquery-min.js"></script>
<script src="scripts.js"></script>