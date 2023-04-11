<?php
session_start();
require("config.php");
require 'stripe/stripe-php/init.php';
require 'stripe/secrets.php';
$errorMessage = "";
if (!isset($_SESSION["stu_user_name"])) {
  header("Location: index.php");
}
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$stripe = new \Stripe\StripeClient($stripeSecretKey);
try {
  $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
  $getQuery = "SELECT * FROM `" . $session->metadata->table . "_fee` WHERE `regno` = '" . $session->metadata->regno . "' AND `sem` = '" . $session->metadata->sem . "'";
  $getResults = mysqli_query($con, $getQuery);
  while ($row = mysqli_fetch_array($getResults, MYSQLI_ASSOC)) {
    $paid_amount = substr($session->amount_total, 0, -2);
    $remaining = $row['fee'] - $paid_amount;
    $query = "UPDATE `" . $session->metadata->table . "_fee` SET `transaction_id` = '" . $_REQUEST["session_id"] . "', `paid_date` = '" . $session->created . "', `fee_bal` = '" . $remaining . "', `fee_paid` = '" . $paid_amount . "' WHERE `regno` = '" . $session->metadata->regno . "' AND `sem` = '" . $session->metadata->sem . "'";
    mysqli_query($con, $query);
  }
} catch (Error $e) {
  http_response_code(500);
  $errorMessage = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Successful Payment</title>
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
      <!-- <div class="col-12">
        <?php //include("header.php"); 
        ?>
      </div> -->
      <div class="col-12">
        <?php if ($errorMessage != "") { ?>
          <h1 class="mt-4 mb-2"><?php echo $errorMessage; ?></h1>
        <?php } else { ?>
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
          <h1 class="mt-4 mb-2">Thank you for the payment</h1>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <tr>
                <th>
                  Register Number
                </th>
                <td>
                  <?php echo $session->metadata->regno; ?>
                </td>
              </tr>
              <tr>
                <th>
                  Semester
                </th>
                <td>
                  <?php echo $session->metadata->sem; ?>
                </td>
              </tr>
              <tr>
                <th>
                  Transaction Time
                </th>
                <td>
                  <?php $date = date_create(date("d-m-Y H:i:sP", substr($session->created, 0, 10)), timezone_open('Asia/Kolkata'));
                  echo date_format($date, 'd-m-Y');;
                  ?>
                </td>
              </tr>
              <tr>
                <th>
                  Transaction ID
                </th>
                <td>
                  <?php echo $_REQUEST["session_id"]; ?>
                </td>
              </tr>
              <tr>
                <th>
                  Amount Paid
                </th>
                <td>
                  <?php echo $paid_amount; ?>
                </td>
              </tr>
            </table>
          </div>
          <a href="dashboard.php" class="btn btn-info">Go Home</a>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

</html>