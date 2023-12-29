
<!DOCTYPE html>
<html>
<head>
<title>Admin Reports</title>
<script>
        function showFields() {
            var selectedOption = document.getElementById("reportType").value;
            var inputContainer = document.getElementById("reportOptions");
            // Reset the input container
            inputContainer.innerHTML = "";

            // Create input fields based on the selected option
            if (selectedOption === "all_reservations") {
                inputContainer.innerHTML += '<label for="start_date">Period from: </label>';
                inputContainer.innerHTML += '<input type="date",id="sd" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>';
                inputContainer.innerHTML += '<label for="end_date">To: </label>';
                inputContainer.innerHTML += '<input type="date",id="ed" name="end_date" value="<?php echo date('Y-m-d'); ?>" required> ';
            } else if (selectedOption === "car_reservations") {
                inputContainer.innerHTML += '<label for="start_date">Period from: </label>';
                inputContainer.innerHTML += '<input type="date",id="sd" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>';
                inputContainer.innerHTML += '<label for="end_date">To: </label>';
                inputContainer.innerHTML += '<input type="date",id="ed" name="end_date" value="<?php echo date('Y-m-d'); ?>" required> ';
                inputContainer.innerHTML += '<label for="id">Car ID: </label>';
                inputContainer.innerHTML += '<input type="text",id="id" name="id"  required>';
            } else if (selectedOption === "car_status") {
                inputContainer.innerHTML += '<label for="start_date">Day: </label>';
                inputContainer.innerHTML += '<input type="date",id="sd" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>';
            } else if (selectedOption === "customer_reservations") {
                inputContainer.innerHTML += '<label for="id">Customer ID: </label>';
                inputContainer.innerHTML += '<input type="text",id="id" name="id"  required>';
            } else if (selectedOption === "daily_payments") {
                inputContainer.innerHTML += '<label for="start_date">Period from: </label>';
                inputContainer.innerHTML += '<input type="date",id="sd" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>';
                inputContainer.innerHTML += '<label for="end_date">To: </label>';
                inputContainer.innerHTML += '<input type="date",id="ed" name="end_date" value="<?php echo date('Y-m-d'); ?>" required> ';
            }
        }
    </script>
</head>
<body>
<h1>Admin Reports</h1>

<form  method="post" >
    <label for="reportType">Select Report:</label>
    <select id="reportType" name="reportType" onchange="showFields()">
        <option disabled selected value="">Select option</option>
        <option value="all_reservations">All Reservations within Period</option>
        <option value="car_reservations">Car Reservations within Period</option>
        <option value="car_status">Car Status on Specific Day</option>
        <option value="customer_reservations">Customer Reservations</option>
        <option value="daily_payments">Daily Payments within Period</option>
    </select>
    <!--
       <label for="start_date">Period from: </label>
        <input type="date",id="sd" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>
        <label for="end_date">To: </label>
        <input type="date",id="ed" name="end_date" value="<?php echo date('Y-m-d'); ?>" required>
        <label for="id">To: </label>
        <input type="text",id="id" name="id"  required>
    -->

    <div id="reportOptions"></div>


    <button type="submit" name="generateReport">Generate Report</button>

    <li><a href="admin.php">Return to Home Page</a></li>
</form>



<?php


if(isset($_POST["email"])){
    $receivedEmail = $_POST["email"];
}
else if(isset($_GET["email"])){
    $receivedEmail = $_GET["email"];
}

