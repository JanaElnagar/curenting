<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
    
            
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $conn = new mysqli('localhost','root','','curenting');
    if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
    }
    else{
        $sql = "SELECT * FROM `admin` WHERE admin_email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['admin_password']==$password){
                header("location:admin.php?email=$email");
            }
            else{
                header("location:adminlogin.php?warning=wrong%20password");
            }
            
        } else {
            header("location:adminlogin.php?warning=wrong%20email");
            
        }
        
    }
    $conn->close();
    
    ?>
    
</body>
</html>