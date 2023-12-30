<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $receivedEmail = $_POST["email"];
        $reservation_id = $_POST['reservationID'];
        $return_date = date('Y-m-d', strtotime($_POST['return_date'])); // Format as YYYY-MM-DD 

        
        $conn = new mysqli('localhost','root','','curenting');
        if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
        }
        else{
            $sql = "SELECT `reservation_id`,`reservation_date`, return_date, total_price,car_id,`reservation_status`, price_per_day
            FROM car NATURAL JOIN (reservation NATURAL JOIN customer) 
            WHERE reservation.reservation_id = '$reservation_id' AND customer.email='$receivedEmail'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $rs= $row['reservation_status'];
                if ($rs=='rented'){
                    $rid= $row['reservation_id'];
                    $cid= $row['car_id'];
                    $sd= $row['reservation_date'];
                    $rd= $row['return_date']; // currently null, must udate it to = $return_date
                    if (strtotime($return_date) <= strtotime($sd))
                    {
                        header("location:customercars.php?warning=Invalid Date&email=$receivedEmail");
                    }
                    else{

                        $days = floor (strtotime($return_date) - strtotime($sd)) / (60 * 60 * 24);// compute total days by subtracting return date and start date
                        $tp= $row['price_per_day']*$days;


                        
                        $c="UPDATE car
                        SET status = 'active'
                        WHERE car_id = $cid";
                        $p="UPDATE reservation
                        SET return_date = '$return_date', total_price = $tp, reservation_status = 'returned'
                        WHERE reservation_id = $rid";
                        if (mysqli_query($conn, $c) && mysqli_query($conn, $p)) {
                            header("location:payment.php?email=$receivedEmail&reservation_id=$reservation_id");
                        }
                        else{
                            echo "Failed to update car and reservation: " . mysqli_error($conn);
                        }
                    }
                      
                }
                else{
                    echo "return failed 2".mysqli_error($conn);
                    header("location:customercars.php?warning=car not rented&email=$receivedEmail");
                }             
            }
            else{
                echo "data not inserted 3".mysqli_error($conn);
                header("location:customercars.php?warning=car not rented&email=$receivedEmail");
            }
        }
        $conn->close();
    ?>
</body>
</html>
