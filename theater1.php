<?php require_once("header.php"); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theater</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Theaters</h1>
    <table class="table table-striped">
  <thead>
    <tr>
       <th>ID</th>
      <th>Name</th>
        <th>Location</th>
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
      $sqlAdd = "insert into Theaters (TheaterName, TheaterLocation) value (?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sS", $_POST['mName'], $_POST['sid']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Theater added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Theaters set TheaterName=?, TheaterLocation=? where TheaterID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssi", $_POST['mName'], $_POST['sid'], $_POST['mid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Theater edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Theaters where TheaterID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['mid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Theater deleted.</div>';
      break;
  }
}
?>         
<?php
$sql = "SELECT TheaterID, TheaterName, TheaterLocation from Theaters";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["TheaterName"]?></td>
            <td><?=$row["TheaterLocation"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editTheater<?=$row["TheaterID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editTheater<?=$row["TheaterID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTheater<?=$row["TheaterID"]?>Label" aria-hidden="true">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editTheater<?=$row["TheaterID"]?>Label">Edit Theater</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editTheater<?=$row["TheaterID"]?>Name" class="form-label">Theater Name</label>
                          <input type="text" class="form-control" id="editTheater<?=$row["TheaterID"]?>Name" aria-describedby="editTheater<?=$row["TheaterID"]?>Help" name="mName" value="<?=$row['TheaterName']?>">
                          <div id="editTheater<?=$row["TheaterID"]?>Help" class="form-text">Enter the Theater's name.</div>
                          <div class="mb-3">
                          <label for="locationList" class="form-label">Location</label>
                          <select class="form-select" aria-label="Select Location" id="locationList" name="sid">
                          <?php
                       $Sql = "select * from Theaters order by TheaterLocation";
    $result = $conn->query($Sql);
    while($Row = $result->fetch_assoc()) {
      if ($Row['TheaterID'] == $Row['TheaterID']) {
        $selText = " selected";
      } else {
        $selText = "";
      }
?>
  <option value="<?=$Row['TheaterID']?>"<?=$selText?>><?=$Row['TheaterLocation']?></option>
<?php
    }
?>
                            </select>
                        </div>
                        <input type="hidden" name="mid" value="<?=$row['TheaterID']?>">
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
                <input type="hidden" name="mid" value="<?=$row["TheaterID"]?>" />
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
$conn->close();
?>
          
        </tbody>
      </table>
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTheater">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addTheater" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTheaterLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addTheaterLabel">Add Theater</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="TheaterName" class="form-label">Theater Name</label>
                  <input type="text" class="form-control" id="mName" aria-describedby="nameHelp" name="mName">
                    <div id="nameHelp" class="form-text">Enter the Theater's name.</div>
                  <label for="TheaterLocation" class="form-label">Theater Location</label>
                  <input type="text" class="form-control" id="sName" aria-describedby="nameHelp" name="sName">
                  <div id="nameHelp" class="form-text">Enter the Theator's location.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
