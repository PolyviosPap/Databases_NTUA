<!DOCTYPE html>
<html>
<head>
	<title>Αναζήτηση</title>
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

$irs_num = $conn->real_escape_string($_POST['irs_num']);
$arr_date = $conn->real_escape_string($_POST['arr_date']);
$dep_date = $conn->real_escape_string($_POST['dep_date']);
$arr_date1 = $arr_date;
$dep_date1 = $dep_date;
$cap = $conn->real_escape_string($_POST['cap']);
$city = $conn->real_escape_string($_POST['city']);
$hot_name = $conn->real_escape_string($_POST['hot_name']);
$stars = $conn->real_escape_string($_POST['stars']);
$am1 = $conn->real_escape_string($_POST['am1']);
$am2 = $conn->real_escape_string($_POST['am2']);
$am3 = $conn->real_escape_string($_POST['am3']);

$cap_q = "";
$city_q = "";
$hot_id_q = "";
$am1_q = "";
$am2_q = "";
$am3_q = "";

if(empty($arr_date)||empty($dep_date)) {
	die("Οι ημερομηνίες αναχώρησης και άφιξης είναι υποχρεωτικές.");
} elseif (date("Y-m-d")>$arr_date) {
	die("Παρακαλώ ελέγξτε τις ημερομηνίες σας.");
} elseif ($arr_date > $dep_date) {
	die("Παρακαλώ ελέγξτε τις ημερομηνίες σας.");
}

$arr_date = "'".$arr_date."'";
$dep_date = "'".$dep_date."'";

if(!empty($hot_name)) {
	$hot_id = '';
	$sql = "SELECT hot_id FROM HOTEL WHERE hot_name = '$hot_name'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$hot_id = $row["hot_id"];

	if (!is_numeric($hot_id)){
		die("Το ξενοδοχείο που πληκτρολογήσατε δε βρέθηκε, παρακαλώ προσπαθείστε πάλι.");
	}
	$hot_id_q = "AND hot_id = $hot_id";
}

if(is_numeric($cap)) {
	$cap_q = "AND (capacity >= $cap OR capacity + expandable >= $cap)";
}

if(!empty($city)) {
	$city_q = "AND hot_id IN (SELECT hot_id FROM HOTEL WHERE city = '$city')";
}

if(is_numeric($stars)) {
	$stars_q = "AND hot_id IN (SELECT hot_id FROM HOTEL WHERE stars = $stars)";
}

if(!empty($am1)) {
	$am1_q = "AND room_id IN (SELECT room_id FROM AMENITIES WHERE amenities = '$am1')";
}

if(!empty($am2)) {
	$am2_q = "AND room_id IN (SELECT room_id FROM AMENITIES WHERE amenities = '$am2')";
}

if(!empty($am3)) {
	$am3_q = "AND room_id IN (SELECT room_id FROM AMENITIES WHERE amenities = '$am3')";
}

$sql = "SELECT room_id, hot_id, price, repairs_need, room_view, expandable, capacity FROM ROOM
WHERE room_id NOT IN
(SELECT room_id FROM RESERVES
WHERE (start_date <= $arr_date AND finish_date >= $arr_date)
OR (start_date < $dep_date AND finish_date >= $dep_date)
OR ($arr_date <= start_date AND $dep_date >= start_date))
AND room_id NOT IN
(SELECT room_id FROM RENTS
WHERE finish_date > $arr_date)
$cap_q
$city_q
$hot_id_q
$stars_q
$am1_q
$am2_q
$am3_q
ORDER BY price;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$html = "<table id = 'table'<tr>
    <th>Ξενοδοχείο</th>
    <th>Τιμή</th>
	<th>Πόλη</th>
	<th>Θέα</th>
	<th>μεγ. Χωρητικότητα</th>
    <th>Εκκρεμείς επισκευές</th>
  </tr>";
    while($row = $result->fetch_assoc()) {
		$hot_id = $row["hot_id"];
		$room_id = $row["room_id"];

		$sql1 = "SELECT hot_name, city FROM HOTEL WHERE hot_id = $hot_id";
		$result1 = $conn->query($sql1);
		$row1 = $result1->fetch_assoc();
		$hot_name = $row1["hot_name"];
		$city = $row1["city"];
		
		$capacity = $row["capacity"];
		$expandable = $row["expandable"];
		$max_cap = $capacity + $expandable;
		
		$html = $html."<tr>
		<td>$hot_name</td>
		<td><a href='reserve.php?irs_num=$irs_num&room_id=$room_id&arr_date=$arr_date1&dep_date=$dep_date1'>".$row["price"]."</td>
		<td>$city</td>
		<td>".$row["room_view"]."</td>
		<td>$max_cap</td>
		<td>".$row["repairs_need"]."</td>
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