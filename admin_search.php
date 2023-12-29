<?php
// Connect to database (replace with your credentials)
$conn = new mysqli('localhost','root','','curenting');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Handle search form submission
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
    $searchField = $_POST['searchField'];

    // Build dynamic SQL query based on search field
    $sql = "SELECT car.*, customer.*, reservation.*
    FROM car
    LEFT JOIN reservation ON car.car_id = reservation.car_id
    LEFT JOIN customer ON reservation.customer_id = customer.customer_id
    WHERE ";


    switch ($searchField) {
        case 'car':
            $sql .= "car.model LIKE '%$searchTerm%' OR car.plate_id LIKE '%$searchTerm%' OR car.year LIKE '%$searchTerm%' OR car.color LIKE '%$searchTerm%'";
            break;
        case 'customer':
            $sql .= "customer.name LIKE '%$searchTerm%' OR customer.email LIKE '%$searchTerm%' OR customer.phone LIKE '%$searchTerm%'";
            break;
        case 'reservation':
            $sql .= "reservation_date LIKE '%$searchTerm%'";
            break;
    }

    // Execute query and display results
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead>";
        // ... Create table headers for car, customer, and reservation details ...
        switch ($searchField) {
            case 'car':
                echo "<th>Car Model</th>";
                echo "<th>Plate ID</th>";
                echo "<th>Year</th>";
                break;
            case 'customer':
                echo "<th>Customer Name</th>";
                echo "<th>Email</th>";
                echo "<th>Phone</th>";
                // ... Add more relevant customer headers ...
                break;
            case 'reservation':
                echo "<th>Reservation ID</th>";
                echo "<th>Reservation Date</th>";
                echo "<th>Car ID</th>";
                echo "<th>Customer ID</th>";
                // ... Add more relevant reservation headers ...
                break;
        }
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            // ... Display data from each row ...
            switch ($searchField) {
                case 'car':
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['plate_id'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    // ... Display other car data ...
                    break;
                case 'customer':
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    // ... Display other customer data ...
                    break;
                case 'reservation':
                    echo "<td>" . $row['reservation_id'] . "</td>";
                    echo "<td>" . $row['reservation_date'] . "</td>";
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['customer_id'] . "</td>";
                    // ... Display other reservation data ...
                    break;
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No results found.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Search</title>
<link rel="stylesheet" href="frontend/admin_search.css">
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
        <div class="form-holder">
<h1>Advanced Search</h1>
<form method="post">
    <label for="searchTerm">Search Term:</label>
    <input type="text" id="searchTerm" name="searchTerm" class="input" required>
        <br><br>
    <label for="searchField">Search By:</label>
    <select id="searchField" name="searchField" class="input">
        <option value="car">Car Information</option>
        <option value="customer">Customer Information</option>
        <option value="reservation">Reservation Day</option>
    </select>
        <br><br>
    <button type="submit" name="search" class="button">Search</button>
        <br><br>
    <li><a href="admin.php">Return to Home Page</a></li>
</form>
</div>
</body>
</html>
