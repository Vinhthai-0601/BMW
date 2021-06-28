<?php
$errors = [];
function checkPost($post, $file, &$errors, $conn, $num) {
  $title = $_POST['title'];
  $body = $_POST['content'];
  // $cmt = $_POST['comment'];
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

// public function deletePost() {
//   $sql = "DELETE FROM posts WHERE id = ?";
//   $stmt = $this->conn->prepare($sql);
//   $stmt->bind_param("i", $this->id);
//   $stmt->execute();
//   if($stmt->affected_rows == 1) {
//     echo "<h1 class='display-2'>Post was deleted!</h1>".
//     "<a href='index.php?id=1'><button class='btn btn-primary'>Return Home</button></a>";
//   } else {
//    echo '<div class="alert alert-danger" role="alert">
//       Row not found or deleted!
//     </div>';
//   }
// }

function redirectToPost($id, $get = false) {
  $location = "Location: index.php?id=". $id . "&created=true";
  header($location);
}?>
