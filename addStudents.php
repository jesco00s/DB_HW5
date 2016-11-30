<!DOCTYPE html>
<html>
	<head>
		<title>DB HW 5</title>
	<style>
	studentId{
		width: 80%;
	}
	</style>
	</head>
	<body>

		<h1>Add Student</h1>
			<form action="addStudents.php" method="post">
				StudentId:<br>
					<!-- Need to make sure data meet the requirements
						to be entered into the table 
						* JavaScript function? -->
				<input type="text" name="studentId"><br>
				StudentName:<br>
					<!-- Make sure it isn't blank-->
				<input type="text" name="studentName"><br>
				Major:<br>
					<!-- Make sure it isn't blank-->
				<input type="text" name="major"><br><br>
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
function insert_student ($Sid, $name, $major)
{
	// Connect to the database
	$connection = connect_db();
	 
	// Display contents of table Guest before insert
	echo '<br> Table Students before: ';
	$query = 'SELECT * from students';
	query($query, $connection);
	echo '<br>';
	
	
	// Insert the guest (add quotes around name and address fields
	$values = $Sid . ', \'' . $name . '\', \'' . $major . '\'';
	echo 'Name: ' . $name . ',     Major: ' . $major . '<br>' . 'VALUES: ';
	echo $values . '<br>';
	 
	insert("students", $values, $connection);

	// Display contents of table Guest after insert
	echo '<br> Table students afer: ';
	$query = 'SELECT * from students';
	query($query, $connection);
}

//------------------------------------------------------
// the main program
//------------------------------------------------------
if (isset($_POST['submit']))
{	
	$std_id = ''; $std_name =''; $std_major = ''; //$rowcount ='';
	$std_id = $_POST[studentId];
	$std_name = $_POST[studentName];
	$std_major = $_POST[major];
	
	if(!($std_id == '') && !($std_name == '') && !($std_major == '')){
		if(ctype_digit($std_id)){
			
		//----- Checking if Student ID doesn't already exist --------
			$chk_query = 'SELECT * from students where studentId = ' . $std_id . '';
			echo $chk_query;
			query($chk_query, $connection);
			if(true){
//				echo 'Result is set.';
//				$rowcount = mysqli_num_rows($result);
//				if($rowcount >= 1){
					insert_student($std_id, $std_name, $std_major);
				} else{
					echo 'Student Id already exists in the DB. Please try again.';
				}
//			}else{
//				echo 'Not getting anything.';
//			}

		} else {
			echo 'Please make sure Student ID is an integer.';
		}
	} else{
		echo 'Please fill all fields to add Student.';
	}
}

?>