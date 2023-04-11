<?php
session_start();
require("config.php");
$errorMessage = "";
if (isset($_SESSION["stu_user_name"])) {
  header("Location: dashboard.php");
}
if (isset($_POST["username"])) {
  $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $result = mysqli_query($con, "SELECT `id`,`type` FROM `login` WHERE `username` = '" . $_POST["username"] . "' AND `password` = '" . md5($_POST["password"]) . "' AND `type` = 'student'");
  if ($result) {
    $rows = mysqli_num_rows($result);
    if ($rows !== 0) {
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $_SESSION["stu_user_name"] = $_POST["username"];
        $_SESSION["stu_type"] = $row["type"];
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
  <title>Student Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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

    @media only print {
      .dontprint {
        display: none
      }
    }
  </style>
</head>

<body>
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center">
      <div class="col-12">
        <div class="row">
          <div class="col-2">
            <img src="./assets/logo_avptc_new.png" style="max-width:150px" alt="" class="img-fluid">
          </div>
          <div class="col">
            <h2 style="color:#00a;text-align:center;" class="mt-4 mb-0">அன்னை வேளாங்கன்னி பாலிடெக்னிக் கல்லூரி</h2>
            <h3 class="mt-2 mb-2" style="color:#d00;font-size:20px;text-align:center;">(AN ISO 9001:2015 CERTIFIED
              INSTITUTION)<br />Run by
              the Sister's
              of St.Anne Trichy</h3>
            <h2 style="color:#00a;text-align:center;font-size:22px">அங்குச்செட்டிபாளையம், பண்ருட்டி - 607106</h2>
          </div>
          <div class="col-2">
            <img src="./assets/avptc_acc.png" alt="" class="img-fluid">
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-6 offset-lg-3 mt-3">
            <?php if ($errorMessage !== "") { ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
              </div>
            <?php } ?>
            <form action="" method="post">
              <h1 class="title mb-3">Student Login</h1>
              <div class="mb-3">
                <label for="username" class="form-label">Register No</label>
                <input class="form-control" id="username" type="text" name="username" placeholder="Enter your register number" />
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