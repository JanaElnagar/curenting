<?php
// Retrieve data from POST request
$card_number = $_POST['card_number'];
$expiration_date = $_POST['expiration_date'];
$cvv = $_POST['cvv'];
$total_price = $_POST['total_price'];
$receivedEmail = $_POST['email'];
$reservation_id = $_POST['reservation_id'];

//echo $expiration_date . "<br>";
$month_and_year = explode("/", $expiration_date);
if(strlen($month_and_year[0]) < 2){
    //echo $expiration_date . "<br>";
if(strlen($month_and_year[1]) < 2)
    $month_and_year[1] = "0" . $month_and_year[1];
    //echo $expiration_date . "<br>";
}

// **Basic validation**
if (empty($card_number) || empty($expiration_date) || empty($cvv)) {
    // Redirect to payment.php with an error message
    header("Location: payment.php?error=missing_fields&email=$receivedEmail");
    exit();
}

// **Card number validation using regular expression**
if (!preg_match("/^\d{16}$/", $card_number)) {
    // Redirect to payment.php with an error message
    header("Location: payment.php?error=invalid_card_number&email=$receivedEmail&reservation_id=$reservation_id");
    exit();
}

// **Expiration date validation**
//$expiration_month = substr($expiration_date, 0, 2);
//$expiration_year = "20" . substr($expiration_date, 3, 2); // Assuming two-digit year
$ghbjnm;
$expiration_month = $month_and_year[0];
$expiration_year = $month_and_year[1];
if (!checkdate($expiration_month, 1, $expiration_year)) {
    // Redirect to payment.php with an error message
    header("Location: payment.php?error=invalid_expiration_date&email=$receivedEmail&reservation_id=$reservation_id");
    exit();
}

// **CVV validation (basic check for length)**
if (strlen($cvv) != 3) {
    // Redirect to payment.php with an error message
    header("Location: payment.php?error=invalid_cvv&email=$receivedEmail&reservation_id=$reservation_id");
    exit();
}

// Payment successful
try {
    
    // Connect to database (replace with your credentials)
    $conn = new mysqli('localhost', 'root', '', 'curenting');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
        }
        else{

            // Update payment_status in reservation table
            $updateQuery = "UPDATE reservation 
            SET payment_status = 'payed',
                payment_date = '". date('Y-m-d') ."'  
            WHERE reservation_id = $reservation_id"; 
            $conn->query($updateQuery);

            // Close database connection
            $conn->close();

            // Redirect to success page or display success message
            header("Location: payment_success.php?email=$receivedEmail");
            exit();
        } 
}catch (Exception $e) {
    // Handle database errors gracefully
    echo "Error updating payment status: " . $e->getMessage();
}

