
    <?php require_once("header.php"); ?>
<title>Actors</title>
  <body>
    <h1>Actors</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Actor ID</th>
      <th>Actor Name</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
$servername = "localhost";
$username = "russtayl_user";
$password = "RussTaylor2000";
$dbname = "russtayl_sample";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Actors (ActorName) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['iName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Actor added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Actors set ActorName=? where ActorID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['iName'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Actor edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Actors where ActorID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Actor deleted.</div>';
      break;
  }
}
?>

$sql = "SELECT * from Actors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["ActorID"]?></td>
    <td><a href="actorfile.php?id=<?=$row["ActorID"]?>"><?=$row["ActorName"]?></a></td>
    <td>
      <form method="post" action="movie-actor.php">
        <input type="hidden" name="id" value="<?=$row["ActorID"]?>" />
        <input type="submit" value="Movies"/>
      </form>
    </td>
  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
