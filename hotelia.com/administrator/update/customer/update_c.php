<!DOCTYPE html>
<html>
<head>
	<title>update customer</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Something went wrong, contact with the IT department.");
}

$irs_num = $conn->real_escape_string($_POST['irs_num']);
if (empty($irs_num)) {
	die("Το ΑΦΜ είναι υποχρεωτικό, παρακαλώ προσπαθήστε ξανά.");
	$conn->close();
}

$str_q = 'str =';
$str_num_q = 'str_num =';
$post_code_q = 'post_code =';
$city_q = 'city =';

$str = $conn->real_escape_string($_POST['str']);
$str_num = $conn->real_escape_string($_POST['str_num']);
$post_code = $conn->real_escape_string($_POST['post_code']);
$city = $conn->real_escape_string($_POST['city']);

$l = 0;
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

if ($l == 0) {
	die ("Δεν έχετε συμπληρώσει κάποιο πεδίο για αλλαγή.");
} else {
	$sql = "UPDATE CUSTOMER
	SET $str_q $str $str_num_q $str_num $post_code_q $post_code $city_q $city
	WHERE irs_num = $irs_num;";
	
	if ($conn->query($sql) === TRUE) {
		echo "Η ανανέωση έγινε με επιτυχία.";
	} else {
		echo "Κάτι δεν πήγε καλά, παρακαλώ προσπαθείστε αργότερα.";
	}
}

$conn->close();
?>

</body>
</html>