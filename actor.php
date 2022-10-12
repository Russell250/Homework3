<!doctype html>
<html lang="en">
  <head>
    <?php require_once("header.php"); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
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

$sql = "SELECT * from Actors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["ActorID"]?></td>
    <td><?=$row["ActorName"]?></td>
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
