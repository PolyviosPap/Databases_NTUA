<!DOCTYPE html>
<html>
<head>
	<title>new employee</title>
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
$hot_name = $conn->real_escape_string($_POST['hot_name']);
$irs_num = $conn->real_escape_string($_POST['irs_num']);
$soc_sec_num = $conn->real_escape_string($_POST['soc_sec_num']);
$str = $conn->real_escape_string($_POST['str']);
$str_num = $conn->real_escape_string($_POST['str_num']);
$post_code = $conn->real_escape_string($_POST['post_code']);
$city = $conn->real_escape_string($_POST['city']);
$start_date = $conn->real_escape_string($_POST['start_date']);
$finish_date = $conn->real_escape_string($_POST['finish_date']);
$position = $conn->real_escape_string($_POST['position']);

$f_name = "'".$f_name."'";
$l_name = "'".$l_name."'";
$hot_name = "'".$hot_name."'";
$str = "'".$str."'";
$city = "'".$city."'";
$start_date = "'".$start_date."'";
$finish_date = "'".$finish_date."'";
$position = "'".$position."'";

$sql = "SELECT hot_id FROM HOTEL WHERE hot_name = $hot_name";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hot_id = $row["hot_id"];
if (empty($hot_id)){
	die("Το ξενοδοχείο που πληκτρολογήσατε δε βρέθηκε, παρακαλώ προσπαθείστε ξανά.");
}

$ok = 0;

if (empty($f_name)||empty($l_name)||empty($hot_name)||empty($irs_num)||empty($soc_sec_num)||empty($str)||empty($str_num)||empty($post_code)||empty($city)||empty($start_date)||empty($finish_date)||empty($position)) {
	die("Είναι υποχρεωτικά επιπλέον πεδία, παρακαλώ προσπαθείστε πάλι.");
} else {
	$sql = "INSERT INTO EMPLOYEE (irs_num, hot_id, soc_sec_num, f_name, l_name, str, str_num, post_code, city)
	VALUES ($irs_num, $hot_id, $soc_sec_num, $f_name, $l_name, $str, $str_num, $post_code, $city);";
	if ($conn->query($sql) === TRUE) {
		$ok = $ok + 1;
	}
	
	$sql = "INSERT INTO WORKS (irs_num, hot_id, start_date, position, finish_date)
	VALUES ($irs_num, $hot_id, $start_date, $position, $finish_date);";
	if ($conn->query($sql) === TRUE) {
		$ok = $ok + 1;
	}
	
	if ($ok == 2) {
		echo "Η προσθήκη έγινε με επιτυχία.";
	} else {
		echo "Κάτι δεν πήγε καλά, παρακαλώ επικοινωνήστε με το τμήμα IT.";
	}
}

$conn->close();

?>

</body>
</html>