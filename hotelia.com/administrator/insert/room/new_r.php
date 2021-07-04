<!DOCTYPE html>
<html>
<head>
	<title>new room</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Something went wrong, contact with the IT department.");
}

$room_id = $conn->real_escape_string($_POST['room_id']);
$hot_name = $conn->real_escape_string($_POST['hot_name']);
$price = $conn->real_escape_string($_POST['price']);
$repairs_need = $conn->real_escape_string($_POST['repairs_need']);
$expandable = $conn->real_escape_string($_POST['expandable']);
$room_view = $conn->real_escape_string($_POST['room_view']);
$capacity = $conn->real_escape_string($_POST['capacity']);

if (empty($repairs_need)) {
    $repairs_need = "'no repairs need'";
} else {
	$repairs_need = "'".$repairs_need."'";
}

if (empty($expandable)) {
    $expandable = 0;
}

if (empty($room_view)) {
    $room_view = "'no view'";
} else {
	$room_view = "'".$room_view."'";
}

$hot_name = "'".$hot_name."'";

$sql = "SELECT hot_id FROM HOTEL WHERE hot_name = $hot_name";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hot_id = $row["hot_id"];
if (empty($hot_id)){
	die("Το ξενοδοχείο που πληκτρολογήσατε δε βρέθηκε, παρακαλώ προσπαθείστε ξανά.");
}

if (empty($room_id)||empty($hot_id)||empty($price)||empty($capacity)) {
	die("Είναι υποχρεωτικά επιπλέον πεδία, παρακαλώ προσπαθείστε πάλι.");
} else {
	$sql = "INSERT INTO ROOM (room_id, hot_id, price, repairs_need, expandable, room_view, capacity)
	VALUES ($room_id, $hot_id, $price, $repairs_need, $expandable, $room_view, $capacity);";
	
	if ($conn->query($sql) === TRUE) {
		echo "Η προσθήκη έγινε με επιτυχία.";
	} else {
		echo "Κάτι δεν πήγε καλά, παρακαλώ προσπαθείστε αργότερα.";
	}
}

$conn->close();

?>

</body>
</html>