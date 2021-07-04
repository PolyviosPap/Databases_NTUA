<!DOCTYPE html>
<html lang="en">
<head>
	<title>Administrator</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

<h3>Παρακαλώ επιλέξτε ενέργεια:</h3>
<ul class="top-level-menu">
    <li>
        <a href="">Εισαγωγή</a>
        <ul class="second-level-menu">
            <li><a class="link" href="insert/hotel_group">Ξενοδοχειακής αλυσίδας</a></li>
			<li><a class="link" href="insert/hotel">Ξενοδοχείου</a></li>
			<li><a class="link" href="insert/room">Δωματίου</a></li>
			<li><a class="link" href="insert/employee">Υπαλλήλου</a></li>
			<li><a class="link" href="insert/customer">Πελάτη</a></li>
			<li><a class="link" href="insert/rent">Ενοικίασης</a></li>
        </ul>
    </li>
	
	<li>
        <a href="">Επεξεργασία</a>
        <ul class="second-level-menu">
            <li>
                <a href="">Ξενοδοχειακής αλυσίδας</a>
                <ul class="third-level-menu">
                    <li><a class="link" href="update/hotel_group">Στοιχεία</a></li>
                    <li><a class="link" href="update/hotel_group/phones">Τηλέφωνα</a></li>
                    <li><a class="link" href="update/hotel_group/emails">E-mails</a></li>
                </ul>
            </li>
			
			<li>
                <a href="">Ξενοδοχείου</a>
                <ul class="third-level-menu">
                    <li><a class="link" href="update/hotel">Στοιχεία</a></li>
                    <li><a class="link" href="update/hotel/phones">Τηλέφωνα</a></li>
                    <li><a class="link" href="update/hotel/emails">E-mails</a></li>
                </ul>
            </li>
			
			<li><a class="link" href="update/room">Δωματίου</a></li>
			
			<li><a class="link" href="update/employee">Υπαλλήλου</a></li>
			
			<li><a class="link" href="update/customer">Πελάτη</a></li>
        </ul>
    </li>
	
	<li>
        <a href="">Διαγραφή</a>
        <ul class="second-level-menu">
            <li><a class="link" href="delete/hotel_group">Ξενοδοχειακής αλυσίδας</a></li>
			<li><a class="link" href="delete/hotel">Ξενοδοχείου</a></li>
			<li><a class="link" href="delete/room">Δωματίου</a></li>
			<li><a class="link" href="delete/employee">Υπαλλήλου</a></li>
        </ul>
    </li>

</ul>

<h3>Εκκρεμείς Κρατήσεις:</h3>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
	die("Something went wrong, contact with the IT department.");
}

$sql = "SELECT res_id, irs_num, room_id, start_date, finish_date, paid FROM RESERVES;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$html = "<table id = 'table'<tr>
    <th>Κωδικός</th>
    <th>ΑΦΜ πελάτη</th>
	<th>Δωμάτιο</th>
	<th>Άφιξη</th>
	<th>Αναχώηρηση</th>
    <th>Πληρωμή</th>
  </tr>";
    while($row = $result->fetch_assoc()) {
		$html = $html."<tr>
		<td>".$row["res_id"]."</td>
		<td>".$row["irs_num"]."</td>
		<td>".$row["room_id"]."</td>
		<td>".$row["start_date"]."</td>
		<td>".$row["finish_date"]."</td>
		<td>".$row["paid"]."</td>
		</tr>";
    }
	$html = $html."</table>";
	
	echo "$html";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>