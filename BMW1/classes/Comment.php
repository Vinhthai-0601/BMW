<?php

class Comment {
  //class properties
  public $comment_text;
  public $comment_author;
  public $comment_user_id;
  public $post_id;
  public $comment_id;
  public $comment;
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
    $sql = "SELECT cm.ID, cm.comment_text, u.username, cm.date_created FROM comments cm JOIN users u ON u.id = cm.comment_user WHERE cm.comment_post = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $this->comments = $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getComment() {
    $sql = "SELECT cm.ID, cm.comment_text, u.username, cm.date_created FROM comments cm JOIN users u ON u.id = cm.comment_user WHERE cm.comment_post = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->insert_id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result);
    echo json_encode($result->fetch_assoc());
}



  public function outputComments() {
    $output = "";
    foreach ($this->comments as $comment) {
      $output .= "<div class='card mt-2 mb-2 comment-wrapper grow'>
        <div class='card-header'>
          {$comment['username']} | {$comment['date_created']}
          <a href='func/commentmanager.php?id={$comment['ID']}'>
          <button class='btn btn-outline-danger btn-sm  float-right delete-post' comment-id={$comment['ID']} >X</button></a></div>
          <div class='card-body'>
            <p class='card-text comment-p'>{$comment['comment_text']} </p>
          </div>
      </div>";
    }
    echo $output;
  }

  public function deleteComment($comment_id) {
    $this->comment_id = $comment_id;
    $this->getComment();
    $_SESSION['comment'] = $this->comment;
    if($this->comment['comment_user'] == $_SESSION['user_id'] || $_SESSION['user_role'] == 1) {
      $this->comment_id = $comment_id;
      $sql = "DELETE FROM comments WHERE ID = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("i", $this->comment_id);
      $stmt->execute();
      if($stmt->affected_rows == 1) {
        echo true;
      } else {
        echo false;
      }
    } else {
      echo false;
    }
  }


}

 ?>
