<!DOCTYPE html>
<html lang="en">
<head>
	<title>Πληροφορίες ξενοδοχείων</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>

<ul class="top-level-menu">
    <li>
        <a href="../">Αναζήτηση</a>
    </li>
	
	<li>
        <a href="../create_acc">Δημιουργία λογαριασμού</a>
    </li>
	
	<li>
        <a href="">Πληροφορίες ξενοδοχείων</a>
    </li>
	
	<li>
        <a href="../info">Ποιοί είμαστε</a>
    </li>
</ul>

<?php
$conn = new mysqli("localhost","Don","password","spring_project");

// Check connection
if ($conn->connect_error) {
	die("Something went wrong, contact with the IT department.");
}

$sql = "SELECT hot_name, str, str_num, post_code, city, num_of_rooms, stars FROM HOTEL ORDER BY city;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$html = "<table id = 'table'<tr>
    <th>Ξενοδοχείο</th>
    <th>Αστέρια</th>
	<th>Πόλη</th>
	<th>Οδός</th>
	<th>Τ.Κ.</th>
    <th>Αριθμός δωματίων</th>
  </tr>";
    while($row = $result->fetch_assoc()) {
		$html = $html."<tr>
		<td>".$row["hot_name"]."</td>
		<td>".$row["stars"]."</td>
		<td>".$row["city"]."</td>
		<td>".$row["str"]." ".$row["str_num"]."</td>
		<td>".$row["post_code"]."</td>
		<td>".$row["num_of_rooms"]."</td>
		</tr>";
    }
	$html = $html."</table>";
	
	echo "$html";
}

$conn->close();
?>

</body>
</html>