<?php

class User {

  public $user_id;
  public $user_name;
  public $user_role;
  public $user_password;
  public $user_hash;
  public $user_email;
  public $conn;
  public $role;
  public $user = [];
  public $users = [];

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function getUser($id,$conn) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $results = $stmt->get_result();
    if($result->num_rows == 1) {
      return $result->fetch_assoc();
    } else {
      return false;
    }
  }

  public function outputUser($user, $teaserlen = 150, $readmore = true) {
    $output = "";
      // if($img == true) {
      //   if($post['Image'] == '') {
      //     $theimg = "images/default.png";
      //   } else {
      //     $theimg = $post['Image'];
      //   }
      //   $postimg = "<img src='{$theimg}' style='max-width:100%'>";
      // } else {
      //   $postimg = "";
      // }
      $body = substr($post['Content'], 0, $teaserlen);
      $output.= "<div class='col-md-{$col}'>
        <div class='text-block10'>
      <h3 class='font-weight-light text-center'><a class='title' href='article.php?id={$post['ID']}'>Title : {$post['Title']}</a></h3>
      <h4 class='text-center'>Author: <em>{$post['Author']}</em></h4>
      <p class='text-center'>Content : {$body}</p>
        </div>
      </div>";
    return $output;
  }
}

 ?>
