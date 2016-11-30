<!DOCTYPE html>
<html>
	<head>
		<title>DB HW 5</title>
	</head>
	<body>

		<h1>Add Application</h1>
			<form action="addApplication.php" method="post">
				StudentId:<br>
					<!-- Need to make sure data meet the requirements
						to be entered into the table 
						* JavaScript function? -->
				<input type="text" name="studentId"><br>
				JobId:<br>
					<!-- Make sure it isn't blank-->
				<input type="text" name="jobId"><br>
				<input type="submit" name="submit">
			</form>
		
		
		<h3>Navigation</h3>
		<ul>
			<li><a href="homepage.html">Homepage</a></li>
			<li><a href="viewStudents.php">View all Students</a></li>
		</ul>

	</body>
</html>

<?php
include "PHP_DB.php";

// the top level function
function insert_application ($StdID, $JobID)
{
	// Connect to the database
	$connection = connect_db();
	 
	// Display contents of table Guest before insert
	echo '<br> Table Applications before: ';
	$query = 'SELECT * from applications';
	query($query, $connection);
	echo '<br>';
	
	
	// Insert the guest (add quotes around name and address fields
	$values = $StdID . ', \'' . $JobID . '\'';
	echo 'StudentId: ' . $StdID . ',     JobId: ' . $JobID . '<br>' . 'VALUES: ';
	echo $values . '<br>';
	 
	insert("applications", $values, $connection);

	// Display contents of table Guest after insert
	echo '<br> Table Applications afer: ';
	$query = 'SELECT * from appplications';
	query($query, $connection);
}

//------------------------------------------------------
// the main program
//------------------------------------------------------
if (isset($_POST['submit']))
{
	$std_id = ''; $jb_id ='';
	$std_id = $_POST[studentId];
	$jb_id = $_POST[jobId];
	if(!($std_id == '') && !($jb_id == '')){
		if((ctype_digit($std_id)) && (ctype_digit($jb_id))){
			insert_application($std_id, $jb_id);
		} else {
			echo 'Please make sure Student ID and JobID are integers.';
		}
	} else{
		echo 'Please fill all fields to add Student.';
	}	
	
	

}

?>