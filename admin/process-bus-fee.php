<?php
require_once("../config.php");
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
//Add Bus Fees
if (isset($_POST['type']) && $_POST['type'] == "Add") {
  try {
    mysqli_query($con, "INSERT INTO `bus_fee`(`regno`, `sname`, `gender`, `commty`, `bcode`, `bname`, `sem`, `month`, `year`, `bus_no`, `stop_place`, `fee`, `fee_bal`) VALUES ('" . $_POST["regno"] . "','" . $_POST['sname'] . "','" . $_POST['gender'] . "','" . $_POST['commty'] . "','" . $_POST['bcode'] . "','" . $_POST['bname'] . "','" . $_POST['sem'] . "','" . $_POST['month'] . "','" . $_POST['year'] . "','" . $_POST['bus_no'] . "','" . $_POST['stop_place'] . "','" . $_POST['fee'] . "','" . $_POST['fee'] . "')");
    $result = mysqli_query($con, "SELECT * FROM `bus_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "Bus Fee Added", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
} else if (isset($_POST['type']) && $_POST['type'] == "Update") {
  try {
    mysqli_query($con, "UPDATE `bus_fee` SET `sem` = '" . $_POST['sem'] . "', `month` = '" . $_POST['month'] . "', `year` = '" . $_POST['year'] . "', `fee` = '" . $_POST['fee'] . "', `bus_no` = '" . $_POST['bus_no'] . "', `stop_place` = '" . $_POST['stop_place'] . "', `fee_bal` =  '" . $_POST['fee'] . "' WHERE `id` = '" . $_POST['id'] . "'");
    $result = mysqli_query($con, "SELECT * FROM `bus_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "Bus Fee Updated", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
} else if (isset($_POST['delete'])) {
  try {
    mysqli_query($con, "DELETE FROM `bus_fee` WHERE `id` = '" . $_POST['delete'] . "'");
    $result = mysqli_query($con, "SELECT * FROM `bus_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "Bus Fee Deleted", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
}
