<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="frontend/customerCars.css">
</head>
<body>
<div class="form-holder">
<h1 class = "rent_header" style=" text-align: center"> Rented Cars </h1>
<?php
        if(isset($_POST["email"])){
            $receivedEmail = $_POST["email"];
        }
        else if(isset($_GET["email"])){
            $receivedEmail = $_GET["email"];
        }
        
        $conn = new mysqli('localhost','root','','curenting');
        if($conn->connect_error){
            die('Connection Failed : '.$conn->connect_error);
        }
        else{
            // Display all cars rented by the user currently logged in
            $sql = "SELECT `reservation_id`,`car_id`,`plate_id`, `model`, `price_per_day`, `reservation_date`,`office_location`, `return_date`, `reservation_status`,`total_price`,`payment_status`
            FROM office NATURAL JOIN (`car` NATURAL JOIN (reservation NATURAL JOIN customer))
            WHERE customer.email = '$receivedEmail';";
            $result = $conn->query($sql);
            echo "<table>";
            echo "<table cellspacing='20'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Reservation id</th>";
            echo "<th>Car id</th>";
            echo "<th>Plate id</th>";
            echo "<th>Model</th>";
            echo "<th>Rent price (per day)</th>";
            echo "<th>Date of Reservation</th>";
            echo "<th>Pickup Location</th>";
            echo "<th>Date of Return</th>";
            echo "<th>Rent Status</th>";
            echo "<th>Total Price</th>";
            echo "<th>Payment Status</th>";
            // ... more headers as needed
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $row['reservation_id'] . "</td>";
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['plate_id'] . "</td>";
                    echo "<td>" . $row['model']. "</td>"; 
                    echo "<td>" . $row['price_per_day'] . "</td>";
                    echo "<td>" . $row['reservation_date']. "</td>";
                    echo "<td>" . $row['office_location'] . "</td>";
                    echo "<td>" . $row['return_date']. "</td>";
                    echo "<td>" . $row['reservation_status']. "</td>";
                    echo "<td>" . $row['total_price']. "</td>";
                    echo "<td>" . $row['payment_status']. "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";               
            }
            echo "</div>";
            echo "<br></br>";
        }
        $conn->close();
    ?>
    <!--Option to return one of the rented cars -->
    <div class="form-holder2">
    <h2 class = "rent_header" style=" text-align: center"> Return Car </h2>
    <form action="return.php" method="post">
    <label for="reservationID">Enter reservation ID: </label>
        <input type="text",id="r" name="reservationID" placeholder="ID"  class="input" required>

        <label for="return_date">Return date: </label>
        <input type="date",id="rd" name="return_date" class="input" required>

        <input type="hidden" name="email" value="<?php echo $receivedEmail; ?>">
        <br></br>
        <input type="submit" value="Return car" class="button" style="width: 10%;cursor: pointer;">
    </form>
    </div>
    <br><br>
    <div class="form-holder2">
    <h2 class = "rent_header" style=" text-align: center"> Pay Pending Payment </h2>
    <form action="payment.php" method="post">
    <label for="reservationID">Enter reservation ID: </label>
        <input type="text",id="reservation_id" name="reservation_id" placeholder="ID" class="input" required>
        <input type="hidden" name="email" value="<?php echo $receivedEmail; ?>">
        <br></br>
        <input type="submit" value="Pay now" class="button" style="width: 10%;cursor: pointer;">
    </div>
    </form>
    <ul>
    <div class="form-holder3">
    <li><a href="rentcar.php?email=<?php echo $receivedEmail; ?>">Return to Home Page</a></li>
    </div>
    </ul>
    <?php
    if (isset($_GET['warning'])) {
        $warning =$_GET['warning'] ;
        echo "<p class=\"warning\">{$warning}</p>"; // Display using appropriate styling
    }
    echo "</div>";
    echo "<br></br>";
    ?>


</body>
</html>