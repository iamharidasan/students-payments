<?php
require_once("../config.php");
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
//Add Exam Fees
if (isset($_POST['type']) && $_POST['type'] == "Add") {
  try {
    mysqli_query($con, "INSERT INTO `exam_fee`(`regno`, `sname`, `gender`, `commty`, `bcode`, `bname`, `sem`, `month`, `year`, `fee`, `scheme`, `fee_bal`) VALUES ('" . $_POST["regno"] . "','" . $_POST['sname'] . "','" . $_POST['gender'] . "','" . $_POST['commty'] . "','" . $_POST['bcode'] . "','" . $_POST['bname'] . "','" . $_POST['sem'] . "','" . $_POST['month'] . "','" . $_POST['year'] . "','" . $_POST['fee'] . "','" . $_POST['scheme'] . "','" . $_POST['fee'] . "')");
    $result = mysqli_query($con, "SELECT * FROM `exam_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "Exam Fee Added", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
} else if (isset($_POST['type']) && $_POST['type'] == "Update") {
  try {
    mysqli_query($con, "UPDATE `exam_fee` SET  `sem` = '" . $_POST['sem'] . "', `fee` = '" . $_POST['fee'] . "', `month` = '" . $_POST['month'] . "', `year` = '" . $_POST['year'] . "', `scheme` = '" . $_POST['scheme'] . "',  `fee_bal` = '" . $_POST['fee'] . "' WHERE `id` = '" . $_POST['id'] . "'");
    $result = mysqli_query($con, "SELECT * FROM `exam_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "Exam Fee Updated", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
} else if (isset($_POST['delete'])) {
  try {
    mysqli_query($con, "DELETE FROM `exam_fee` WHERE `id` = '" . $_POST['delete'] . "'");
    $result = mysqli_query($con, "SELECT * FROM `exam_fee` WHERE `regno` = '" . $_POST['regno'] . "'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    echo json_encode(array("message" => "Exam Fee Deleted", "type" => "success", "rows" => $rows));
  } catch (mysqli_sql_exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "type" => "error"));
  }
}
