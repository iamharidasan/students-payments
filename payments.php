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
  <title>Payments</title>
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
      <div class="col-12 mt-5">
        <?php if (isset($_POST["payment_amt"])) { ?>
          <form action="process-payment.php" method="POST">
            <div class="mb-3">
              <label class="form-label">Payment Type</label><br />
              <input type="radio" name="payment_type" class="form-check-input" value="Full Payment" id="fullPayment" checked />
              <label class="form-check-label" for="fullPayment">
                Full Payment
              </label>
              <input type="radio" name="payment_type" class="form-check-input" value="Partial Payment" id="partialPayment" />
              <label class="form-check-label" for="partialPayment">
                Partial Payment
              </label>
            </div>
            <div class="mb-3">
              <label for="paymentAmt">Payment Amount</label>
              <input type="number" name="paymentAmt" id="paymentAmt" value="<?php echo $_POST['payment_amt']; ?>" readonly="true" max="<?php echo $_POST['payment_amt']; ?>" />
              <div class="form-text">
                Maximum Amount: <?php echo $_POST['payment_amt']; ?>
              </div>
            </div>
            <input type="hidden" name="paymentFor" value="<?php echo $_POST['payment_for']; ?>" />
            <input type="hidden" name="paymentSem" value="<?php echo $_POST['payment_sem']; ?>" />
            <input type="hidden" name="paymentTable" value="<?php echo $_POST['payment_table']; ?>" />
            <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
              <input type="hidden" name="paymentMail" value="<?php echo $row["mail_id"]; ?>" />
              <input type="hidden" name="paymentRegNo" value="<?php echo $row["regno"]; ?>" />
              <input type="hidden" name="paymentName" value="<?php echo $row["sname"]; ?>" />
            <?php } ?>
            <button type="submit" id="checkout-button" class="btn btn-primary">Checkout</button>
          </form>
        <?php } else { ?>
          <h1>Invalid Data</h1>
          <h3><a href="dashboard.php">Go Home</a></h3>
        <?php } ?>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    jQuery(document).ready(function($) {
      $("input[name=payment_type]").on("change", function() {
        if ($(this).val() === "Full Payment") {
          $("#paymentAmt").val("<?php echo $_POST['payment_amt']; ?>").prop("readonly", true);
        } else if ($(this).val() === "Partial Payment") {
          $("#paymentAmt").prop("readonly", false)
        }
      })
    })
  </script>
</body>

</html>