<?php require_once("header.php"); ?>
    <h1>Movie Details</h1>
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
$cid = $_POST['id'];
//echo $iid;
$sql = "select MovieID, MovieName, MovieDesc, a.ActorID, a.ActorName from Actors a join Movies m on a.ActorID = m.ActorID where a.ActorID=" . $cid;
//echo $sql;
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["MovieID"]?></td>
    <td><?=$row["MovieName"]?></td>
    <td><?=$row["MovieDesc"]?></td>
    <td><?=$row["ActorID"]?></td>
    <td><?=$row["ActorName"]?></td>
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
