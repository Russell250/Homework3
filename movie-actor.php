<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sections</title>
    < rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Sections</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Movie ID</th>
      <th>Movie Name</th>
      <th>Movie Desc</th>
      <th>Actor ID</th>
      <th>Actor Name</th>
    </tr>
  </thead>
  <tbody>
    <?php
$servername = "localhost:3306";
$username = "russtayl_sample";
$password = "0w_zeP}]OVy0";
$dbname = "russtayl_sample";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$cid = $_POST['id'];
//echo $iid;
$sql = "select movieid, moviename, moviedesc, a.actorid, a.actorname  from actor a join movie m on a.actorid = m.actorid" . $cid;
//echo $sql;
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["movieid"]?></td>
    <td><?=$row["moviename"]?></td>
    <td><?=$row["moviedesc"]?></td>
    <td><?=$row["actorid"]?></td>
    <td><?=$row["actorname"]?></td>
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
