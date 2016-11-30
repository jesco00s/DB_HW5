<!DOCTYPE>
<html>
	<head>
		<title>DB HW 5</title>
	</head>
		
	
	<body>

		<h1>View Students</h1>
			<p>Pulled tuples from Students table</p>
				
		<?php

		include "PHP_DB.php";
				
		$connection = connect_db();
		$query = 'SELECT * from students';
		query($query, $connection);
		?>

		<h3>Navigation</h3>
		<ul>
			<li><a href="homepage.html">Homepage</a></li>
			<li><a href="addStudents.php">Add Student</a></li>
		</ul>

	</body>
</html>

