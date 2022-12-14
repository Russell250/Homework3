
    <?php require_once("header.php"); ?>
    <h1>Director</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Director ID</th>
      <th>Director Name</th>
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

$sql = "SELECT * from Director";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["DirectorID"]?></td>
    <td><?=$row["DirectorName"]?></td>
    <td>
         <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editActors<?=$row["DirectorID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editActors<?=$row["DirectorID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editActors<?=$row["DirectorID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editActors<?=$row["DirectorName"]?>Label">Edit Item</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editActors<?=$row["DirectorID"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editActors<?=$row["DirectorID"]?>Name" aria-describedby="editActors<?=$row["DirectorID"]?>Help" name="iName" value="<?=$row['DirectorName']?>">
                          <div id="editActors<?=$row["DirectorID"]?>Help" class="form-text">Enter the Director's name.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['DirectorID']?>">
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
                <input type="hidden" name="iid" value="<?=$row["DirectorID"]?>" />
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
              <h1 class="modal-title fs-5" id="addActorsLabel">Add Director</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="ActorName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="ActorName" aria-describedby="nameHelp" name="iName">
                  <div id="nameHelp" class="form-text">Enter the Item's name.</div>
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
