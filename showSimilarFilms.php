<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Similar films Informations </title>
</head>

<body>
<?php
	include('connect.php');
?>

<?php
// To fetch FILM_ID
if (array_key_exists('fid', $_GET)) {
		$film_id = $_GET['fid'];
	}
else {
	echo "Customer has not rented any films.";
	exit();
}

// Query preparation holding filmID, filmTitle, number_of_common_actors, and category.
if ($film_id != '') {
	$query = <<<__QUERY
	select f.film_id, f.title, count(f.title) as `number of actors`, c.name from film f, film_actor fa, category c where (f.film_id, c.category_id) in (select fc.film_id, fc. category_id from film_category fc, category c where c. category_id = fc. category_id and fc.category_id in (select fc1.category_id from film_category fc1 where fc1.film_id = ?)) and fa.actor_id in (select fa2.actor_id from film_actor fa2 where fa2.film_id = ?) and f.film_id =fa.film_id and f.film_id <> ? group by f.title ORDER BY `number of actors`  DESC, f.title ASC limit 10 
__QUERY;
}
else{
	echo "Customer has not rented any films.";
	exit();
}
// For accesing the category information
if ($stmt = $conn->prepare($query)) {
	$stmt->bind_param('iii', $film_id, $film_id, $film_id);
	$stmt->execute();
    $stmt->bind_result($filmID, $filmTitle, $NumberOfActors, $category);
	$stmt->store_result();
	$hasResult = $stmt->fetch();
	$stmt->free_result();
}
// For accessing filmID, filmTitle, number_of_common_actors
if ($stmt = $conn->prepare($query)) {
	$stmt->bind_param('iii', $film_id, $film_id, $film_id);
	$stmt->execute();
    $stmt->bind_result($filmID, $filmTitle, $NumberOfActors, $category);
	$stmt->store_result();
    $numResult = $stmt->num_rows;
}

// Displaying data to end Users:
if ($numResult == 0) {
    echo <<<__NO_RESULT
<p>$filmTitle has no Similar film.</p>
__NO_RESULT;
}
else{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "Similar films in the same category of $category:";
	while($stmt->fetch())
	{ 
		echo "<li> (id: $filmID) $filmTitle: $NumberOfActors common actors.</li>"; 
	}
} 
$stmt->free_result();
?>
</body>
</html>