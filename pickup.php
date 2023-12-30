<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
   // $total_price = $_GET['total_price']; // Retrieve total price from URL
    $receivedEmail = $_GET["email"];
    $location = $_GET["pickup_location"];
    ?>
<title>Rented Successfully</title>
<link rel="stylesheet" href="frontend/pickup.css">
</head>
<body>
<div class = "form-holder">
<h1>You may pickup your car from the location: <?php echo $location; ?></h1>
<p>Your payment will be processed when you return the car depending on the number of rented days.</p>


<p>What would you like to do next?</p>
<ul>
<li><a href="customercars.php?email=<?php echo $receivedEmail; ?>">View Your Reservations</a></li>
<li><a href="rentcar.php?email=<?php echo $receivedEmail; ?>">Return to Home Page</a></li>
</ul>
</div>
</body>
</html>