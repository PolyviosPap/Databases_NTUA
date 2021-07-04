<!DOCTYPE html>
<html>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hot_gr_name = $conn->real_escape_string($_POST['hot_gr_name']);
if (empty($hot_gr_name)) {
	die("Hotel group title is required, please try again.");
}
$hot_gr_name = "'".$hot_gr_name."'";

$sql = "SELECT hot_gr_id FROM HOTEL_GROUP WHERE hot_gr_name = $hot_gr_name";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hot_gr_id = $row["hot_gr_id"];

if (empty($hot_gr_id)){
	die("Hotel group title not recognised, please try again.");
}

$phone1 = $conn->real_escape_string($_POST['phone1']);
$phone2 = $conn->real_escape_string($_POST['phone2']);
$phone3 = $conn->real_escape_string($_POST['phone3']);
$phone4 = $conn->real_escape_string($_POST['phone4']);
$phone5 = $conn->real_escape_string($_POST['phone5']);

$l = 0;

if(empty($phone1)&&empty($phone2)&&empty($phone3)&&empty($phone4)&&empty($phone5)) {
	die("no phones submitted.");
}


if (!empty($phone1)) {
	$sql = "INSERT INTO H_G_PH (hot_gr_id, phone)
	VALUES ($hot_gr_id, $phone1);";
	if ($conn->query($sql) === TRUE) {
		$l = 1;
	}
}
if (!empty($phone2)) {
	$sql = "INSERT INTO H_G_PH (hot_gr_id, phone)
	VALUES ($hot_gr_id, $phone2);";
	if ($conn->query($sql) === TRUE) {
		$l = 1;
	}
}
if (!empty($phone3)) {
	$sql = "INSERT INTO H_G_PH (hot_gr_id, phone)
	VALUES ($hot_gr_id, $phone3);";
	if ($conn->query($sql) === TRUE) {
		$l = 1;
	}
}
if (!empty($phone4)) {
	$sql = "INSERT INTO H_G_PH (hot_gr_id, phone)
	VALUES ($hot_gr_id, $phone4);";
	if ($conn->query($sql) === TRUE) {
		$l = 1;
	}
}
if (!empty($phone5)) {
	$sql = "INSERT INTO H_G_PH (hot_gr_id, phone)
	VALUES ($hot_gr_id, $phone5);";
	if ($conn->query($sql) === TRUE) {
		$l = 1;
	}
}

if ($l == 1) {
	echo "New record created successfully";
} else {
	echo "Something went wrong, please try again later";
}

$conn->close();
?>

</body>
</html>