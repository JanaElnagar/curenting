<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="frontend/signup.css">
</head>

<body>
<div class="form-holder" style="height:650px;">
        <div class="signup">
        <h1 class = "signup_header" style=" text-align: center"> Curenting </h1>

<form action="addCustomer.php" onsubmit="return validate_phone_number()"  method="post">
<br><br>
    <input type="text" id="f" name="ssn" placeholder="ssn" class="input" required> <br><br>

    <input type="text" id="f" name="fname" placeholder="first name" class="input" required> <br><br>
    

    <input type="text" id="l" name="lname" placeholder="last name" class="input" required> <br><br>

    <input type="text" id="d" name="DL" placeholder="driving license" class="input" required> <br><br>

    <input type="text" id="a" name="age" placeholder="age" class="input" required> <br><br>

    <input type="text" id="pn" name="phone" placeholder="phone number" class="input" required> <br><br>

    <input type="email" id="e" name="email" placeholder="E-mail" class="input" required> <br><br>

    <input type="password" id="p" name="pass" placeholder="password" class="input" required> <br><br>
    <input type="submit" value="sign up" class="input" style="width: 105%;
    cursor: pointer;" >
    </div>
    
    
</form>

    </div> 
<?php


if (isset($_GET['warning'])) {
    $warning =$_GET['warning'] ;
    echo "<p class=\"warning\">{$warning}</p>"; // Display using appropriate styling
}
?>


  
</body>
</html>