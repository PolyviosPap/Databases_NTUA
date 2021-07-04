<!DOCTYPE html>
<html>
<head>
	<title>new hotel</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Something went wrong, contact with the IT department.");
}

$hot_name = $conn->real_escape_string($_POST['hot_name']);
$hot_gr_name = $conn->real_escape_string($_POST['hot_gr_name']);
$str = $conn->real_escape_string($_POST['str']);
$str_num = $conn->real_escape_string($_POST['str_num']);
$post_code = $conn->real_escape_string($_POST['post_code']);
$city = $conn->real_escape_string($_POST['city']);
$num_of_rooms = $conn->real_escape_string($_POST['num_of_rooms']);
$stars = $conn->real_escape_string($_POST['stars']);

$hot_name = "'".$hot_name."'";
$hot_gr_name = "'".$hot_gr_name."'";
$str = "'".$str."'";
$city = "'".$city."'";

$sql = "SELECT hot_gr_id FROM HOTEL_GROUP WHERE hot_gr_name = $hot_gr_name";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hot_gr_id = $row["hot_gr_id"];
if (empty($hot_gr_id)){
	die("Η ξενοδοχειακή αλυσίδα που πληκτρολογήσατε δε βρέθηκε, παρακαλώ προσπαθείστε ξανά.");
}

if (empty($hot_name)||empty($hot_gr_name)||empty($str)||empty($str_num)||empty($post_code)||empty($city)||empty($num_of_rooms)||empty($stars)) {
	die("Είναι υποχρεωτικά επιπλέον πεδία, παρακαλώ προσπαθείστε πάλι.");
} else {
	$sql = "INSERT INTO HOTEL (hot_name, hot_gr_id, str, str_num, post_code, city, num_of_rooms, stars)
	VALUES ($hot_name, $hot_gr_id, $str, $str_num, $post_code, $city, $num_of_rooms, $stars);";
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