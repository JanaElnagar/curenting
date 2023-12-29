<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if(isset($_POST["email"])){
    $receivedEmail = $_POST["email"];
}
else if(isset($_GET["email"])){
    $receivedEmail = $_GET["email"];
}
           
            
$id = $_POST['id'];
$pid = $_POST['pid'];
$model = $_POST['model'];
$year = $_POST['year'];
$color = $_POST['color'];
$choice = $_POST['choice'];
$ppd = $_POST['ppd'];
$oid = $_POST['oid'];

$conn = new mysqli('localhost','root','','curenting');
if($conn->connect_error){
die('Connection Failed : '.$conn->connect_error);
}
else{
    $chech="SELECT car_id FROM car";
    $result = $conn->query($chech);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if($row['car_id']==$id){
                    header("location:addCar.php?warning=Id%20already%20exists");
                }
                else{
                    $chech1="SELECT office_id FROM office";
                    $result = $conn->query($chech1);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        if($row['office_id']==$oid){
                            
                        

    $sql = "INSERT INTO `car`(`car_id`, `plate_id`, `model`, `year`, `color`, `status`, `price_per_day`, `office_id`)
     values ('$id','$pid','$model','$year','$color','$choice','$ppd','$oid')" ;
    if(mysqli_query($conn,$sql))
    {
        header("location:admin.php?warning=added%20successfully&email=$receivedEmail");
    }
    else{
        header("location:addCar.php?warning=ID%20of%20the%20car%20already%20exists&email=$receivedEmail");
    }

}
$conn->close();
}
else{
    header("location:addCar.php?warning=No%20office%20with that id&email=$receivedEmail");
}
}

}
}


?>
</body>
</html>