<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/rentcar.css">
    <title>Home</title>
</head>
<body>

<?php
        if(isset($_GET["email"]))
        $receivedEmail = $_GET["email"];
        else if(isset($_GET["email"])){
            $receivedEmail = $_GET["email"];
        }

?>

    <br><br><br><br><br>
    <p class="header">&nbsp;Curenting <br>&nbsp;Rent Your Car Now</p>
    
    <div class="button-container">
    <form action="carsoption.php" method="post">
    
        <input type="hidden" id="email" name="email" value="<?php echo $receivedEmail; ?>">
        <input type="submit" value="Rent" class="button" style="left:30%"> 
    </form>

    <form action="search.php" method="post">
    <input type="hidden" id="email" name="email" value="<?php echo $receivedEmail; ?>">
        <input type="submit" value="Browse" class="button" style="left: 45%;">
    </form>
    

    <form action="customercars.php" method="post">
    <input type="hidden" id="email" name="email" value="<?php echo $receivedEmail; ?>">
        <input type="submit" value="Return" class="button" style="left:60%">
    </form>
    </div>
    

</body>
</html>