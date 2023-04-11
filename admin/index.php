<?php
session_start();
require("../config.php");
$errorMessage = "";
if (isset($_SESSION["admin_user_id"])) {
  header("Location: dashboard.php");
}
if (isset($_POST["username"])) {
  $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $result = mysqli_query($con, "SELECT `id`,`type` FROM `login` WHERE `username` = '" . $_POST["username"] . "' AND `password` = '" . md5($_POST["password"]) . "' AND `type` = 'admin'");
  if ($result) {
    $rows = mysqli_num_rows($result);
    if ($rows !== 0) {
      while ($row = mysqli_fetch_row($result)) {
        $_SESSION["admin_user_id"] = $row[0];
        $_SESSION["stu_type"] = "admin";
        header("Location: dashboard.php");
      }
    } else {
      $errorMessage = "Username/Password doesn't match";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
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
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <?php if ($errorMessage !== "") { ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
              </div>
            <?php } ?>
            <form action="" method="post">
              <h1 class="title mb-3">Admin Login</h1>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" id="username" type="text" name="username" placeholder="Enter your username" />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" id="password" type="password" name="password" placeholder="Enter your password" />
              </div>
              <div>
                <input class="btn btn-primary" type="submit" value="Login" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>