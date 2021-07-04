<!DOCTYPE html>
<html>
<head>
	<title>delete room</title>
</head>
<body>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
    die("Something went wrong, contact with the IT department.");
}

$room_id = $conn->real_escape_string($_POST['room_id']);
if (empty($room_id)) {
	die("Δεν έχετε εισάγει κάποιο κωδικό δωματίου.");
}

$sql = "DELETE FROM ROOM WHERE room_id = $room_id";
if ($conn->query($sql) === TRUE) {
	echo "Η διαγραφή έγινε με επιτυχία.";
} else {
	echo "Κάτι δεν πήγε καλά, παρακαλώ προσπαθείστε αργότερα. Είστε σίγουρος πως πληκτρολογήσατε έγκυρο κωδικό δωματίου;";
}
$conn->close();
?>

</body>
</html>