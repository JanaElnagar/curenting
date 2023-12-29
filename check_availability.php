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
        $car_id = $_POST['rent'];
        //$days = $_POST['days'] ?? null;
        //$sd = $_POST['start_date']; // reservation_date
        $sd = date('Y-m-d', strtotime($_POST['start_date'])); // Format as YYYY-MM-DD

        
        $conn = new mysqli('localhost','root','','curenting');
        if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
        }
        else{
            $sql = "SELECT `status`,`car_id`,`office_id`,`customer_id` FROM car,customer WHERE car.car_id = '$car_id' AND customer.email='$receivedEmail'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $st= $row['status'];
                if ($st=='active'){
                    $cuid= $row['customer_id'];
                    $cid= $row['car_id'];
                    $oid =$row['office_id'];
                    

                    $sql_insert="INSERT INTO reservation (`customer_id`, `car_id`, `office_id`, `reservation_date`,`reservation_status`,payment_status) 
                    VALUES ($cuid,$cid,$oid,'$sd','rented','pending')";
                    
                
                    if(mysqli_query($conn,$sql_insert))
                    {
                        $r="UPDATE car
                        SET status = 'rented'
                        WHERE car_id = $cid";

                        $l="SELECT office_location 
                        FROM office 
                        WHERE office_id=$oid";
                        
                        if(mysqli_query($conn,$r)){
                            $result = $conn->query($l);
                            if ($result->num_rows > 0){
                                $loc = mysqli_fetch_assoc($result)['office_location'];
                                header("location:pickup.php?email=$receivedEmail&pickup_location=$loc");
                            }
                        }
                        else{
                            header("location:carsoption.php?warning=Error renting car&email=$receivedEmail");
                        }
                    }
                    else{
                        header("location:carsoption.php?warning=Error renting car&email=$receivedEmail");
                    }
                }
                else{
                    //echo "data not not inserted".mysqli_error($conn);
                    header("location:carsoption.php?warning=not%20available&email=$receivedEmail");
                }             
            }
            else{
                //echo "data not inserted".mysqli_error($conn);
                header("location:carsoption.php?warning=we're%20not%20serving%20this%20car&email=$receivedEmail");
            }
        }
        $conn->close();
    ?>
</body>
</html>
