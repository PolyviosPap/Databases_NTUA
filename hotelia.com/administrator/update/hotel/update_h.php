<!DOCTYPE html>
<html>
<head>
	<title>update hotel</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Something went wrong, contact with the IT department.");
}

$hot_name = $conn->real_escape_string($_POST['hot_name']);
if (empty($hot_name)) {
	die("Ο ξενοδοχειακός τίτλος είναι υποχρεωτικός, παρακαλώ προσπαθήστε ξανά.");
	$conn->close();
}
$hot_name = "'".$hot_name."'";

$hot_name_q = 'hot_name =';
$hot_gr_id_q = 'hot_gr_id =';
$str_q = 'str =';
$str_num_q = 'str_num =';
$post_code_q = 'post_code =';
$city_q = 'city =';
$num_of_rooms_q = 'num_of_rooms =';
$stars_q = 'stars =';

$new_hot_name = $conn->real_escape_string($_POST['new_hot_name']);
$hot_gr_name = $conn->real_escape_string($_POST['hot_gr_name']);
$str = $conn->real_escape_string($_POST['str']);
$str_num = $conn->real_escape_string($_POST['str_num']);
$post_code = $conn->real_escape_string($_POST['post_code']);
$city = $conn->real_escape_string($_POST['city']);
$num_of_rooms = $conn->real_escape_string($_POST['num_of_rooms']);
$stars = $conn->real_escape_string($_POST['stars']);

$l = 0;
if(empty($stars)) {
	$stars_q = '';
} elseif ($l == 0) {
	$l = 1;
} else {
	$stars = "'".$stars."',";
}
if(empty($num_of_rooms)) {
	$num_of_rooms_q = '';
} elseif ($l == 0) {
	$l = 1;
} else {
	$num_of_rooms = $num_of_rooms.",";
}
if(empty($city)) {
	$city_q = '';
} elseif ($l == 0) {
	$l = 1;
	$city = "'".$city."'";
} else {
	$city = "'".$city."',";
}
if(empty($post_code)) {
	$post_code_q = '';
} elseif ($l == 0) {
	$l = 1;
} else {
	$post_code = $post_code.",";
}
if(empty($str_num)) {
	$str_num_q = '';
} elseif ($l == 0) {
	$l = 1;
} else {
	$str_num = $str_num.",";
}
if(empty($str)) {
	$str_q = '';
} elseif ($l == 0) {
	$l = 1;
	$str = "'".$str."'";
} else {
	$str = "'".$str."',";
}
if(empty($hot_gr_name)) {
	$hot_gr_id_q = '';
} else {
	$hot_gr_name = "'".$hot_gr_name."'";
	$sql = "SELECT hot_gr_id FROM HOTEL_GROUP WHERE hot_gr_name = $hot_gr_name";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$hot_gr_id = $row["hot_gr_id"];
	if ($l == 0) {
		$l = 1;
	} else {
		$hot_gr_id = $hot_gr_id.",";
	}
}
if(empty($new_hot_name)) {
	$hot_name_q = '';
} elseif ($l == 0) {
	$l = 1;
	$new_hot_name = "'".$new_hot_name."'";
} else {
	$new_hot_name = "'".$new_hot_name."',";
}

$sql = "UPDATE HOTEL
SET $hot_name_q $new_hot_name $hot_gr_id_q $hot_gr_id $str_q $str $str_num_q $str_num $post_code_q $post_code $city_q $city $num_of_rooms_q $num_of_rooms $stars_q $stars
WHERE hot_name = $hot_name;";

if ($conn->query($sql) === TRUE) {
	echo "Η ανανέωση έγινε με επιτυχία.";
} else {
	echo "Κάτι δεν πήγε καλά, παρακαλώ προσπαθείστε αργότερα.";
}

$conn->close();
?>

</body>
</html>