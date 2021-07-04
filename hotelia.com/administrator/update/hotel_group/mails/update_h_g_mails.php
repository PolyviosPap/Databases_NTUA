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

$mail1 = $conn->real_escape_string($_POST['mail1']);
$mail2 = $conn->real_escape_string($_POST['mail2']);
$mail3 = $conn->real_escape_string($_POST['mail3']);
$mail4 = $conn->real_escape_string($_POST['mail4']);
$mail5 = $conn->real_escape_string($_POST['mail5']);

$l = 0;

if(empty($mail1)&&empty($mail2)&&empty($mail3)&&empty($mail4)&&empty($mail5)) {
	die("no e-mails submitted.");
}


if (!empty($mail1)) {
	$mail1 = "'".$mail1."'";
	$sql = "INSERT INTO H_G_EM (hot_gr_id, email)
	VALUES ($hot_gr_id, $mail1);";
	if ($conn->query($sql) === TRUE) {
		$l = 1;
	}
}
if (!empty($mail2)) {
	$mail2 = "'".$mail2."'";
	$sql = "INSERT INTO H_G_EM (hot_gr_id, email)
	VALUES ($hot_gr_id, $mail2);";
	if ($conn->query($sql) === TRUE) {
		$l = 1;
	}
}
if (!empty($mail3)) {
	$mail3 = "'".$mail3."'";
	$sql = "INSERT INTO H_G_EM (hot_gr_id, email)
	VALUES ($hot_gr_id, $mail3);";
	if ($conn->query($sql) === TRUE) {
		$l = 1;
	}
}
if (!empty($mail4)) {
	$mail4 = "'".$mail4."'";
	$sql = "INSERT INTO H_G_EM (hot_gr_id, email)
	VALUES ($hot_gr_id, $mail4);";
	if ($conn->query($sql) === TRUE) {
		$l = 1;
	}
}
if (!empty($mail5)) {
	$mail5 = "'".$mail5."'";
	$sql = "INSERT INTO H_G_EM (hot_gr_id, email)
	VALUES ($hot_gr_id, $mail5);";
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