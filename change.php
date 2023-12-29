<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Car Status</title>
    <link rel="stylesheet" href="frontend/change.css">
</head>
<body>
<div class="form-holder">
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
            $sql = "SELECT `car_id`,`plate_id`, `model`, `year`, `color`, `status`, `price_per_day`, `office_location`,`office_phone` 
            FROM `car` JOIN office ON car.office_id=office.office_id;";
            $result = $conn->query($sql);
            echo "<table>";
            echo "<table cellspacing='20'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Car id</th>";
            echo "<th>Plate id</th>";
            echo "<th>Model</th>";
            echo "<th>Year</th>";
            echo "<th>Color</th>";
            echo "<th>Availability</th>";
            echo "<th>Rent price (per day)</th>";
            echo "<th>Car's location</th>";
            echo "<th>Contact information</th>";
            // ... more headers as needed
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['plate_id'] . "</td>";
                    echo "<td>" . $row['model']. "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['color'] . "</td>";
                    echo "<td>" . $row['status']. "</td>";
                    echo "<td>" . $row['price_per_day'] . "</td>";
                    echo "<td>" . $row['office_location']. "</td>";
                    echo "<td>" . $row['office_phone']. "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                
            }
        }
        $conn->close();
    ?>
    <form method="post">
        <label for="change">Write down the car ID you want to change: </label>
        <input type="text",id="r" name="change" placeholder="ID" required>

        
        <label><input type="radio" name="choice" value="active"> Active</label>
        <label><input type="radio" name="choice" value="out_of_service"> Out of service</label>
        <label><input type="radio" name="choice" value="rented"> Rented</label>
        <br><br>
        <input type="submit" value="Change it" class="button" style="width: 120px;">
    </form>

<?php
if (isset($_POST['change']) && isset($_POST['choice'])) {
    $change = $_POST['change'];
    $choice = $_POST['choice'];
    
        

    $conn = new mysqli('localhost','root','','curenting');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }
    else{
        $s="UPDATE car SET status = '$choice' WHERE car_id = $change";
            if(mysqli_query($conn,$s)){
                //echo "error";
                    header("location:admin.php?message=Done&email=$receivedEmail");
                }
                else{
                    echo "not changed".mysqli_error($conn);

                }
    }
}
?>


</div>
</body>
</html>