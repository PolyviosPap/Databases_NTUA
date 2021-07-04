<!DOCTYPE html>
<html>
<head>
	<title>update room</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$room_id = $conn->real_escape_string($_POST['room_id']);
if (empty($room_id)) {
	die("Room id is required, please try again.");
	$conn->close();
}

$room_id_q = 'room_id =';
$price_q = 'price =';
$repairs_need_q = 'repairs_need =';
$expandable_q = 'expandable =';
$room_view_q = 'room_view =';
$capacity_q = 'capacity =';

$new_room_id = $conn->real_escape_string($_POST['new_room_id']);
$price = $conn->real_escape_string($_POST['price']);
$repairs_need = $conn->real_escape_string($_POST['repairs_need']);
$expandable = $conn->real_escape_string($_POST['expandable']);
$room_view = $conn->real_escape_string($_POST['room_view']);
$capacity = $conn->real_escape_string($_POST['capacity']);

$l = 0;
if(empty($capacity)) {
	$capacity_q = '';
} elseif ($l == 0) {
	$l = 1;
} else {
	$capacity = $capacity.",";
}
if(empty($room_view)) {
	$room_view_q = '';
} elseif ($l == 0) {
	$l = 1;
	$room_view = "'".$room_view."'";
} else {
	$room_view = "'".$room_view."',";
}
if(!is_numeric($expandable)) {
	$expandable_q = '';
} elseif ($l == 0) {
	$l = 1;
} else {
	$expandable = $expandable.",";
}
if(empty($repairs_need)) {
	$repairs_need_q = '';
} elseif ($l == 0) {
	$l = 1;
	$repairs_need = "'".$repairs_need."'";
} else {
	$repairs_need = "'".$repairs_need."',";
}
if(empty($price)) {
	$price_q = '';
} elseif ($l == 0) {
	$l = 1;
} else {
	$price = $price.",";
}
if(empty($new_room_id)) {
	$room_id_q = '';
} elseif ($l == 0) {
	$l = 1;
} else {
	$new_room_id = $new_room_id.",";
}

$sql = "UPDATE ROOM
SET $room_id_q $new_room_id $price_q $price $repairs_need_q $repairs_need $expandable_q $expandable $room_view_q $room_view $capacity_q $capacity
WHERE room_id = $room_id;";

if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Something went wrong, please try again later";
}

$conn->close();
?>

</body>
</html>