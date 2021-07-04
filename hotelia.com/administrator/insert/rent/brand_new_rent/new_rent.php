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

$irs_num_emp = $conn->real_escape_string($_POST['irs_num_emp']);
$irs_num_cus = $conn->real_escape_string($_POST['irs_num_cus']);
$room_id = $conn->real_escape_string($_POST['room_id']);
$start_date = $conn->real_escape_string($_POST['start_date']);
$finish_date = $conn->real_escape_string($_POST['finish_date']);
$method = $conn->real_escape_string($_POST['method']);
$amount = $conn->real_escape_string($_POST['amount']);

$start_date = "'".$start_date."'";
$finish_date = "'".$finish_date."'";
$method = "'".$method."'";

if (empty($irs_num_emp)||empty($irs_num_cus)||empty($method)||empty($amount)||empty($room_id)||empty($start_date)||empty($finish_date)) {
	die("Είναι υποχρεωτικά επιπλέον πεδία, παρακαλώ προσπαθείστε πάλι.");
}

$sql = "INSERT INTO PAYMENT_TR (amount, method) VALUES ($amount, $method) ";
if ($conn->query($sql) === TRUE) {
	$payment_id = $conn->insert_id;
} else {
    die("Something went wrong, contact with the IT department.");
}
	
$sql = "INSERT INTO RENTS (irs_num_emp, irs_num_cus, payment_id, room_id, start_date, finish_date)
VALUES( $irs_num_emp, $irs_num_cus, $payment_id, $room_id, $start_date, $finish_date);";

if ($conn->query($sql) === TRUE) {
	echo "Η προσθήκη έγινε με επιτυχία.";
} else {
	die ("Κάτι δεν πήγε καλά, παρακαλώ προσπαθείστε αργότερα.");
}

$conn->close();

?>

</body>
</html>