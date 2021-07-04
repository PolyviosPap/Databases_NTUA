<!DOCTYPE html>
<html>
<head>
	<title>new hotel group</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Something went wrong, contact with the IT department.");
}

$hot_gr_name = $conn->real_escape_string($_POST['hot_gr_name']);
$str = $conn->real_escape_string($_POST['str']);
$str_num = $conn->real_escape_string($_POST['str_num']);
$post_code = $conn->real_escape_string($_POST['post_code']);
$city = $conn->real_escape_string($_POST['city']);
$num_of_hot = $conn->real_escape_string($_POST['num_of_hot']);

$hot_gr_name = "'".$hot_gr_name."'";
$str = "'".$str."'";
$city = "'".$city."'";

if (empty($hot_gr_name)||empty($str)||empty($str_num)||empty($post_code)||empty($city)||empty($num_of_hot)) {
	die("Είναι υποχρεωτικά επιπλέον πεδία, παρακαλώ προσπαθείστε πάλι.");
} else {
	$sql = "INSERT INTO HOTEL_GROUP (hot_gr_name, str, str_num, post_cod, city, num_of_hot)
	VALUES ($hot_gr_name, $str, $str_num, $post_code, $city, $num_of_hot);";
	
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