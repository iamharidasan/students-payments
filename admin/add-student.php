<?php
session_start();
require("../config.php");
$errorMessage = "";
$successMessage = "";
if (!isset($_SESSION["admin_user_id"])) {
  header("Location: /admin");
}
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
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
  mysqli_query($con, "INSERT INTO `student_details`(`regno`, `sname`, `gender`, `dob`, `bcode`, `bname`, `address`, `sphone_no`, `commty`, `join_aca_year`, `admi_type`, `mail_id`, `days_scholar`, `hostel_scholar`, `bus_travel`) VALUES ('" . $_POST["regno"] . "','" . $_POST["sname"] . "','" . $_POST["gender"] . "','" . $_POST["dob"] . "','" . $_POST["bcode"] . "','" . $_POST["bname"] . "','" . $_POST["address"] . "','" . $_POST["sphone_no"] . "','" . $_POST["commty"] . "','" . $_POST["join_aca_year"] . "','" . $_POST["admi_type"] . "','" . $_POST["mail_id"] . "','" . $daysScholar . "','" . $hostelScholar . "','" . $travel . "')");
  mysqli_query($con, "INSERT INTO `login`(`username`, `password`, `type`) VALUES ('" . $_POST["mail_id"] . "','" . md5("12345678") . "','student')");
  $successMessage = "Successfully created";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>
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
          <h1>Add Student Details</h1>
          <form action="" method="post">
            <div class="mt-3">
              <label for="regno" class="form-label">Register Number</label>
              <input type="text" name="regno" id="regno" class="form-control" />
            </div>
            <div class="mt-3">
              <label for="sname" class="form-label">Student Name</label>
              <input type="text" name="sname" id="sname" class="form-control" />
            </div>
            <div class="mt-3">
              <label for="gender" class="form-label">Gender</label>
              <select name="gender" id="gender" class="form-control">
                <option value="">Choose</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="mt-3">
              <label for="dob" class="form-label">Date of Birth</label>
              <input type="date" name="dob" id="dob" class="form-control" />
            </div>
            <div class="mt-3">
              <label for="bcode" class="form-label">Branch Code</label>
              <select class="form-control" id="bcode" name="bcode">
                <option value="">Select</option>
                <option value="1010">1010</option>
                <option value="1020">1020</option>
                <option value="1030">1030</option>
                <option value="1040">1040</option>
                <option value="1052">1052</option>
              </select>
            </div>
            <div class="mt-3">
              <label for="bname" class="form-label">Branch Name</label>
              <input class="form-control" readonly="true" id="bname" type="text" name="bname" />
            </div>
            <div class="mt-3">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" id="address" type="text" name="address"></textarea>
            </div>
            <div class="mt-3">
              <label for="sphone_no" class="form-label">Student Phone Number</label>
              <input class="form-control" id="sphone_no" type="text" name="sphone_no" />
            </div>
            <div class="mt-3">
              <label for="commty" class="form-label">Community</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="commty" id="BC" value="BC" /> <label for="BC" class="form-check-label">BC</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="commty" id="MBC" value="MBC" /> <label for="MBC" class="form-check-label">MBC</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="commty" id="SC" value="SC/ST" /> <label for="SC" class="form-check-label">SC/ST</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="commty" id="BCM" value="BCM" /> <label for="BCM" class="form-check-label">BCM</label>
              </div>
            </div>
            <div class="mt-3">
              <label for="join_aca_year" class="form-label">Joining Academic Year</label>
              <input class="form-control" id="join_aca_year" type="text" name="join_aca_year" />
            </div>
            <div class="mt-3">
              <label for="admi_type" class="form-label">Admission Type</label>
              <select class="form-control" id="admi_type" type="text" name="admi_type">
                <option value="">Choose Type</option>
                <option value="First Year">First Year</option>
                <option value="Lateral Entry">Lateral Entry</option>
              </select>
            </div>
            <div class="mt-3">
              <label for="mail_id" class="form-label">Mail ID</label>
              <input class="form-control" id="mail_id" type="email" name="mail_id" />
            </div>
            <div class="mt-3">
              <label class="form-label">Scholar Type</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="scholar" id="days_scholar" value="days_scholar" /> <label for="days_scholar" class="form-check-label">Days Scholar</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="scholar" id="hostel_scholar" value="hostel_scholar" /> <label for="hostel_scholar" class="form-check-label">Hostel Scholar</label>
              </div>
            </div>
            <div class="mt-3">
              <label class="form-label">Travel Type</label>
              <div class="form-check">
                <input type="checkbox" name="travel_type" class="form-check-input" id="travel_type" value="1" /> <label for="travel_type" class="form-check-label">College Bus</label>
              </div>
            </div>
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