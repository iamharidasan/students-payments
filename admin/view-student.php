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
if (isset($_REQUEST["id"])) {
  $result = mysqli_query($con, "SELECT * FROM `student_details` WHERE `regno` = '" . $_REQUEST["id"] . "'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Student</title>
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
        <?php
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
          <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3">
              <h1>Student Details:</h1>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>Register Number</th>
                      <td><?php echo $row["regno"] ?></td>
                    </tr>
                    <tr>
                      <th>Student Name</th>
                      <td><?php echo $row["sname"] ?></td>
                    </tr>
                    <tr>
                      <th>Gender</th>
                      <td><?php echo $row["gender"] ?></td>
                    </tr>
                    <tr>
                      <th>Date of Birth</th>
                      <td><?php echo $row["dob"] ?></td>
                    </tr>
                    <tr>
                      <th>Student Phone Number</th>
                      <td><?php echo $row["sphone_no"] ?></td>
                    </tr>
                    <tr>
                      <th>Branch</th>
                      <td><?php echo $row["bname"] ?></td>
                    </tr>
                    <tr>
                      <th>Community</th>
                      <td><?php echo $row["commty"] ?></td>
                    </tr>
                    <tr>
                      <th>Joining Academic Year</th>
                      <td><?php echo $row["join_aca_year"] ?></td>
                    </tr>
                    <tr>
                      <th>Admission Type</th>
                      <td><?php echo $row["admi_type"] ?></td>
                    </tr>
                    <tr>
                      <th>Mail ID</th>
                      <td><?php echo $row["mail_id"] ?></td>
                    </tr>
                    <tr>
                      <th>Days/Hostel Scholar</th>
                      <td><?php echo $row["days_scholar"] == 1 ? "Days Scholar" : "Hostel Scholar" ?></td>
                    </tr>
                    <?php if ($row["days_scholar"] == 1) { ?>
                      <tr>
                        <th>College Bus Traveller</th>
                        <td><?php echo $row["bus_travel"] == 1 ? "Yes" : "No" ?></td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <th>Address</th>
                      <td><?php echo $row["address"] ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- College Fee -->
            <div class="col-12 mt-3">
              <button class="btn btn-success addCollegeFee">Add College Fee</button>
              <div class="mt-4 table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Semester</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Scheme</th>
                      <th>Fees</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="college-fees">
                    <?php
                    $collegeFeeResult = mysqli_query($con, "SELECT * FROM `college_fee` WHERE `regno` = '" . $row['regno'] . "'");
                    while ($collegeFeeRow = mysqli_fetch_array($collegeFeeResult, MYSQLI_ASSOC)) { ?>
                      <tr>
                        <td><?php echo $collegeFeeRow["sem"]; ?></td>
                        <td><?php echo $collegeFeeRow["month"]; ?></td>
                        <td><?php echo $collegeFeeRow["year"]; ?></td>
                        <td><?php echo $collegeFeeRow["scheme"]; ?></td>
                        <td><?php echo $collegeFeeRow["fee"]; ?></td>
                        <td><button class="editCollegeFee btn btn-info" data-id="<?php echo $collegeFeeRow["id"]; ?>" data-regno="<?php echo $collegeFeeRow["regno"]; ?>" data-sname="<?php echo $collegeFeeRow["sname"]; ?>" data-bcode="<?php echo $collegeFeeRow["bcode"]; ?>" data-bname="<?php echo $collegeFeeRow["bname"]; ?>" data-sem="<?php echo $collegeFeeRow["sem"]; ?>" data-month="<?php echo $collegeFeeRow["month"]; ?>" data-year="<?php echo $collegeFeeRow["year"]; ?>" data-fee="<?php echo $collegeFeeRow["fee"]; ?>" data-scheme="<?php echo $collegeFeeRow["scheme"]; ?>" data-gender="<?php echo $collegeFeeRow["gender"]; ?>" data-commty="<?php echo $collegeFeeRow["commty"]; ?>">Edit</button> | <button class='deleteCollegeFee btn btn-danger' data-id='<?php echo $collegeFeeRow["id"]; ?>' data-regno='<?php echo $collegeFeeRow["regno"]; ?>'>Delete</button></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal fade" id="collegeFeeModal" tabindex="-1" aria-labelledby="collegeFeeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="collegeFeeModalLabel">Add/Edit College Fee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="alert" style="display:none" id="college-fee-alert" role="alert">
                    </div>
                    <form action="" method="post" id="college-fee-form">
                      <div class="mb-3">
                        <label for="collegeFeeSem" class="form-label">Semester</label>
                        <select name="sem" id="collegeFeeSem" class="form-control">
                          <option value="">Choose an Option</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="collegeFeeMonth" class="form-label">Month</label>
                        <input type="number" name="month" id="collegeFeeMonth" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="collegeFeeYear" class="form-label">Year</label>
                        <input type="number" name="year" id="collegeFeeYear" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="collegeFeeScheme" class="form-label">Scheme</label>
                        <select name="scheme" id="collegeFeeScheme" class="form-control">
                          <option value="">Choose an Option</option>
                          <option value="L">L</option>
                          <option value="M">M</option>
                          <option value="N">N</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="collegeFeeFee" class="form-label">Fee</label>
                        <input type="number" name="fee" id="collegeFeeFee" class="form-control" />
                      </div>
                      <input type="hidden" name="type" id="collegeFeeType" value="Add" />
                      <input type="hidden" name="sname" id="collegeFeeSName" value="<?php echo $row["sname"] ?>" />
                      <input type="hidden" name="regno" id="collegeFeeRegNo" value="<?php echo $row["regno"] ?>" />
                      <input type="hidden" name="bname" id="collegeFeeBName" value="<?php echo $row["bname"] ?>" />
                      <input type="hidden" name="bcode" id="collegeFeeBCode" value="<?php echo $row["bcode"] ?>" />
                      <input type="hidden" name="gender" id="collegeFeeGender" value="<?php echo $row["gender"] ?>" />
                      <input type="hidden" name="commty" id="collegeFeeCommty" value="<?php echo $row["commty"] ?>" />
                      <input type="hidden" name="id" id="collegeFeeId" />
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-college-fee" disabled="true">Save College Fee</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Exam Fee -->
            <div class="col-12 mt-3">
              <button class="btn btn-success addExamFee">Add Exam Fee</button>
              <div class="mt-4 table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Semester</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Scheme</th>
                      <th>Fees</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="exam-fees">
                    <?php
                    $examFeeResult = mysqli_query($con, "SELECT * FROM `exam_fee` WHERE `regno` = '" . $row['regno'] . "'");
                    while ($examFeeRow = mysqli_fetch_array($examFeeResult, MYSQLI_ASSOC)) { ?>
                      <tr>
                        <td><?php echo $examFeeRow["sem"]; ?></td>
                        <td><?php echo $examFeeRow["month"]; ?></td>
                        <td><?php echo $examFeeRow["year"]; ?></td>
                        <td><?php echo $examFeeRow["scheme"]; ?></td>
                        <td><?php echo $examFeeRow["fee"]; ?></td>
                        <td><button class="editExamFee btn btn-info" data-id="<?php echo $examFeeRow["id"]; ?>" data-regno="<?php echo $examFeeRow["regno"]; ?>" data-sname="<?php echo $examFeeRow["sname"]; ?>" data-bcode="<?php echo $examFeeRow["bcode"]; ?>" data-bname="<?php echo $examFeeRow["bname"]; ?>" data-sem="<?php echo $examFeeRow["sem"]; ?>" data-fee="<?php echo $examFeeRow["fee"]; ?>" data-scheme="<?php echo $examFeeRow["scheme"]; ?>" data-gender="<?php echo $examFeeRow["gender"]; ?>" data-commty="<?php echo $examFeeRow["commty"]; ?>" data-month="<?php echo $examFeeRow["month"]; ?>" data-year="<?php echo $examFeeRow["year"]; ?>">Edit</button> | <button class='deleteExamFee btn btn-danger' data-id='<?php echo $examFeeRow["id"]; ?>' data-regno='<?php echo $examFeeRow["regno"]; ?>'>Delete</button></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal fade" id="examFeeModal" tabindex="-1" aria-labelledby="examFeeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="examFeeModalLabel">Add/Edit College Fee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="alert" style="display:none" id="exam-fee-alert" role="alert">
                    </div>
                    <form action="" method="post" id="exam-fee-form">
                      <div class="mb-3">
                        <label for="examFeeSem" class="form-label">Semester</label>
                        <select name="sem" id="examFeeSem" class="form-control">
                          <option value="">Choose an Option</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="examFeeScheme" class="form-label">Scheme</label>
                        <select name="scheme" id="examFeeScheme" class="form-control">
                          <option value="">Choose an Option</option>
                          <option value="L">L</option>
                          <option value="M">M</option>
                          <option value="N">N</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="examFeeMonth" class="form-label">Month</label>
                        <input type="number" name="month" id="examFeeMonth" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="examFeeYear" class="form-label">Year</label>
                        <input type="number" name="year" id="examFeeYear" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="examFeeFee" class="form-label">Fee</label>
                        <input type="number" name="fee" id="examFeeFee" class="form-control" />
                      </div>
                      <input type="hidden" name="type" id="examFeeType" value="Add" />
                      <input type="hidden" name="sname" id="examFeeSName" value="<?php echo $row["sname"] ?>" />
                      <input type="hidden" name="regno" id="examFeeRegNo" value="<?php echo $row["regno"] ?>" />
                      <input type="hidden" name="bname" id="examFeeBName" value="<?php echo $row["bname"] ?>" />
                      <input type="hidden" name="bcode" id="examFeeBCode" value="<?php echo $row["bcode"] ?>" />
                      <input type="hidden" name="gender" id="examFeeGender" value="<?php echo $row["gender"] ?>" />
                      <input type="hidden" name="commty" id="examFeeCommty" value="<?php echo $row["commty"] ?>" />
                      <input type="hidden" name="id" id="examFeeId" />
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-exam-fee" disabled="true">Save Exam Fee</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bus Fee -->
            <div class="col-12 mt-3">
              <button type="button" class="btn btn-success addBusFee">Add Bus Fee</button>
              <div class="mt-4 table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Semester</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Bus Number</th>
                      <th>Stop Place</th>
                      <th>Fees</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="bus-fees">
                    <?php
                    $busFeeResult = mysqli_query($con, "SELECT * FROM `bus_fee` WHERE `regno` = '" . $row['regno'] . "'");
                    while ($busFeeRow = mysqli_fetch_array($busFeeResult, MYSQLI_ASSOC)) { ?>
                      <tr>
                        <td><?php echo $busFeeRow["sem"]; ?></td>
                        <td><?php echo $busFeeRow["month"]; ?></td>
                        <td><?php echo $busFeeRow["year"]; ?></td>
                        <td><?php echo $busFeeRow["bus_no"]; ?></td>
                        <td><?php echo $busFeeRow["stop_place"]; ?></td>
                        <td><?php echo $busFeeRow["fee"]; ?></td>
                        <td><button class="editBusFee btn btn-info" data-id="<?php echo $busFeeRow["id"]; ?>" data-regno="<?php echo $busFeeRow["regno"]; ?>" data-sname="<?php echo $busFeeRow["sname"]; ?>" data-bcode="<?php echo $busFeeRow["bcode"]; ?>" data-bname="<?php echo $busFeeRow["bname"]; ?>" data-sem="<?php echo $busFeeRow["sem"]; ?>" data-month="<?php echo $busFeeRow["month"]; ?>" data-year="<?php echo $busFeeRow["year"]; ?>" data-fee="<?php echo $busFeeRow["fee"]; ?>" data-gender="<?php echo $busFeeRow["gender"]; ?>" data-commty="<?php echo $busFeeRow["commty"]; ?>" data-stop="<?php echo $busFeeRow["stop_place"]; ?>" data-busno="<?php echo $busFeeRow["bus_no"]; ?>">Edit</button> | <button class='deleteBusFee btn btn-danger' data-id='<?php echo $busFeeRow["id"]; ?>' data-regno='<?php echo $busFeeRow["regno"]; ?>'>Delete</button></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal fade" id="busFeeModal" tabindex="-1" aria-labelledby="busFeeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="busFeeModalLabel">Add/Edit Bus Fee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="alert" style="display:none" id="bus-fee-alert" role="alert">
                    </div>
                    <form action="" method="post" id="bus-fee-form">
                      <div class="mb-3">
                        <label for="busFeeSem" class="form-label">Semester</label>
                        <select name="sem" id="busFeeSem" class="form-control">
                          <option value="">Choose an Option</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="busFeeMonth" class="form-label">Month</label>
                        <input type="number" name="month" id="busFeeMonth" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="busFeeYear" class="form-label">Year</label>
                        <input type="number" name="year" id="busFeeYear" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="busFeeBusNumber" class="form-label">Bus Number</label>
                        <input type="text" name="bus_no" id="busFeeBusNo" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="busFeeStopPlace" class="form-label">Stop Place</label>
                        <input type="text" name="stop_place" id="busFeeStop" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="busFeeFee" class="form-label">Fee</label>
                        <input type="number" name="fee" id="busFeeFee" class="form-control" />
                      </div>
                      <input type="hidden" name="type" id="busFeeType" value="Add" />
                      <input type="hidden" name="sname" id="busFeeSName" value="<?php echo $row["sname"] ?>" />
                      <input type="hidden" name="regno" id="busFeeRegNo" value="<?php echo $row["regno"] ?>" />
                      <input type="hidden" name="bname" id="busFeeBName" value="<?php echo $row["bname"] ?>" />
                      <input type="hidden" name="bcode" id="busFeeBCode" value="<?php echo $row["bcode"] ?>" />
                      <input type="hidden" name="gender" id="busFeeGender" value="<?php echo $row["gender"] ?>" />
                      <input type="hidden" name="commty" id="busFeeCommty" value="<?php echo $row["commty"] ?>" />
                      <input type="hidden" name="id" id="busFeeId" />
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-bus-fee" disabled="true">Save Bus Fee</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Hostel Fee -->
            <div class="col-12 mt-3">
              <button type="button" class="btn btn-success addHostelFee">Add Hostel Fee</button>
              <div class="mt-4 table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Semester</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Room Number</th>
                      <th>Staff Name</th>
                      <th>Fees</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="hostel-fees">
                    <?php
                    $hostelFeeResult = mysqli_query($con, "SELECT * FROM `hostel_fee` WHERE `regno` = '" . $row['regno'] . "'");
                    while ($hostelFeeRow = mysqli_fetch_array($hostelFeeResult, MYSQLI_ASSOC)) { ?>
                      <tr>
                        <td><?php echo $hostelFeeRow["sem"]; ?></td>
                        <td><?php echo $hostelFeeRow["month"]; ?></td>
                        <td><?php echo $hostelFeeRow["year"]; ?></td>
                        <td><?php echo $hostelFeeRow["room_no"]; ?></td>
                        <td><?php echo $hostelFeeRow["staff_name"]; ?></td>
                        <td><?php echo $hostelFeeRow["fee"]; ?></td>
                        <td><button class="editHostelFee btn btn-info" data-id="<?php echo $hostelFeeRow["id"]; ?>" data-regno="<?php echo $hostelFeeRow["regno"]; ?>" data-sname="<?php echo $hostelFeeRow["sname"]; ?>" data-bcode="<?php echo $hostelFeeRow["bcode"]; ?>" data-bname="<?php echo $hostelFeeRow["bname"]; ?>" data-sem="<?php echo $hostelFeeRow["sem"]; ?>" data-month="<?php echo $hostelFeeRow["month"]; ?>" data-year="<?php echo $hostelFeeRow["year"]; ?>" data-fee="<?php echo $hostelFeeRow["fee"]; ?>" data-gender="<?php echo $hostelFeeRow["gender"]; ?>" data-commty="<?php echo $hostelFeeRow["commty"]; ?>" data-roomno="<?php echo $hostelFeeRow["room_no"]; ?>" data-staff="<?php echo $hostelFeeRow["staff_name"]; ?>" data-address="<?php echo $hostelFeeRow["adress"]; ?>" data-phone="<?php echo $hostelFeeRow["sphone_no"]; ?>" data-mailid="<?php echo $hostelFeeRow["mail_id"]; ?>" data-dob="<?php echo $hostelFeeRow["dob"]; ?>">Edit</button> | <button class='deleteHostelFee btn btn-danger' data-id='<?php echo $hostelFeeRow["id"]; ?>' data-regno='<?php echo $hostelFeeRow["regno"]; ?>'>Delete</button></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal fade" id="hostelFeeModal" tabindex="-1" aria-labelledby="hostelFeeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hostelFeeModalLabel">Add/Edit Hostel Fee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="alert" style="display:none" id="hostel-fee-alert" role="alert">
                    </div>
                    <form action="" method="post" id="hostel-fee-form">
                      <div class="mb-3">
                        <label for="hostelFeeSem" class="form-label">Semester</label>
                        <select name="sem" id="hostelFeeSem" class="form-control">
                          <option value="">Choose an Option</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="hostelFeeMonth" class="form-label">Month</label>
                        <input type="number" name="month" id="hostelFeeMonth" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="hostelFeeYear" class="form-label">Year</label>
                        <input type="number" name="year" id="hostelFeeYear" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="hostelFeeRoomNumber" class="form-label">Room Number</label>
                        <input type="text" name="room_no" id="hostelFeeRoomNo" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="hostelFeeStaffName" class="form-label">Staff Name</label>
                        <input type="text" name="staff_name" id="hostelFeeStaffName" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label for="hostelFeeFee" class="form-label">Fee</label>
                        <input type="number" name="fee" id="hostelFeeFee" class="form-control" />
                      </div>
                      <input type="hidden" name="type" id="hostelFeeType" value="Add" />
                      <input type="hidden" name="sname" id="hostelFeeSName" value="<?php echo $row["sname"] ?>" />
                      <input type="hidden" name="regno" id="hostelFeeRegNo" value="<?php echo $row["regno"] ?>" />
                      <input type="hidden" name="bname" id="hostelFeeBName" value="<?php echo $row["bname"] ?>" />
                      <input type="hidden" name="bcode" id="hostelFeeBCode" value="<?php echo $row["bcode"] ?>" />
                      <input type="hidden" name="gender" id="hostelFeeGender" value="<?php echo $row["gender"] ?>" />
                      <input type="hidden" name="commty" id="hostelFeeCommty" value="<?php echo $row["commty"] ?>" />
                      <input type="hidden" name="sphone_no" id="hostelFeePhone" value="<?php echo $row["sphone_no"] ?>" />
                      <input type="hidden" name="mail_id" id="hostelFeeMailId" value="<?php echo $row["mail_id"] ?>" />
                      <input type="hidden" name="address" id="hostelFeeAddress" value="<?php echo $row["address"] ?>" />
                      <input type="hidden" name="dob" id="hostelFeeDOB" value="<?php echo $row["dob"] ?>" />
                      <input type="hidden" name="id" id="hostelFeeId" />
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-hostel-fee" disabled="true">Save Hostel Fee</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="custom.js"></script>
</body>

</html>