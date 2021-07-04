<!DOCTYPE html>
<html>
<head>
	<title>delete hotel</title>
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
	die("Δεν έχετε εισάγει τίτλο ξενοδοχείου.");
}
$hot_name = "'".$hot_name."'";

$sql = "SELECT hot_id FROM HOTEL WHERE hot_name = $hot_name";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hot_id = $row["hot_id"];

if (empty($hot_id)){
	die("Το ξενοδοχείο που αναζητήσατε δε βρέθηκε, παρακαλώ προσπαθείστε ξανά.");
}
$sql = "DELETE FROM HOTEL WHERE hot_id = $hot_id";
if ($conn->query($sql) === TRUE) {
	echo "Η διαγραφή έγινε με επιτυχία.";
} else {
	echo "Κάτι δεν πήγε καλά, παρακαλώ προσπαθείστε αργότερα.";
}
$conn->close();
?>

</body>
</html>