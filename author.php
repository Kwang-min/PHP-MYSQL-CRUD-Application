<?php
$conn = mysqli_connect('localhost','root','admin1234','opentutorials');

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1><a href="index.php">WEB</a></h1>
    <p><a href="index.php">topic</a></p>
    <table border="1">
      <tr>
        <td>id</td><td>name</td><td>profile</td><td></td>
      </tr>
      <?php
        $sql = "SELECT * FROM author";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
          $filtered = array(
            'id'=> htmlspecialchars($row['id']),
            'name'=> htmlspecialchars($row['name']),
            'profile'=> htmlspecialchars($row['profile'])
          );
       ?>
       <tr>
         <td><?php echo $filtered['id']?></td>
         <td><?php echo $filtered['name']?></td>
         <td><?php echo $filtered['profile']?></td>
         <td><a href="author.php?id=<?php echo $filtered['id'] ?>">update</a></td>
         <td>
           <form action="process_delete_author.php" method="post"
           onsubmit="if(!confirm('sure?')){return false;}">
             <input type="hidden" name="id" value="<?php echo $filtered['id'] ?>">
             <input type="submit"  value="delete">
           </form>
         </td>
       </tr>
       <?php
        }
       ?>
    </table>
    <?php
    $escaped = array('name'=> '', 'profile'=> '');
    $label_submit = "Create author";
    $form_action = "process_create_author.php";
    $form_id = "";
    if(isset($_GET['id'])){
      $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
      settype($filtered_id, 'integer');
      $sql = "SELECT * FROM author WHERE id = {$filtered_id}";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      $escaped['name'] = htmlspecialchars($row['name']);
      $escaped['profile'] = htmlspecialchars($row['profile']);
      $label_submit = "Update author";
      $form_action = "process_update_author.php";
      $form_id = '<input type = "hidden" name = "id" value="'.$_GET['id'].'"';
    }
    ?>
    <form action="<?php echo $form_action ?>" method="post">
    <?php echo $form_id ?>
    <p><input type="text" name="name" placeholder="name" value ="<?php echo $escaped['name'] ?>"></p>
    <p><textarea name="profile" placeholder="profile"><?php echo $escaped['profile'] ?></textarea></p>
    <p><input type="submit" value="<?php echo $label_submit ?>"></p>
    </form>
  </body>
</html>
