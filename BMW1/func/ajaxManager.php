<?php
include '../classes/Comment.php';
include '../config.php';
if(isset($_POST['comment-submit'])) {
  $post_id = $_GET['id'];
  $comment_text = $_POST['comment-text'];
  $comment = new Comment($post_id, $conn);
  $comment->createComment($comment_text);
}

if(isset($_POST['delete-comment'])){
  $comment_id = $_POST['comment_id'];
  $post_id = $_SESSION['query_history'];
  $comment = new Comment($theid, $conn);
  $comment->deleteComment($comment_id);
}
 ?>
