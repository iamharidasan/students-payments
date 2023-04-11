<?php
session_start();
require("../config.php");
$errorMessage = "";
$url = explode('/', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
array_pop($url);
if (!isset($_SESSION["admin_user_id"])) {
  header("Location: " . implode('/', $url) . "/");
}
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (isset($_REQUEST["delete"])) {
  mysqli_query($con, "DELETE FROM `student_details` WHERE `regno` = '" . $_REQUEST["delete"] . "'");
}
$result = mysqli_query($con, "SELECT * FROM `student_details`");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <style>
    html,
    body {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    h1.title {
      margin: 0;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-2 h-100">
        <?php include("sidebar.php"); ?>
      </div>
      <div class="col-10">
        <div class="mt-4 text-right">
          <a href="add-student.php" class="btn btn-info">Add Student</a>
        </div>
        <div class="table-responsive mt-4">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Reg No.</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Join Academic Year</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($result) {
                $rows = mysqli_num_rows($result);
                if ($rows != 0) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                    <tr>
                      <th><?php echo $row["regno"] ?></th>
                      <td><a href="view-student.php?id=<?php echo $row["regno"]; ?>"><?php echo $row["sname"] ?></a></td>
                      <td><?php echo $row["gender"] ?></td>
                      <td><?php echo $row["join_aca_year"] ?></td>
                      <td><a href="edit-student.php?id=<?php echo $row["regno"]; ?>">Edit</a> | <a href="students.php?delete=<?php echo $row["regno"]; ?>">Delete</a></td>
                    </tr>
                  <?php }
                } else { ?>
                  <tr>
                    <th colspan="5" style="text-align:center">
                      No Results found
                    </th>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>