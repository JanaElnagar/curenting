<!DOCTYPE html>
<html>
<head>
<title>Car Search</title>
<link rel="stylesheet" href="frontend/search.css">
<script src="search.js"></script>
</head>
<body>
<div class="form-holder">
  <h1 class = "search_header" style=" text-align: center"> Search Available Cars </h1>
  <form  method="post">
    <label for="model">Model:</label>  
    <input type="text" id="model" name="model" class="input"><br></br>  

    <label for="year">Year:</label>
    <input type="text" id="year" name="year" class="input"><br></br>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" class="input"><br></br>

    <button type="submit" class="button" style="width: 105%;cursor: pointer;">Search</button>
  </form>
</div>
<br></br>

<?php
    if(isset($_POST["email"])){
            $receivedEmail = $_POST["email"];
        }
        else if(isset($_GET["email"])){
            $receivedEmail = $_GET["email"];
        }


// Connect to your database
$conn = new mysqli('localhost','root','','curenting');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Receive search criteria from the POST request
if (isset($_POST['model']) && isset($_POST['year']) && isset($_POST['color'])){
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];

    // Construct the SQL query dynamically based on the received criteria
    $sql = "SELECT `car_id`,`plate_id`, `model`, `year`, `color`, `status`, `price_per_day`, `office_location`,`office_phone` 
    FROM `car` JOIN office ON car.office_id=office.office_id where 1";
    if ($model) {
        $sql .= " AND model LIKE '%$model%'";
    }
    if ($year) {
        $sql .= " AND year = '$year'";
    }
    if ($color) {
        $sql .= " AND color = '$color'";
    }

    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    echo "<div class='form-holder3'>";
    if ($result->num_rows > 0) {
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
        while ($row = $result->fetch_assoc()) {
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
    else{
        echo "No cars found!";
    }
    echo "</div>";
    echo "<br></br>";

}
$conn->close();

?>

<div class="form-holder2">
<h1 class = "rent_header" style=" text-align: center"> Confirming </h1>
    <form action="check_availability.php" method="post">
        <label for="rent">Write down your desired car ID: </label>
        <input type="text",id="r" name="rent" placeholder="ID" class="input" required>

        <label for="start_date">Day of pickup: </label>
        <input type="date",id="sd" name="start_date" class="input" required>

        <!--
        <label for="days">Number of days (if available): </label>
        <input type="text",id="d" name="days" >
        -->

        <input type="hidden" name="email" value="<?php echo $receivedEmail; ?>">
        <br></br>
        <input type="submit" value="Rent it" class="button" style="width: 105%;cursor: pointer;">
    
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

