<?php
include '../classes/Comment.php';
include '../config.php';
if(isset($_POST['comment'])) {
  $theid = $_POST['post_id'];
  $comment_text = $_POST['comment'];
  $comment = new Comment($theid, $conn);
  $comment->createComment($comment_text);
  echo json_encode($comment->comment);
}

if(isset($_POST['delete-comment'])){
  var_dump($_POST['comment_id']);
  $comment_id = $_POST['comment_id'];
  $post_id = $_SESSION['query_history'];
  $comment = new Comment($theid, $conn);
  $comment->deleteComment($comment_id);
}
 ?>
