<?php
include '../classes/Comment.php';
include '../config.php';
if(isset($_POST['comment'])) {
  $post_id = $_POST['post_id'];
  $comment_text = $_POST['comment'];
  $comment = new Comment($post_id, $conn);
  $comment->createComment($comment_text);
  // echo json_encode($comment);
}

if(isset($_POST['delete-comment'])){
  var_dump($_POST['comment_id']);
  $comment_id = $_POST['comment_id'];
  $post_id = $_SESSION['query_history'];
  $comment = new Comment($theid, $conn);
  $comment->deleteComment($comment_id);
}
 ?>
