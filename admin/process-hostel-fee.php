<?php
require_once("../config.php");
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
//Add Bus Fees
if (isset($_POST['type']) && $_POST['type'] == "Add") {
  try {
    mysqli_query($con, "INSERT INTO `hostel_fee`(`regno`, `sname`, `gender`, `dob`, `commty`, `bcode`, `bname`, `sem`, `month`, `year`, `room_no`, `staff_name`, `sphone_no`, `mail_id`, `adress`, `fee`, `fee_bal`) VALUES ('" . $_POST["regno"] . "','" . $_POST['sname'] . "','" . $_POST['gender'] . "','" . $_POST['dob'] . "','" . $_POST['commty'] . "','" . $_POST['bcode'] . "','" . $_POST['bname'] . "','" . $_POST['sem'] . "','" . $_POST['month'] . "','" . $_POST['year'] . "','" . $_POST['room_no'] . "','" . $_POST['staff_name'] . "','" . $_POST['sphone_no'] . "','" . $_POST['mail_id'] . "','" . $_POST['address'] . "','" . $_POST['fee'] . "','" . $_POST['fee'] . "')");
    $result = mysqli_query($con, "SELECT * FROM `hostel_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "Hostel Fee Added", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
} else if (isset($_POST['type']) && $_POST['type'] == "Update") {
  try {
    mysqli_query($con, "UPDATE `hostel_fee` SET `sem` = '" . $_POST['sem'] . "', `month` = '" . $_POST['month'] . "', `year` = '" . $_POST['year'] . "', `fee` = '" . $_POST['fee'] . "', `staff_name` = '" . $_POST['staff_name'] . "', `room_no` = '" . $_POST['room_no'] . "', `fee_bal` =  '" . $_POST['fee'] . "' WHERE `id` = '" . $_POST['id'] . "'");
    $result = mysqli_query($con, "SELECT * FROM `hostel_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "Hostel Fee Updated", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
} else if (isset($_POST['delete'])) {
  try {
    mysqli_query($con, "DELETE FROM `hostel_fee` WHERE `id` = '" . $_POST['delete'] . "'");
    $result = mysqli_query($con, "SELECT * FROM `hostel_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "Hostel Fee Deleted", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
}
