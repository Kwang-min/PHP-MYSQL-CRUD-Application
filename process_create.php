<?php
  $conn = mysqli_connect('localhost','root','admin1234','opentutorials');

  $filtered = array('title'=>mysqli_real_escape_string($conn,$_POST['title']),
                    'description'=>mysqli_real_escape_string($conn,$_POST['description']));


  $sql = "INSERT INTO topic (title, description, created)
          VALUES('{$filtered['title']}', '{$filtered['description']}', NOW())";
  $result = mysqli_query($conn, $sql);
  if($result === false){
    echo "데이터 처리 도중에 문제가 생겼습니다 관리자에게 문의하세요";
    error_log(mysqli_error($conn));
  } else{
    echo "성공적으로 저장되었습니다<br>";
    echo '<a href="index.php">돌아가기</a>';

  }

?>
