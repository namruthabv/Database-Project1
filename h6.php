<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSCI 5333.3 DBMS Fall 2016 HW #6</title>
</head>

<body>
<?php
	include('connect.php');
?>
<?php
// To Input Customer ID
if (array_key_exists('cid', $_GET)) {
		$cus_id = $_GET['cid'];
	}
else {
	echo "Please enter the Customer ID along with URL.";
	exit();
}

// Preparation of Query along with cross checking the valid Customer ID	
if ($cus_id != '') {
	$query = <<<__QUERY
	select f.film_id, f.title from film f, inventory i, rental r where f.film_id = i.film_id and i.inventory_id = r.inventory_id and r.customer_id = ?
__QUERY;
}
else{
	echo "Please enter the valid Customer ID.";
	exit();
}
if ($stmt = $conn->prepare($query)) {
	$stmt->bind_param('i', $cus_id);
	$stmt->execute();
    $stmt->bind_result($filmID, $filmTitle);
	$stmt->store_result();
    $numResult = $stmt->num_rows;
}

// Displaying film related data pertaining to a customer
if ($numResult == 0) {
    echo <<<__NO_RESULT
<p>The customer with ID $cus_id has not rented any film.</p>
__NO_RESULT;
}
else{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "Customer ID $cus_id rented the following films:";
	while($stmt->fetch())
	{
		echo "<li> (id: $filmID) $filmTitle <a href=\"showSimilarFilms.php?fid=$filmID\">similar films</a> </li>";
	}
}
$stmt->free_result();
?>
</body>
</html>