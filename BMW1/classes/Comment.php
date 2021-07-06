<?php

class Comment {
  //class properties
  public $comment_text;
  public $comment_author;
  public $comment_user_id;
  public $post_id;
  public $comment_id;
  public $comment = [];
  public $comments = [];
  public $conn;

  // constructor function
  public function __construct($post_id, $conn) {
    $this->post_id = $post_id;
    $this->conn = $conn;
  }

  public function createComment($comment) {
    $this->comment_text = $comment;
    $sql = "INSERT INTO comments (comment_text, comment_user, comment_post) VALUES (?,?,?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sii", $this->comment_text, $_SESSION['user_id'], $this->post_id);
    $stmt->execute();
    if($stmt->affected_rows == 1) {
      $this->insert_id = $stmt->insert_id;
      // this will return the comment as a json encoded string
      $this->getComment();
    }
  }

  // Comment methods : CRUD etc
  public function getComments() {
    $sql = "SELECT cm.ID AS CID, cm.comment_text, u.username, u.id AS UID, cm.date_created FROM comments cm JOIN users u ON u.id = cm.comment_user WHERE cm.comment_post = ? AND cm.comment_parent IS NULL ORDER BY cm.date_created DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $this->comments = $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getComment() {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    $sql = "SELECT cm.ID, cm.comment_text, u.username, cm.date_created FROM comments cm JOIN users u ON u.id = cm.comment_user WHERE cm.ID = ?";
=======
    $sql = "SELECT cm.ID as comment_id, cm.comment_text, u.username, cm.date_created FROM comments cm JOIN users u ON u.id = cm.comment_user WHERE cm.ID = ?";
>>>>>>> Stashed changes
=======
    $sql = "SELECT cm.ID as comment_id, cm.comment_text, u.username, cm.date_created FROM comments cm JOIN users u ON u.id = cm.comment_user WHERE cm.ID = ?";
>>>>>>> Stashed changes
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->insert_id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result);
    echo json_encode($result->fetch_assoc());
}



<<<<<<< Updated upstream
<<<<<<< Updated upstream
  public function outputComments() {
    $output = '';
    foreach ($this->comments as $comment) {
      $output .= "<div class='card mt-2 mb-2 comment-wrapper grow'>
        <div class='card-header'>
          {$comment['username']} | {$comment['date_created']}
          <a href='func/commentmanager.php?id={$comment['ID']}'>
          <button class='btn btn-outline-danger btn-sm  float-right delete-post' comment-id={$comment['ID']} >X</button>
          </a>
        </div>
          <div class='card-body'>
            <p class='card-text comment-p'>{$comment['comment_text']} </p>
          </div>
      </div>";
    }
    echo $output;
  }

=======
  public function outputComments($replies) {
    $output = "";
    foreach ($this->comments as $comment) {
    echo "<div class='comment-wrapper col-md-12'>
      <div class='col-md-8 mt-2 mb-2 comment'>
      <div class='card'>
        <div class='card-header'>
        <a href='user.php?id={$comment['UID']}' class='comment-user-id' data-comment-user-id='{$comment['UID']}'>
          {$comment['username']}</a>| {$comment['date_created']}

=======
  public function outputComments($replies) {
    $output = "";
    foreach ($this->comments as $comment) {
    echo "<div class='comment-wrapper col-md-12'>
      <div class='col-md-8 mt-2 mb-2 comment'>
      <div class='card'>
        <div class='card-header'>
        <a href='user.php?id={$comment['UID']}' class='comment-user-id' data-comment-user-id='{$comment['UID']}'>
          {$comment['username']}</a>| {$comment['date_created']}

>>>>>>> Stashed changes
          <button class='btn btn-outline-danger btn-sm  float-right delete-post' data-comment-id={$comment['CID']} >X</button>

           <button class='btn float-right btn-sm btn-outline-secondary mr-2 reply-comment' data-comment-id='{$comment['CID']}' data-comment-user-id='{$comment['UID']}'>reply</button>
        </div>

          <div class='card-body'>
            <p class='card-text comment-p'>{$comment['comment_text']} </p>
          </div>
        </div>
      </div> </div>";

      $replies->outputReplies($comment['CID']);
    }
    echo "</div>";
  }

<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
public function getCommentID($comment_id){
  $sql = "SELECT * FROM comments WHERE ID = ?";
  $stmt = $this->conn->prepare($sql);
  $stmt->bind_param("i", $comment_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $this->comment = $result->fetch_assoc();
}

  public function deleteComment($comment_id) {
    $this->getCommentID($comment_id);
    if($this->comment['comment_user'] == $_SESSION['user_id'] || $_SESSION['user_role'] == 1) {
      $sql = "DELETE FROM comments WHERE ID = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("i", $this->comment['ID']);
      $stmt->execute();
      if($stmt->affected_rows == 1) {
        echo json_encode(true);
      } else {
        echo json_encode(false);
      }
    } else {
      echo json_encode(false);
    }
  }
}

 ?>
