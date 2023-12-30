<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="frontend/payment.css">
</head>
<body>
    <div class = "form-holder">
    <?php
   // $total_price = $_GET['total_price']; // Retrieve total price from URL
    if(isset($_POST["email"])){
        $receivedEmail = $_POST["email"];
    }
    else if(isset($_GET["email"])){
        $receivedEmail = $_GET["email"];
    }
    if(isset($_POST["reservation_id"])){
        $reservation_id = $_POST["reservation_id"];
    }
    else if(isset($_GET["reservation_id"])){
        $reservation_id = $_GET["reservation_id"];
    }

    $conn = new mysqli('localhost','root','','curenting');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }
    else{
        $sql = "SELECT `reservation_status`,`payment_status`,`total_price` FROM reservation WHERE reservation.reservation_id = $reservation_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $rst= $row['reservation_status'];
            $pst= $row['payment_status'];
            if ($rst=='returned'){
                if ($pst=='pending'){
                    $total_price = $row['total_price'];
                }
                else{
                    //echo "Already payed.".mysqli_error($conn);
                    header("location:customercars.php?warning=Already payed&email=$receivedEmail");
                }
            }
            else{
                //echo "car not returned yet".mysqli_error($conn); 
                header("location:customercars.php?warning=Must return car first.&email=$receivedEmail");
            }
            
        }
        else{
           // echo "Reservation ID does not exist.".mysqli_error($conn);
            header("location:customercars.php?warning=Reservation ID does not exist&email=$receivedEmail");
        }
    }
    $conn->close();

    if (isset($total_price)) {
        echo "<h2>Total Price = $total_price</h2>";
        // Add payment processing functionality here (e.g., using a payment gateway)
        ?>
        
        <form action="process_payment.php" method="post">
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
            <input type="hidden" id="email" name="email" value="<?php echo $receivedEmail; ?>">
            <input type="hidden" id="reservation_id" name="reservation_id" value="<?php echo $reservation_id; ?>">
            </div><br></br>
            <div class = "form-holder2">
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" class = "input" required><br></br>

            <label for="expiration_date">Expiration Date (MM/YY):</label>
            <input type="text" id="expiration_date" name="expiration_date" class = "input" required><br></br>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" class = "input" required><br></br>

            <button type="submit" class="button" style="width: 105%;cursor: pointer;">Pay Now</button>
    </div>
        </form>
        <?php
    } else {
        echo "Error: Total price not available.";
    }

    if (isset($_GET['warning'])) {
        $warning =$_GET['warning'] ;
        echo "<p class=\"warning\">{$warning}</p>"; // Display using appropriate styling
    }
    echo "</div>";
    echo "<br></br>";

    ?>


</body>
</html>
