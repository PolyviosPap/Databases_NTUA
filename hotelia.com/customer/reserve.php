<!DOCTYPE html>
<html>
<head>
	<title>Κράτηση</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

<ul class="top-level-menu">
    <li>
        <a href="">Αναζήτηση</a>
    </li>
	
	<li>
        <a href="create_acc">Δημιουργία λογαριασμού</a>
    </li>
	
	<li>
        <a href="hotel_info">Πληροφορίες ξενοδοχείων</a>
    </li>
	
	<li>
        <a href="info">Ποιοί είμαστε</a>
    </li>
</ul>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
	die("Something went wrong, contact with the IT department.");
}

$irs_num = $_GET["irs_num"];
$room_id = $_GET["room_id"];
$arr_date = $_GET["arr_date"];
$dep_date = $_GET["dep_date"];

if(empty($irs_num)) {
	die("Πρέπει να εισάγετε το ΑΦΜ σας για να κάνετε κράτηση.");
}

$sql = "INSERT INTO RESERVES (irs_num, room_id, start_date, finish_date)
VALUES ($irs_num, $room_id, '$arr_date', '$dep_date');";

if ($conn->query($sql) === TRUE) {
	echo "Η κράτηση έγινε με επιτυχία!";
} else {
	echo "Κάτι πήγε στραβά. Παρακαλώ ελέγξτε ξανα το ΑΦΜ σας.";	
}


$conn->close();
?>

</body>
</html>