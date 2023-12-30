<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/admin.css">
    <title>Admin</title>
</head>


<body>

       <?php
        if(isset($_POST["email"])){
            $receivedEmail = $_POST["email"];
        }
        else if(isset($_GET["email"])){
            $receivedEmail = $_GET["email"];
        }
        ?>
        <br>
    <p class="header">&nbsp;Curenting </p>
    <div class="button-container">
    <form action="addcar.php" method="post">

                <input type="submit" value="Add a New Car" class="button" style="left:15%">
                <input type="hidden" id="email" name="email"   value="<?php echo $receivedEmail; ?>">
    </form>
    <form action="change.php" method="post">

                <!-- <input type="submit" value="Change a current car status" class="button" style="left:55%"> -->
                <button  class="button" style="left:55%">Change a Current<br>Car Status</button>
                <input type="hidden" id="email" name="email"   value="<?php echo $receivedEmail; ?>">
                <br>
    </form>
    <form action="admin_search.php" method="post">

                <input type="submit" value="Advanced Search" class="button" style="left:15%; bottom: 50px;">
                <input type="hidden" id="email" name="email"   value="<?php echo $receivedEmail; ?>">
    </form>
    <form action="admin_reports.php" method="post">

                <input type="submit" value="Admin Reports" class="button" style="left:55%; bottom: 50px;">
                <input type="hidden" id="email" name="email"   value="<?php echo $receivedEmail; ?>">
    </form>
        </div>
    <?php


if (isset($_GET['warning'])) {
    $warning =$_GET['warning'] ;
    echo "<p class=\"warning\">{$warning}</p>"; // Display using appropriate styling
}
if (isset($_GET['message'])) {
    $message =$_GET['message'] ;
    echo "<p class=\"message\">{$message}</p>"; // Display using appropriate styling
}
?>
</body>
</html>