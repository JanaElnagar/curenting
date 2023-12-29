<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

            
    $email = $_POST['email'];
    $ssn = $_POST['ssn'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $DL = $_POST['DL'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];

     // Allow +, - and . in phone number
     $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
     // Remove "-" from number
     $phone_to_check = str_replace("-", "", $filtered_phone_number);
     // Check the lenght of number
     // This can be customized if you want phone number from a specific country
     if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
        header("location:signup.php?warning=wrong%20phone%20number");
     }
    else{

        $conn = new mysqli('localhost','root','','curenting');
        if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
        }
        else{
            $check = "SELECT * FROM Customer WHERE Customer.email = '$email'";
            $result = $conn->query($check);
            if ($result->num_rows > 0){
                header("location:signup.php?warning=Email already exists!");
            }
            else{
                $sql = "INSERT INTO Customer (ssn,first_name,last_name,driving_license,age,phone,email,customer_pass) values ('$ssn','$fname','$lname','$DL',$age,'$phone','$email','$pass')" ;
                if(mysqli_query($conn,$sql))
                {
                    header("location:rentcar.php?email=$email");
                }
                else{
                    echo "data not inserted".mysqli_error($conn);
                } 
            }
            
        

        }
    $conn->close();
    }

?>


    
</body>
</html>
