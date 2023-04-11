<?php
session_start();
require("../config.php");
$errorMessage = "";
$successMessage = "";
$url = explode('/', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
array_pop($url);
if (!isset($_SESSION["admin_user_id"])) {
  header("Location: " . implode('/', $url) . "/");
}
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (isset($_REQUEST["id"])) {
  $result = mysqli_query($con, "SELECT * FROM `student_details` WHERE `regno` = '" . $_REQUEST["id"] . "'");
}
if (isset($_POST["regno"])) {
  $daysScholar = 0;
  $hostelScholar = 0;
  if ($_POST["scholar"] == "days_scholar") {
    $daysScholar = 1;
  } else {
    $hostelScholar = 1;
  }
  $travel = 0;
  if ($_POST["travel_type"] == "1") {
    $travel = 1;
  }
  mysqli_query($con, "UPDATE `student_details` SET `sname` = '" . $_POST["sname"] . "', `gender` = '" . $_POST["gender"] . "', `dob` = '" . $_POST["dob"] . "', `bcode` = '" . $_POST["bcode"] . "', `bname` = '" . $_POST["bname"] . "', `address` = '" . $_POST["address"] . "', `sphone_no` = '" . $_POST["sphone_no"] . "', `commty` = '" . $_POST["commty"] . "', `join_aca_year` = '" . $_POST["join_aca_year"] . "', `admi_type` = '" . $_POST["admi_type"] . "', `mail_id` = '" . $_POST["mail_id"] . "', `days_scholar` = '" . $daysScholar . "', `hostel_scholar` = '" . $hostelScholar . "', `bus_travel` = '" . $travel . "' WHERE `regno` = '" . $_POST["regno"] . "'");
  $successMessage = "Successfully updated";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
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
        <div class="mt-4">
          <h1>Edit Student Details</h1>
          <form action="" method="post">
            <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
              <div class="mt-3">
                <label for="regno" class="form-label">Register Number</label>
                <input type="text" name="regno" id="regno" class="form-control" value="<?php echo $row["regno"]; ?>" />
              </div>
              <div class="mt-3">
                <label for="sname" class="form-label">Student Name</label>
                <input type="text" name="sname" id="sname" class="form-control" value="<?php echo $row["sname"]; ?>" />
              </div>
              <div class="mt-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-control">
                  <option value="">Choose</option>
                  <option value="Male" <?php if ($row["gender"] == "Male") {
                                          echo " selected";
                                        } ?>>Male</option>
                  <option value="Female" <?php if ($row["gender"] == "Female") {
                                            echo " selected";
                                          } ?>>Female</option>
                  <option value="Other" <?php if ($row["gender"] == "Other") {
                                          echo " selected";
                                        } ?>>Other</option>
                </select>
              </div>
              <div class="mt-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control" value="<?php echo $row["dob"]; ?>" />
              </div>
              <div class="mt-3">
                <label for="bcode" class="form-label">Branch Code</label>
                <select class="form-control" id="bcode" name="bcode">
                  <option value="">Select</option>
                  <option value="1010" <?php if ($row["bcode"] == "1010") {
                                          echo " selected";
                                        } ?>>1010</option>
                  <option value="1020" <?php if ($row["bcode"] == "1020") {
                                          echo " selected";
                                        } ?>>1020</option>
                  <option value="1030" <?php if ($row["bcode"] == "1030") {
                                          echo " selected";
                                        } ?>>1030</option>
                  <option value="1040" <?php if ($row["bcode"] == "1040") {
                                          echo " selected";
                                        } ?>>1040</option>
                  <option value="1052" <?php if ($row["bcode"] == "1052") {
                                          echo " selected";
                                        } ?>>1052</option>
                </select>
              </div>
              <div class="mt-3">
                <label for="bname" class="form-label">Branch Name</label>
                <input class="form-control" readonly="true" id="bname" type="text" name="bname" value="<?php echo $row["bname"]; ?>" />
              </div>
              <div class="mt-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" type="text" name="address" value="<?php echo $row["address"]; ?>"></textarea>
              </div>
              <div class="mt-3">
                <label for="sphone_no" class="form-label">Student Phone Number</label>
                <input class="form-control" id="sphone_no" type="text" name="sphone_no" value="<?php echo $row["sphone_no"]; ?>" />
              </div>
              <div class="mt-3">
                <label for="commty" class="form-label">Community</label>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="commty" id="BC" value="BC" <?php if ($row["commty"] == "BC") {
                                                                                                  echo " checked";
                                                                                                } ?> /> <label for="BC" class="form-check-label">BC</label>
                </div>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="commty" id="MBC" value="MBC" <?php if ($row["commty"] == "MBC") {
                                                                                                    echo " checked";
                                                                                                  } ?> /> <label for="MBC" class="form-check-label">MBC</label>
                </div>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="commty" id="SC" value="SC/ST" <?php if ($row["commty"] == "SC/ST") {
                                                                                                      echo " checked";
                                                                                                    } ?> /> <label for="SC" class="form-check-label">SC/ST</label>
                </div>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="commty" id="BCM" value="BCM" <?php if ($row["commty"] == "BCM") {
                                                                                                    echo " checked";
                                                                                                  } ?> /> <label for="BCM" class="form-check-label">BCM</label>
                </div>
              </div>
              <div class="mt-3">
                <label for="join_aca_year" class="form-label">Joining Academic Year</label>
                <input class="form-control" id="join_aca_year" type="text" name="join_aca_year" value="<?php echo $row["join_aca_year"]; ?>" />
              </div>
              <div class="mt-3">
                <label for="admi_type" class="form-label">Admission Type</label>
                <select class="form-control" id="admi_type" type="text" name="admi_type">
                  <option value="">Choose Type</option>
                  <option value="First Year" <?php if ($row["admi_type"] == "First Year") {
                                                echo " selected";
                                              } ?>>First Year</option>
                  <option value="Lateral Entry" <?php if ($row["admi_type"] == "Lateral Entry") {
                                                  echo " selected";
                                                } ?>>Lateral Entry</option>
                </select>
              </div>
              <div class="mt-3">
                <label for="mail_id" class="form-label">Mail ID</label>
                <input class="form-control" id="mail_id" type="email" name="mail_id" value="<?php echo $row["mail_id"]; ?>" />
              </div>
              <div class="mt-3">
                <label class="form-label">Scholar Type</label>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="scholar" id="days_scholar" value="days_scholar" <?php if ($row["days_scholar"] == "1") {
                                                                                                                        echo " checked";
                                                                                                                      } ?> /> <label for="days_scholar" class="form-check-label">Days Scholar</label>
                </div>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="scholar" id="hostel_scholar" value="hostel_scholar" <?php if ($row["hostel_scholar"] == "1") {
                                                                                                                            echo " checked";
                                                                                                                          } ?> /> <label for="hostel_scholar" class="form-check-label">Hostel Scholar</label>
                </div>
              </div>
              <div class="mt-3">
                <label class="form-label">Travel Type</label>
                <div class="form-check">
                  <input type="checkbox" name="travel_type" class="form-check-input" id="travel_type" value="1" <?php if ($row["bus_travel"] == "1") {
                                                                                                                  echo " checked";
                                                                                                                } ?> /> <label for="travel_type" class="form-check-label">College Bus</label>
                </div>
              </div>
            <?php } ?>
            <div class="mt-3">
              <input class="btn btn-success" type="submit" value="Add" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script>
    jQuery(document).ready(function($) {
      $("#bcode").on("change", function(e) {
        let val = ""
        switch (e.target.value) {
          case "1010":
            val = "Civil"
            break
          case "1020":
            val = "Mech"
            break
          case "1030":
            val = "EEE"
            break
          case "1040":
            val = "ECE"
            break
          case "1052":
            val = "CSE"
            break
        }
        $("#bname").attr("value", val)
      })
    })
  </script>
</body>

</html>