<?php

include "../constants.php";

parse_str($_SERVER['QUERY_STRING'], $params);

if (array_key_exists('return', $params)) {
    $return = $params['return'];
}
?>

<!DOCTYPE html>
<html>
	<?php echo file_get_contents(TOP."/tmpl/header.html")?>
	<body>
		<div class="header">
			<h1>Welcome to the Location Tracker Website</h1>
		</div>
		<?php 
    		if ($return == "true") {
    		    echo "
            		<div class='error'>
                        <p>
                            Name Not Found
                        </p>
            		</div>
                ";
            }
		?>
		<div class="inputBox">
			<form action="/addUser.php">
				<label for="nameInput">Enter your name: </label><br>
				<input type="text" id="nameInput" name="nameInput"><br>
				<input type="submit" value="Submit">
			</form>
		</div>
	</body>
</html>