<?php
$errors = [];
function checkPost($post, $file, &$errors, $conn, $num) {
  $title = $_POST['title'];
  $body = $_POST['content'];
  $author = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];
  $imgurl = validateFile($file, "img");
  if(validateFile($file, "image")) {
    $errors['post_img'] = "There was a problem with your image upload!";
  }

  if($body == '' || $title == '') {
    $errors['post_title'] = "Post title and body cannot be empty!";
  }

  if(!$imgurl) {
    $errors['post_file'] = "There was a problem with your image upload!";
  }

  if(empty($errors) && $num == 0 ) {
    createPost($title, $body, $author, $imgurl, $user_id,  $conn);
  }
  else
  {
    updatePost($title, $body, $author, $imgurl, $num,  $conn);
  }
}

function createPost($title, $body, $author, $imgurl, $user_id,  $conn) {
  $sql = "INSERT INTO posts (Title, Content, Author, Image, Post_ID) VALUES (?,?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssi", $title, $body, $author, $imgurl, $user_id);
  $stmt->execute();
  if($stmt->affected_rows == 1) {
    redirectToPost($stmt->insert_id, "create=success");
  }
}


function updatePost($title, $body, $author, $imgurl, $num, $conn){
  $sql = "UPDATE posts SET Title = ?, Content = ?,  Author = ?, Image = ? WHERE posts.ID = $num";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $title, $body,  $author, $imgurl);
  $stmt->execute();
  if($stmt->affected_rows == 1) {
    redirectToPost($stmt->insert_id, "create=success");
  }
}


function getPost($id, $conn) {
  $sql = "SELECT * FROM posts WHERE ID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows == 1) {
    return $result->fetch_assoc();
  } else {
    return false;
  }
}

function getPosts($num_posts, $conn, $limit = 12, $offset = 0) {
  $sql = "SELECT posts.ID, posts.Title, posts.Content, posts.Author, posts.Image,posts.post_ID, users.username FROM posts JOIN users ON users.id = posts.Post_ID
 ORDER BY posts.Date_time DESC LIMIT ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $num_posts);
  $stmt->execute();
  $results = $stmt->get_result();
  return $results->fetch_all(MYSQLI_ASSOC);
}

function outputPosts($posts, $col = 6, $img = true, $teaserlen = 150, $readmore = true) {
  $output = "";
  foreach ($posts as $post) {
    if($img == true) {
      if($post['Image'] == '') {
        $theimg = "images/default.png";
      } else {
        $theimg = $post['Image'];
      }
      $postimg = "<img src='{$theimg}' style='max-width:100%'>";
    } else {
      $postimg = "";
    }
    $body = substr($post['Content'], 0, $teaserlen);
    $output.= "<div class='col-md-{$col}'> {$postimg}
      <div class='text-block10'>
    <h3 class='font-weight-light text-center'><a class='title' href='article.php?id={$post['ID']}'>Title : {$post['Title']}</a></h3>
    <h4 class='text-center'>Author: <em>{$post['Author']}</em></h4>
    <p class='text-center'>Content : {$body}</p>
      </div>
    </div>";
  }
  return $output;
}

function checkUser($post, $file, &$errors, $conn, $num) {
  $user = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
  $imgurl = validateFile($file, "img");
  $_SESSION['loggedin'] = true;
  $_SESSION['username'] = $_POST['username'];

  if ($password != $cpassword) {
      $errors['pass_match'] = "Password Not Matched!";
  }

  if(validateFile($file, "image")) {
    $errors['post_img'] = "There was a problem with your image upload!";
  }

  if(!$imgurl) {
    $errors['post_file'] = "There was a problem with your image upload!";
  }

  if(empty($errors) && $num == 0 ) {
    $sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
      createUser($user, $email, $password, $imgurl, $conn);
    } else {
      echo "<script>alert('Woops! Something Wrong Went.')</script>";
    }
  } else {
    echo "<script>alert('Woops! Email Already Exists.')</script>";
  }
}

function createUser($name, $email, $password, $imgurl, $conn) {
  $sql = "INSERT INTO posts (username, email, password,user_img) VALUES (?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $name, $email, $password, $imgurl);
  $stmt->execute();
  if($stmt->affected_rows == 1) {
    echo "<script>alert('Wow! User Registration Completed.')</script>";
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $row['username'];
    $_SESSION['user_id'] = $row['id'];
    $location = "Location:  index.php?id=" . $stmt->insert_id . "&new=true";
    header($location);
  }
}

 function getUser($id,$conn) {
  $sql = "SELECT * FROM users WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $results = $stmt->get_result();
  if($results->num_rows == 1) {
    return $results->fetch_assoc();
  } else {
    return false;
  }
}

 function outputUser($post, $img = true, $col = 6, $teaserlen = 150, $readmore = true) {
  $output = "";
    if($img == true) {
      if($post['user_img'] == '') {
        $theimg = "images/default.png";
      } else {
        $theimg = $post['user_img'];
      }
      $postimg = "<img src='{$theimg}' style='max-width:100%'>";
    } else {
      $postimg = "";
    }
    $output.= "<div class='col-md-{$col}'>
    {$postimg}
    <h3 class='text-center'>Name : {$post['username']}</h3>
    <h4 class='font-weight-light text-center'>ID: {$post['id']}</h4>
    <h4 class='font-weight-light text-center'>Email: <em>{$post['email']}</em></h4>
    <br>
    </div>";
  return $output;
}

function redirectToPost($id, $get = false) {
  $location = "Location: index.php?id=". $id . "&created=true";
  header($location);
}?>
