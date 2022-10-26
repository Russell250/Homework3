
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
      $sqlEdit = "update Actors set ActorName=? where ActorName=?";
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
         <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editActors<?=$row["ActorID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editActors<?=$row["ActorID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editActors<?=$row["ActorID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editActors<?=$row["ActorID"]?>Label">Edit Actor</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editActors<?=$row["ActorID"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editActors<?=$row["ActorID"]?>Name" aria-describedby="editActors<?=$row["ActorID"]?>Help" name="iName" value="<?=$row['ActorName']?>">
                          <div id="editActors<?=$row["ActorID"]?>Help" class="form-text">Enter the Actors name.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['ActorName']?>">
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
                <input type="hidden" name="iid" value="<?=$row["ActorID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
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
              <h1 class="modal-title fs-5" id="addActorsLabel">Add Actor</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="ActorName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="ActorName" aria-describedby="nameHelp" name="iName">
                  <div id="nameHelp" class="form-text">Enter the Actor's name.</div>
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
