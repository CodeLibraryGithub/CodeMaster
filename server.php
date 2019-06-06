<?php 
  $conn = mysqli_connect('localhost', 'root', '', 'ajax_crud');
  if (!$conn) {
    die('Connection failed ' . mysqli_error($conn));
  }
  
  if(isset($_POST) && !empty($_POST)) {
		
		
	$photo = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : '';
	$tmp_name = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : '';
	$size = isset($_FILES['photo']['size']) ? $_FILES['photo']['size'] :'';
	$type = isset($_FILES['photo']['type']) ? $_FILES['photo']['type'] : '';
	$target_dir = "uploads/";
	$target_file = $target_dir . basename(time('s').$photo);
	move_uploaded_file($tmp_name, $target_file);
	
	$name = $_POST['name'];
	$last_name = $_POST['last_name'];
	$photo = time('s').$photo;
	$comment = $_POST['comment'];
	
  	$sql = "INSERT INTO comments (name, comment,last_name,photo) VALUES ('{$name}', '{$comment}', '{$last_name}','{$photo}')";
  	
	if (mysqli_query($conn, $sql)) {
  	    $id = mysqli_insert_id($conn);
            $saved_comment = '<div class="comment_box">
      		<span class="delete" data-id="' . $id . '" >delete</span>
      		<span class="edit" data-id="' . $id . '">edit</span>
      		<div class="display_name">'. $name .'</div>
			<div class="display_name1">'. $last_name .'</div>
			<div class="photo"><a href="uploads/photo.jpg"></a></div>
      		<div class="comment_text">'. $comment .'</div>
                </div>';
  	  echo $saved_comment;
  	}else {
  	  echo "Error: ". mysqli_error($conn);
  	}
  	exit();
  }
  // delete comment fromd database
  if (isset($_GET['delete'])) {
  	$id = $_GET['id'];
  	$sql = "DELETE FROM comments WHERE id=" . $id;
  	mysqli_query($conn, $sql);
  	exit();
  }
  if (isset($_POST['update'])) {
  	$id = $_POST['id'];
  	$name = $_POST['name'];
  	$comment = $_POST['comment'];
        $last_name = $_POST['last_name'];
  	$sql = "UPDATE comments SET name='{$name}',last_name='{$last_name}', comment='{$comment}' WHERE id=".$id;
  	if (mysqli_query($conn, $sql)) {
  		$id = mysqli_insert_id($conn);
  		$saved_comment = '<div class="comment_box">
  		  <span class="delete" data-id="' . $id . '" >delete</span>
  		  <span class="edit" data-id="' . $id . '">edit</span>
  		  <div class="display_name">'. $name .'</div>
          <div class="display_name1">'. $last_name .'</div>
  		  <div class="comment_text">'. $comment .'</div>
  	  </div>';
  	  echo $saved_comment;
  	}else {
  	  echo "Error: ". mysqli_error($conn);
  	}
  	exit();
  }

  // Retrieve comments from database
  $sql = "SELECT * FROM comments";
  $result = mysqli_query($conn, $sql);
  $comments = '<div id="display_area">'; 
  while ($row = mysqli_fetch_array($result)) {
	$comments .= '<div class="comment_box">
  		  <span class="delete" data-id="' . $row['id'] . '" >delete</span>
  		  <span class="edit" data-id="' . $row['id'] . '">edit</span>
  		  <div class="display_name">'. $row['name'] .'</div>
		  <div class="display_name1">'. $row['last_name'] .'</div>
		  <div class="comment_text">'. $row['comment'] .'</div>
		  <div class="photo"><img src="uploads/'.$row['photo'].'" id="photo" style="width:50px"/></div>
  	  </div>';
  }
  $comments .= '</div>';
?>