<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Car</title>
    <link rel="stylesheet" href="frontend/addcar.css">
</head>
<?php
        if(isset($_POST["email"])){
            $receivedEmail = $_POST["email"];
        }
        else if(isset($_GET["email"])){
            $receivedEmail = $_GET["email"];
        }
        ?>
<body>
<form action="addCardb.php" onsubmit="return validate_phone_number()"  method="post">
<div class="form-holder">
<h2  > Curenting </h2>
<h3>Add a Car</h3>
    
    <input type="text" id="i" name="id" placeholder="id" class="input" required> <br><br>

    
    <input type="text" id="pi" name="pid" placeholder="plate id" class="input" required> <br><br>
    

    
    <input type="text" id="m" name="model" placeholder="Car model" class="input" required> <br><br>

    
    <input type="text" id="y" name="year" placeholder="year" class="input" required> <br><br>

    
    <input type="text" id="c" name="color" placeholder="color" class="input" required> <br><br>

    <label><input type="radio" name="choice" value="active"> Active</label>
    <label><input type="radio" name="choice" value="out_of_service"> Out of service</label>
    <label><input type="radio" name="choice" value="rented"> Rented</label>
    <br><br>

    
    <input type="text" id="pd" name="ppd" placeholder="Price per day" class="input" required> <br><br>

    
    <input type="text" id="oid" name="oid" placeholder="Office Id" class="input" required> <br><br>

    <input type="hidden" id="email" name="email" value="<?php echo $receivedEmail; ?>">
    <input type="submit" value="Add" class="input" style="width:105%;">
    </div>
</form>

<?php


if (isset($_GET['warning'])) {
    $warning =$_GET['warning'] ;
    echo "<p class=\"warning\">{$warning}</p>"; // Display using appropriate styling
}
?>

</body>
</html>