<!DOCTYPE html>
<html>
<head>
	<title>update employee</title>
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
$hot_id_q = 'hot_id =';
$hot_id_q2 = 'hot_id =';
$finish_date_q = 'finish_date=';
$position_q = 'position=';

$str = $conn->real_escape_string($_POST['str']);
$str_num = $conn->real_escape_string($_POST['str_num']);
$post_code = $conn->real_escape_string($_POST['post_code']);
$city = $conn->real_escape_string($_POST['city']);
$hot_name = $conn->real_escape_string($_POST['hot_name']);
$finish_date = $conn->real_escape_string($_POST['finish_date']);
$position = $conn->real_escape_string($_POST['position']);

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

if(empty($hot_name)) {
	$hot_id_q = '';
} else {
	$hot_name = "'".$hot_name."'";
	$sql = "SELECT hot_id FROM HOTEL WHERE hot_name = $hot_name";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$hot_id = $row["hot_id"];
	if ($l == 0) {
		$l = 1;
	} else {
		$hot_id = $hot_id.",";
	}
}

$d = 0;
if(empty($position)) {
	$position_q = '';
} elseif ($d == 0) {
	$d = 1;
	$position = "'".$position."'";
} else {
	$position = "'".$position."',";
}
if(empty($finish_date)) {
	$finish_date_q = '';
} elseif ($d == 0) {
	$d = 1;
	$finish_date = "'".$finish_date."'";
} else {
	$finish_date = "'".$finish_date."',";
}

if(empty($hot_name)) {
	$hot_id_q2 = '';
} else {
	$hot_id2 = $hot_id;
	if ($d == 0) {
		$d = 1;
	} else {
		$hot_id2 = $hot_id2.",";
	}
}

$sql1 = "UPDATE EMPLOYEE
SET $hot_id_q $hot_id $str_q $str $str_num_q $str_num $post_code_q $post_code $city_q $city
WHERE irs_num = $irs_num;";

$sql2 = "UPDATE WORKS
SET $hot_id_q2 $hot_id $finish_date_q $finish_date $position_q $position
WHERE irs_num = $irs_num;";

if (($l == 0)&&($d == 0)) {
	die ("Δεν έχετε συμπληρώσει κάποιο πεδίο για αλλαγή.");
} else {
	if ($l == 1) {
		if ($conn->query($sql1) === TRUE) {
			$l = 3;
		} else {
			"Κάτι δεν πήγε καλά, παρακαλώ επικοινωνήστε με το τμήμα IT.";
		}
	} else {
		$l = 3;
	}
	if ($d == 1) {
		if ($conn->query($sql2) === TRUE) {
			$d = 3;
		} else {
			echo "Κάτι δεν πήγε καλά, παρακαλώ επικοινωνήστε με το τμήμα IT.";
		}
	} else {
		$d = 3;
	}
	if (($l == 3)&&($d == 3)) {
		echo "Η ανανέωση έγινε με επιτυχία.";
	} else {
		echo "Κάτι δεν πήγε καλά, παρακαλώ επικοινωνήστε με το τμήμα IT.";
	}
}
$conn->close();
?>

</body>
</html>