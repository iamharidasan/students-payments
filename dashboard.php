<?php
session_start();
require("config.php");
$errorMessage = "";
if (!isset($_SESSION["stu_user_name"])) {
  header("Location: index.php");
}
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$result = mysqli_query($con, "SELECT * FROM `student_details` WHERE `regno` = '" . $_SESSION["stu_user_name"] . "'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student's Dashboard</title>
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
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <?php include("header.php"); ?>
      </div>
      <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
        <div class="col-12">
          <h1 class="mt-4 mb-2">Welcome <?php echo $row['sname'] ?></h1>
        </div>
        <div class="col-12">
          <?php
          $collegeFeeResult = mysqli_query($con, "SELECT * FROM `college_fee` WHERE `regno` = '" . $row["regno"] . "' ORDER BY `sem` ASC");
          $busFeeResult = mysqli_query($con, "SELECT * FROM `bus_fee` WHERE `regno` = '" . $row["regno"] . "' ORDER BY `sem` ASC");
          $hostelFeeResult = mysqli_query($con, "SELECT * FROM `hostel_fee` WHERE `regno` = '" . $row["regno"] . "' ORDER BY `sem` ASC");
          $examFeeResult = mysqli_query($con, "SELECT * FROM `exam_fee` WHERE `regno` = '" . $row["regno"] . "' ORDER BY `sem` ASC");
          ?>
          <div class="table-responsive mt-3">
            <h3>College Fees</h3>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
                    Semester
                  </th>
                  <th>
                    Fee
                  </th>
                  <th>
                    Fee Paid
                  </th>
                  <th>
                    Fee Balance
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php while ($feeRow = mysqli_fetch_array($collegeFeeResult, MYSQLI_ASSOC)) { ?>
                  <tr>
                    <td>
                      <?php echo $feeRow["sem"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee_paid"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee_bal"]; ?>
                    </td>
                    <td>
                      <?php if ($feeRow["fee_bal"] != 0) { ?>
                        <form action="payments.php" method="post">
                          <input type="hidden" name="payment_amt" value="<?php echo $feeRow["fee_bal"]; ?>" />
                          <input type="hidden" name="payment_for" value="CF_<?php echo $feeRow["regno"] . '_' . $feeRow["bcode"] . '_' . $feeRow["sem"] ?>" />
                          <input type="hidden" name="payment_sem" value="<?php echo $feeRow["sem"] ?>" />
                          <input type="hidden" name="payment_table" value="college" />
                          <button type="submit" class="btn btn-success">Pay Now</button>
                        </form>
                      <?php } else { ?>
                        <a href="success.php?session_id=<?php echo $feeRow['transaction_id'] ?>">Print Receipt</a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="table-responsive mt-3">
            <h3>Bus Fees</h3>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
                    Semester
                  </th>
                  <th>
                    Fee
                  </th>
                  <th>
                    Fee Paid
                  </th>
                  <th>
                    Fee Balance
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php while ($feeRow = mysqli_fetch_array($busFeeResult, MYSQLI_ASSOC)) { ?>
                  <tr>
                    <td>
                      <?php echo $feeRow["sem"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee_paid"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee_bal"]; ?>
                    </td>
                    <td>
                      <?php if ($feeRow["fee_bal"] != 0) { ?>
                        <form action="payments.php" method="post">
                          <input type="hidden" name="payment_amt" value="<?php echo $feeRow["fee_bal"]; ?>" />
                          <input type="hidden" name="payment_for" value="BF_<?php echo $feeRow["regno"] . '_' . $feeRow["bcode"] . '_' . $feeRow["sem"] ?>" />
                          <input type="hidden" name="payment_sem" value="<?php echo $feeRow["sem"] ?>" />
                          <input type="hidden" name="payment_table" value="bus" />
                          <button type="submit" class="btn btn-success">Pay Now</button>
                        </form>
                      <?php } else { ?>
                        <a href="success.php?session_id=<?php echo $feeRow['transaction_id'] ?>">Print Receipt</a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="table-responsive mt-3">
            <h3>Hostel Fees</h3>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
                    Semester
                  </th>
                  <th>
                    Fee
                  </th>
                  <th>
                    Fee Paid
                  </th>
                  <th>
                    Fee Balance
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php while ($feeRow = mysqli_fetch_array($hostelFeeResult, MYSQLI_ASSOC)) { ?>
                  <tr>
                    <td>
                      <?php echo $feeRow["sem"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee_paid"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee_bal"]; ?>
                    </td>
                    <td>
                      <?php if ($feeRow["fee_bal"] != 0) { ?>
                        <form action="payments.php" method="post">
                          <input type="hidden" name="payment_amt" value="<?php echo $feeRow["fee_bal"]; ?>" />
                          <input type="hidden" name="payment_for" value="HF_<?php echo $feeRow["regno"] . '_' . $feeRow["bcode"] . '_' . $feeRow["sem"] ?>" />
                          <input type="hidden" name="payment_sem" value="<?php echo $feeRow["sem"] ?>" />
                          <input type="hidden" name="payment_table" value="hostel" />
                          <button type="submit" class="btn btn-success">Pay Now</button>
                        </form>
                      <?php } else { ?>
                        <a href="success.php?session_id=<?php echo $feeRow['transaction_id'] ?>">Print Receipt</a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="table-responsive mt-3">
            <h3>Exam Fees</h3>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
                    Semester
                  </th>
                  <th>
                    Fee
                  </th>
                  <th>
                    Fee Paid
                  </th>
                  <th>
                    Fee Balance
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php while ($feeRow = mysqli_fetch_array($examFeeResult, MYSQLI_ASSOC)) { ?>
                  <tr>
                    <td>
                      <?php echo $feeRow["sem"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee_paid"]; ?>
                    </td>
                    <td>
                      <?php echo $feeRow["fee_bal"]; ?>
                    </td>
                    <td>
                      <?php if ($feeRow["fee_bal"] != 0) { ?>
                        <form action="payments.php" method="post">
                          <input type="hidden" name="payment_amt" value="<?php echo $feeRow["fee_bal"]; ?>" />
                          <input type="hidden" name="payment_for" value="EF_<?php echo $feeRow["regno"] . '_' . $feeRow["bcode"] . '_' . $feeRow["sem"] ?>" />
                          <input type="hidden" name="payment_sem" value="<?php echo $feeRow["sem"] ?>" />
                          <input type="hidden" name="payment_table" value="exam" />
                          <button type="submit" class="btn btn-success">Pay Now</button>
                        </form>
                      <?php } else { ?>
                        <a href="success.php?session_id=<?php echo $feeRow['transaction_id'] ?>">Print Receipt</a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</body>

</html>