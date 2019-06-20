<?php
  $conn = mysqli_connect('localhost','root','admin1234','opentutorials');
  settype($_POST['id'], 'integer');
  $filtered = array('id'=>mysqli_real_escape_string($conn,$_POST['id']),
                  );

  $sql = "DELETE FROM topic WHERE author_id = {$filtered['id']}";
  mysqli_query($conn, $sql);



  $sql = "DELETE FROM author WHERE id = {$filtered['id']}";
  $result = mysqli_query($conn, $sql);
  if($result === false){
    echo "데이터 처리 도중에 문제가 생겼습니다 관리자에게 문의하세요";
    error_log(mysqli_error($conn));
  } else{
    header('Location: author.php');

  }

?>
