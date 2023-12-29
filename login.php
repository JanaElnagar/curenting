<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="frontend/login.css">
</head>

<body>
    <br><br><br><br><br><br>
<div class="form-holder">
        <div class="login">
        <h3 class = "login_header" > Curenting </h3>

    <!-- Login Form -->
    <form action="check.php" method="post">
                <br><br>
                <input type="text" id="eSuccess" name="email" placeholder="Email" class="input" required> <br><br>
                <br>
                <input type="password" id="pSuccess" name="pass" placeholder="Password" class="input" required> <br><br>

                <input type="submit" value="login" class="input" style="width: 105%;
    cursor: pointer;">
                </div>
    </form>
    

        <div>

                <br><br>
                <p class="signup">Don't have an account? <a href="signup.php">Sign up now</a></p>
            </div>
<?php


if (isset($_GET['warning'])) {
    $warning =$_GET['warning'] ;
    echo "<p class=\"warning\">{$warning}</p>"; // Display using appropriate styling
}
?>
</body>
</html>
