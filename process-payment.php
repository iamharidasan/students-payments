<?php
require_once 'stripe/stripe-php/init.php';
require_once 'stripe/secrets.php';
if (isset($_POST['paymentAmt'])) {
  header('Content-Type: application/json');

  $YOUR_DOMAIN = 'http://localhost/students-payments';


  $stripe = new \Stripe\StripeClient(
    $stripeSecretKey
  );

  $checkout_session = $stripe->checkout->sessions->create([
    'success_url' => $YOUR_DOMAIN . '/success.php?session_id={CHECKOUT_SESSION_ID}',
    'customer_email' => $_POST["paymentMail"],
    'metadata' => [
      "name" => $_POST["paymentName"],
      "table" => $_POST["paymentTable"],
      "sem" => $_POST["paymentSem"],
      "regno" => $_POST["paymentRegNo"],
    ],
    'line_items' => [
      [
        'price_data' => [
          "currency" => "INR",
          "unit_amount" => $_POST["paymentAmt"] . "00",
          "product_data" => [
            "name" => $_POST["paymentFor"],
          ]
        ],
        'quantity' => 1,
      ],
    ],
    'mode' => 'payment',
  ]);
  header("HTTP/1.1 303 See Other");
  header("Location: " . $checkout_session->url);
}
