<!DOCTYPE html>
<html>
<head>
	<title>delete employee</title>
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
	die("Δεν έχετε εισάγει κάποιο ΑΦΜ.");
}

$sql = "DELETE FROM EMPLOYEE WHERE irs_num = $irs_num";
if ($conn->query($sql) === TRUE) {
	echo "Η διαγραφή έγινε με επιτυχία.";
} else {
	echo "Κάτι δεν πήγε καλά, παρακαλώ προσπαθείστε αργότερα. Είστε σίγουρος πως πληκτρολογήσατε έγκυρο ΑΦΜ;";
}
$conn->close();
?>

</body>
</html>