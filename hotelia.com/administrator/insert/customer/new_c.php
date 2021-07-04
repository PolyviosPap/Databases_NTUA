<!DOCTYPE html>
<html>
<head>
	<title>new customer</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Something went wrong, contact with the IT department.");
}

$f_name = $conn->real_escape_string($_POST['f_name']);
$l_name = $conn->real_escape_string($_POST['l_name']);
$first_reg = $conn->real_escape_string($_POST['first_reg']);
$irs_num = $conn->real_escape_string($_POST['irs_num']);
$soc_sec_num = $conn->real_escape_string($_POST['soc_sec_num']);
$str = $conn->real_escape_string($_POST['str']);
$str_num = $conn->real_escape_string($_POST['str_num']);
$post_code = $conn->real_escape_string($_POST['post_code']);
$city = $conn->real_escape_string($_POST['city']);

$f_name = "'".$f_name."'";
$l_name = "'".$l_name."'";
$first_reg = "'".$first_reg."'";
$str = "'".$str."'";
$city = "'".$city."'";

if (empty($f_name)||empty($l_name)||empty($first_reg)||empty($irs_num)||empty($soc_sec_num)||empty($str)||empty($str_num)||empty($post_code)||empty($city)) {
	die("Είναι υποχρεωτικά επιπλέον πεδία, παρακαλώ προσπαθείστε πάλι.");
} else {
	$sql = "INSERT INTO CUSTOMER (irs_num, soc_sec_num, f_name, l_name, str, str_num, post_code, city, first_reg)
	VALUES ($irs_num, $soc_sec_num, $f_name, $l_name, $str, $str_num, $post_code, $city, $first_reg);";
	
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