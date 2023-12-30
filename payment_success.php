<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
   // $total_price = $_GET['total_price']; // Retrieve total price from URL
    $receivedEmail = $_GET["email"];
    ?>
<title>Payment Successful</title>
<link rel="stylesheet" href="frontend/payment_success.css">
</head>
<div class="form-holder" >
<body>
<h1>Payment Successful!</h1>
<p>Thank you for your payment.</p>


<p>What would you like to do next?</p>
<ul>
<li><a href="customercars.php?email=<?php echo $receivedEmail; ?>">View Your Reservations</a></li>
<li><a href="rentcar.php?email=<?php echo $receivedEmail; ?>">Return to Home Page</a></li>
</ul>
</div>
</body>
</html>