// Connect to database (replace with your credentials)
$conn = new mysqli('localhost', 'root', '', 'curenting');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
else{
    if (isset($_POST['generateReport'])) {
        $reportTerm = $_POST['reportType'];
        //$periodStart = $_POST['start_date'];
        //$periodEnd = $_POST['end_date'];
        //$id=$_POST['id'];

    switch ($reportTerm) {
        case 'all_reservations':
            $periodStart = $_POST['start_date'];
            $periodEnd = $_POST['end_date'];
            $sql = "SELECT car.*, customer.*, reservation.*
            FROM reservation
            JOIN car ON reservation.car_id = car.car_id
            JOIN customer ON reservation.customer_id = customer.customer_id
            WHERE reservation_date BETWEEN '$periodStart' AND '$periodEnd'";
            break;
        case 'car_reservations':
            $periodStart = $_POST['start_date'];
            $periodEnd = $_POST['end_date'];
            $id=$_POST['id'];
            $sql = "SELECT c.*, cu.*, r.*
            FROM reservation as r
            JOIN car as c ON r.car_id = c.car_id
            JOIN customer as cu ON r.customer_id = cu.customer_id
            WHERE r.reservation_date BETWEEN '$periodStart' AND '$periodEnd'
            AND c.car_id = $id";
            break;
        case 'car_status':
            $periodStart = $_POST['start_date'];
            $sql = "SELECT car.*, reservation.*
            FROM car
            NATURAL JOIN reservation  
            WHERE reservation_date LIKE '$periodStart'";
            break;
        case 'customer_reservations':
            $id=$_POST['id'];
            $sql = "SELECT car.*, customer.*, reservation.*
            FROM reservation
            JOIN car ON reservation.car_id = car.car_id
            JOIN customer ON reservation.customer_id = customer.customer_id
            WHERE customer.customer_id = $id";
            break;
        case 'daily_payments':
            $periodStart = $_POST['start_date'];
            $periodEnd = $_POST['end_date'];
            $sql = "SELECT SUM(total_price) AS total_payment, payment_date
            FROM reservation
            WHERE payment_date BETWEEN '$periodStart' AND '$periodEnd'
            GROUP BY payment_date";
            break;
    }

    // Execute query and display results
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<table cellspacing='20'>";
        echo "<thead>";
        switch ($reportTerm){
            case 'all_reservations':
                echo "<th>Car ID</th>";
                echo "<th>Car Model</th>";
                echo "<th>Plate ID</th>";
                echo "<th>Year</th>";
                echo "<th>color</th>";
                echo "<th>price per day</th>";

                echo "<th>Customer ID</th>";
                echo "<th>SSN</th>";
                echo "<th>First name</th>";
                echo "<th>Last name</th>";
                echo "<th>Driving license</th>";
                echo "<th>Age</th>";
                echo "<th>Phone</th>";
                echo "<th>E-mail</th>";
                break;

            case 'car_reservations':
                echo "<th>Car ID</th>";
                echo "<th>Car Model</th>";
                echo "<th>Plate ID</th>";
                echo "<th>Year</th>";
                echo "<th>color</th>";
                echo "<th>price per day</th>";
                echo "<th>Date of Reservation</th>";
                echo "<th>Date of Return</th>";
                break;

            case 'car_status':
                echo "<th>Car ID</th>";
                echo "<th>Car Model</th>";
                echo "<th>Plate ID</th>";
                echo "<th>Year</th>";
                echo "<th>color</th>";
                echo "<th>price per day</th>";
                echo "<th>Reservation status</th>";
                break;

            case 'customer_reservations':
                echo "<th>Customer ID</th>";
                echo "<th>SSN</th>";
                echo "<th>First name</th>";
                echo "<th>Last name</th>";
                echo "<th>Driving license</th>";
                echo "<th>Age</th>";
                echo "<th>Phone</th>";
                echo "<th>E-mail</th>";
                echo "<th>Car Model</th>";
                echo "<th>Plate ID</th>";
                echo "<th>Date of Reservation</th>";
                echo "<th>Date of Return</th>";
                break;

            case 'daily_payments': 
                echo "<th>Date</th>";
                echo "<th>Total payment</th>";
                break;
        }

        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            switch ($reportTerm){
                case 'all_reservations':
                    
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['plate_id'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['color'] . "</td>";
                    echo "<td>" . $row['price_per_day'] . "</td>";

                    echo "<td>" . $row['customer_id'] . "</td>";
                    echo "<td>" . $row['ssn'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['driving_license'] . "</td>";
                    echo "<td>" . $row['age'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";

                    break;

                case 'car_reservations':
                
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['plate_id'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['color'] . "</td>";
                    echo "<td>" . $row['price_per_day'] . "</td>";
                    echo "<td>" . $row['reservation_date'] . "</td>";
                    echo "<td>" . $row['return_date'] . "</td>";
                    break;

                case 'car_status':
            
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['plate_id'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['color'] . "</td>";
                    echo "<td>" . $row['price_per_day'] . "</td>";
                    echo "<td>" . $row['reservation_status'] . "</td>";
                    break;
                case 'customer_reservations':
                    echo "<td>" . $row['customer_id'] . "</td>";
                    echo "<td>" . $row['ssn'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['driving_license'] . "</td>";
                    echo "<td>" . $row['age'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['plate_id'] . "</td>";
                    echo "<td>" . $row['reservation_date'] . "</td>";
                    echo "<td>" . $row['return_date'] . "</td>";
                    break;

                case 'daily_payments':
                    echo "<td>" . $row['payment_date'] . "</td>";
                    echo "<td>" . $row['total_payment'] . "</td>";
                    break;
                }
                echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

    }
    else {
        echo "No results found.";
    }
}
}

?>

</body>
</html>
