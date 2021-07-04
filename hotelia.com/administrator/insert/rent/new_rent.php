<!DOCTYPE html>
<html>
<head>
	<title>new rent</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Something went wrong, contact with the IT department.");
}

$irs_num_emp = $conn->real_escape_string($_POST['irs_num']);
$res_id = $conn->real_escape_string($_POST['res_id']);
$method = $conn->real_escape_string($_POST['method']);
$amount = $conn->real_escape_string($_POST['amount']);

$method = "'".$method."'";

if (empty($irs_num_emp)||empty($res_id)||empty($method)||empty($amount)) {
	die("Είναι υποχρεωτικά επιπλέον πεδία, παρακαλώ προσπαθείστε πάλι.");
}

$sql = "SELECT irs_num, room_id, start_date, finish_date FROM RESERVES WHERE res_id = $res_id;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$irs_num_cus = $row["irs_num"];
if (empty($irs_num_cus)){
	die("Η κράτηση δε βρέθηκε, παρακαλώ προσπαθείστε ξανά.");
}

$sql = "INSERT INTO PAYMENT_TR (amount, method) VALUES ($amount, $method) ";
if ($conn->query($sql) === TRUE) {
	$payment_id = $conn->insert_id;
} else {
    die("Something went wrong, contact with the IT department.");
}

$room_id = $row["room_id"];
$start_date = "'".$row["start_date"]."'";
$finish_date = "'".$row["finish_date"]."'";
	
$sql = "INSERT INTO RENTS (irs_num_emp, irs_num_cus, payment_id, room_id, start_date, finish_date)
VALUES( $irs_num_emp, $irs_num_cus, $payment_id, $room_id, $start_date, $finish_date);";

if ($conn->query($sql) === TRUE) {
	echo "Η προσθήκη έγινε με επιτυχία.";
} else {
	die ("Κάτι δεν πήγε καλά, παρακαλώ προσπαθείστε αργότερα.");
}

$sql = "DELETE FROM RESERVES WHERE res_id = $res_id";
$conn->query($sql);

$conn->close();

?>

</body>
</html>