<!DOCTYPE html>
<html>
<head>
	<title>update hotel group</title>
</head>
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
	$conn->close();
}
$hot_gr_name = "'".$hot_gr_name."'";

$hot_gr_name_q = 'hot_gr_name =';
$str_q = 'str =';
$str_num_q = 'str_num =';
$post_code_q = 'post_cod =';
$city_q = 'city =';
$num_of_hot_q = 'num_of_hot =';

$new_hot_gr_name = $conn->real_escape_string($_POST['new_hot_gr_name']);
$str = $conn->real_escape_string($_POST['str']);
$str_num = $conn->real_escape_string($_POST['str_num']);
$post_code = $conn->real_escape_string($_POST['post_code']);
$city = $conn->real_escape_string($_POST['city']);
$num_of_hot = $conn->real_escape_string($_POST['num_of_hot']);

$l = 0;
if(empty($num_of_hot)) {
	$num_of_hot_q = '';
} elseif ($l == 0) {
	$l = 1;
} else {
	$num_of_hot = $num_of_hot.",";
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
if(empty($new_hot_gr_name)) {
	$hot_gr_name_q = '';
} elseif ($l == 0) {
	$l = 1;
	$new_hot_gr_name = "'".$new_hot_gr_name."'";
} else {
	$new_hot_gr_name = "'".$new_hot_gr_name."',";
}

$sql = "UPDATE HOTEL_GROUP
SET $hot_gr_name_q $new_hot_gr_name $str_q $str $str_num_q $str_num $post_code_q $post_code $city_q $city $num_of_hot_q $num_of_hot
WHERE hot_gr_name = $hot_gr_name;";
	
if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Something went wrong, please try again later";
}

$conn->close();
?>

</body>
</html>