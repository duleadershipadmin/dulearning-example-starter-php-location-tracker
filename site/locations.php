<?php
include "../constants.php";

parse_str($_SERVER['QUERY_STRING'], $params);

$name = $params['nameInput'];

if (is_null($name) || $name == "" || !in_array($name, $_SESSION["names"])) {
    header("location: /?return=true");
    die;
}

$locType = $params['locType'];

if (!is_null($locType)) {
    if ($locType == "0") {
        $conn = get_db_connection();
        
        $result = $conn->query("SELECT name, country, city, year, month, day FROM locations WHERE locations.name = '".$name."'");
        
        if ($conn->error) {
            error_log("Read failed: " . $conn->error);
        }
    } else {
        $conn = get_db_connection();
        
        $result = $conn->query("SELECT name, country, city, year, month, day FROM locations WHERE locations.name != '".$name."'");
        
        if ($conn->error) {
            error_log("Read failed: " . $conn->error);
        }
    }
}
?>

<!DOCTYPE html>
<html>
	<?php echo file_get_contents(TOP."/tmpl/header.html")?>
	<body>
		<div class="header">
			<h1>Discover Locations</h1>
		</div>
		<div class="locationBox">
			<div style="display: block"><?php echo "Welcome ".$name ?></div>
			<div style="margin-bottom: 2em">
    			<form class="locForm" action="/locations.php">
    				<input type="hidden" name="nameInput" value="<?php echo $name?>"/>
    				<input type="hidden" name="locType" value="0"/>
    				<input type="submit" value="Show Your Locations"/>
    			</form>
    			<form class="locForm" action="/locations.php">
    				<input type="hidden" name="nameInput" value="<?php echo $name?>"/>
    				<input type="hidden" name="locType" value="1"/>
    				<input type="submit" value="Show Others' Locations"/>
    			</form>
    			<form class="locForm" action="/">
    				<input type="submit" value="Start Over"/>
    			</form>
			</div>
			<div style="margin-bottom: 2em">
				<span>Enter your location for tracking: </span>
				<form action="/insertLocation.php">
					<input type="hidden" name="name" value="<?php echo $name?>"/>
					<label for="country">Country: </label>
					<input type="text" id="country" name="country">
					<label for="city">City: </label>
					<input type="text" id="city" name="city">
					<label for="year">Year: </label>
					<input type="number" id="year" name="year">
					<label for="month">Month: </label>
					<input type="number" id="month" name="month">
					<label for="day">Day: </label>
					<input type="number" id="day" name="day"><br>
    				<input type="submit" value="Submit"/>
    			</form>
			</div>
		</div>
		<div>
			<table class="tableBox">
				<tr>
					<td>Name</td>
					<td>Country</td>
					<td>City</td>
					<td>Year</td>
					<td>Month</td>
					<td>Day</td>
				</tr>
				<?php 
				while($row = $result->fetch_assoc()) {
				    echo "<tr>\n";
				    echo "<td>".$row['name']."</td>";
				    echo "<td>".$row['country']."</td>";
				    echo "<td>".$row['city']."</td>";
				    echo "<td>".$row['year']."</td>";
				    echo "<td>".$row['month']."</td>";
				    echo "<td>".$row['day']."</td>";
				}
				?>
			</table>
		</div>
	</body>
</html>