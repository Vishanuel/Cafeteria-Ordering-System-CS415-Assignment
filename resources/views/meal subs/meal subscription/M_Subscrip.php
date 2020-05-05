<?php
$Name = $_POST['name'];
$User_ID = $_POST['User_ID'];
$Delivery_Location = $_POST['delivery_location'];
$Food_Item = $_POST['select_food'];
$Qty = $_POST['quantity'];
//$Total = $_POST['quantity'];
$Delivery_Mode = $_POST['optradio_deliv'];
$Time = $_POST['time'];
$Days = $_POST['day'];

if (!empty($Name) || !empty($User_ID) || !empty($Delivery_Location) || !empty($Food_Item) || !empty($Qty) || 
!empty($Delivery_Mode) || !empty($Time) || !empty($Days)) {

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "cafeteria";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_errno()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_errno());
    } else {
        $SELECT = "SELECT patron_id FROM meal_subs WHERE patron_id = ? Limit 1 ";
        $INSERT = "INSERT INTO meal_subs (Person_Name,Delivery_Location,Food_Item_Name,Quantity,Deliv_Mode,Subs_Meal_Time,Meal_Subs_Day)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $User_ID );
        $stmt->execute();
        $stmt->bind_result($User_ID);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0){
            $stmt->close();

            if($stmt = $conn->prepare($INSERT)){
            $stmt->bind_param("ssssisds", $User_ID, $Name, $Delivery_Location, $Food_Item, $Qty, $Delivery_Mode, $Time, $Days);
            $stmt->execute();

            echo "New Meal Subscription Added";
            }else {
                $error = $conn->errno.' '.$conn->error;
                echo $error;
            }
        }else{
            $error = $mysqli->error_list.' '.$mysqli->error;
            echo $error;
        }
        $stmt->close;
        $conn->close;
        }
} else {
    echo "All fields are required";
    die();
}
?>
