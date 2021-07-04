<!DOCTYPE html>
<html>
<head>
	<title>delete hotel group</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Something went wrong, contact with the IT department.");
}

$hot_gr_name = $conn->real_escape_string($_POST['hot_gr_name']);
if (empty($hot_gr_name)) {
	die("Δεν έχετε εισάγει τίτλο ξενοδοχειακής αλυσίδας.");
}
$hot_gr_name = "'".$hot_gr_name."'";

$sql = "SELECT hot_gr_id FROM HOTEL_GROUP WHERE hot_gr_name = $hot_gr_name";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hot_gr_id = $row["hot_gr_id"];

if (empty($hot_gr_id)){
	die("Η ξενοδοχειακή αλυσίδα που αναζητήσατε δε βρέθηκε, παρακαλώ προσπαθείστε ξανά.");
}
$sql = "DELETE FROM HOTEL_GROUP WHERE hot_gr_id = $hot_gr_id";
if ($conn->query($sql) === TRUE) {
	echo "Η διαγραφή έγινε με επιτυχία.";
} else {
	echo "Κάτι δεν πήγε καλά, παρακαλώ προσπαθείστε αργότερα.";
}
$conn->close();
?>

</body>
</html>