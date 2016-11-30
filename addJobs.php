<!DOCTYPE html>
<html>
	<head>
		<title>DB HW 5</title>
	</head>
	<body>

		<h1>Add Job</h1>
			<form action="addJobs.php" method="post">
				JobId:<br>
					<!-- Need to make sure data meet the requirements
						to be entered into the table 
						* JavaScript function? -->
				<input type="text" name="jobId"><br>
				Company Name:<br>
					<!-- Make sure it isn't blank-->
				<input type="text" name="CompanyName"><br>
				Job Title:<br>
					<!-- Make sure it isn't blank-->
				<input type="text" name="jobTitle"><br><br>
				Salary:<br>
					<!-- Make sure it isn't blank-->
				<input type="text" name="salary"><br><br>
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
function insert_job ($Jid, $Cname, $Jtitle, $salary)
{
	// Connect to the database
	$connection = connect_db();
	 
	// Display contents of table Guest before insert
	echo '<br> Table Jobs before: ';
	$query = 'SELECT * from jobs';
	query($query, $connection);
	echo '<br>';
	
	
	// Insert the guest (add quotes around name and address fields
	$values = $Jid . ', \'' . $Cname . '\', \'' . $Jtitle . '\', \'' . $salary . '\'';
	echo 'Company Name: ' . $Cname . ',     Job Title: ' . $Jtitle . 'Salary: ' . $salary . '<br>' . 'VALUES: ';
	echo $values . '<br>';
	 
	insert("jobs", $values, $connection);

	// Display contents of table Guest after insert
	echo '<br> Table Jobs afer: ';
	$query = 'SELECT * from jobs';
	query($query, $connection);
}

//------------------------------------------------------
// the main program
//------------------------------------------------------
if (isset($_POST['submit']))
{
	$jb_id = ''; $comp_name =''; $jb_title = ''; $sal = '';
	$jb_id = $_POST[jobId];
	$comp_name = $_POST[CompanyName];
	$jb_title = $_POST[jobTitle];
	$sal = $_POST[salary];
	if(!($jb_id == '') && !($comp_name == '') && !($jb_title == '') && !($sal == '')){
		if((ctype_digit($jb_id)) && (ctype_digit($sal))){
			insert_job($jb_id, $comp_name, $jb_title, $sal);
		} else{
			echo 'Please make sure either JobId and Salary are intergers.';
		}
	} else{
		echo 'Please fill all fields to Add New Job.';
	}
	
}

?>