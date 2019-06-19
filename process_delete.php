<?php
  $conn = mysqli_connect('localhost','root','admin1234','opentutorials');
  settype($_POST['id'], 'integer');
  $filtered = array('id'=>mysqli_real_escape_string($conn,$_POST['id']),
                  );


  $sql = "DELETE FROM topic WHERE id = {$filtered['id']}
          ";
  $result = mysqli_query($conn, $sql);
  if($result === false){
    echo "데이터 처리 도중에 문제가 생겼습니다 관리자에게 문의하세요";
    error_log(mysqli_error($conn));
  } else{
    echo "삭제되었습니다.<br>";
    echo '<a href="index.php">돌아가기</a>';

  }

?>
