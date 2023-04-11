<?php
require_once("../config.php");
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
//Add College Fees
if (isset($_POST['type']) && $_POST['type'] == "Add") {
  try {
    mysqli_query($con, "INSERT INTO `college_fee`(`regno`, `sname`, `bcode`, `bname`, `sem`, `month`, `year`, `fee`, `scheme`, `gender`, `commty`, `fee_bal`) VALUES ('" . $_POST["regno"] . "','" . $_POST['sname'] . "','" . $_POST['bcode'] . "','" . $_POST['bname'] . "','" . $_POST['sem'] . "','" . $_POST['month'] . "','" . $_POST['year'] . "','" . $_POST['fee'] . "','" . $_POST['scheme'] . "','" . $_POST['gender'] . "','" . $_POST['commty'] . "', '" . $_POST['fee'] . "')");
    $result = mysqli_query($con, "SELECT * FROM `college_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "College Fee Added", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
} else if (isset($_POST['type']) && $_POST['type'] == "Update") {
  try {
    mysqli_query($con, "UPDATE `college_fee` SET  `sem` = '" . $_POST['sem'] . "', `month` = '" . $_POST['month'] . "', `year` = '" . $_POST['year'] . "', `fee` = '" . $_POST['fee'] . "', `scheme` = '" . $_POST['scheme'] . "', `fee_bal` = '" . $_POST["fee"] . "'  WHERE `id` = '" . $_POST['id'] . "'");
    $result = mysqli_query($con, "SELECT * FROM `college_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "College Fee Updated", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
} else if (isset($_POST['delete'])) {
  try {
    mysqli_query($con, "DELETE FROM `college_fee` WHERE `id` = '" . $_POST['delete'] . "'");
    $result = mysqli_query($con, "SELECT * FROM `college_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "College Fee Deleted", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
}
