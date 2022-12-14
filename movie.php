<!doctype html>
<html lang="en">
  <head>
    <?php require_once("header.php"); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie</title>
    <h1>Movie</h1>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    
<table class="table table-striped">
  <thead>
    <tr>
     <th>Movie ID</th>
      <th>Movie Name</th>
      <th>Movie Desc</th>
      <th></th>
    </tr>
    <tbody>
       <div class="row row-cols-1 row-cols-md-6 g-4">
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
      $sqlAdd = "insert into Movies (MovieName) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['iName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Movie added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Movies set MovieName=? where MovieID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['iName'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Movie edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Movies where MovieID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Movie deleted.</div>';
      break;
  }
}


$sql = "SELECT * from Movies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["MovieID"]?></td>
    <td><?=$row["MovieName"]?></td>
    <td><?=$row["MovieDesc"]?></td>
    <td>
         <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editActors<?=$row["MovieID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editActors<?=$row["MovieID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editActors<?=$row["MovieID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editActors<?=$row["MovieName"]?>Label">Edit Item</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editActors<?=$row["MovieID"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editActors<?=$row["MovieID"]?>Name" aria-describedby="editActors<?=$row["MovieID"]?>Help" name="iName" value="<?=$row['MovieName']?>">
                          <div id="editActors<?=$row["MovieID"]?>Help" class="form-text">Enter the Movie name.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['MovieID']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
                <form method="post" action="">
                <input type="hidden" name="iid" value="<?=$row["MovieID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
    </td>
  </tr>
<?php

      
      }
 } else {
  echo "0 results";
}
?>
  </tbody>
    </table>
<br />
       <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActors">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addActors" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addActorsLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addActorsLabel">Add Movie</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="MovieName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="ActorName" aria-describedby="nameHelp" name="iName">
                  <div id="nameHelp" class="form-text">Enter the Movie's name.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<?
$conn->close();
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
