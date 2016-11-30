<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php

//------ Setting up Connection --------
	$host =	"localhost";
	$username = "root";
	$db = "dbhw5";
	$password = "root";
	$connection = mysqli_connect($host, $username, $password, $db);
	
//------ Checking if connection was successful ---------
	if(!$connection){
		die('Not Connected: '.mysql_error());
	}

//------- Getting User inputs ----------	
	$s_name = $_POST["std_name"];	
	$s_major = $_POST["std_major"];
	$s_ID = $_POST["std_id"];
	
//------ Query to add NEW Student to the Students' Table ---------
	$query = "INSERT INTO Students VALUES('$s_ID', '$s_name', '$s_major')";
	
//----- Making sure all information was entered ---------	
	if((isset($s_ID)) && (isset($s_name)) &&(isset($s_major))){
	
		//------ Checking if Student ID already exists -----
		$check = "SELECT * FROM Students WHERE StudentID = '$s_ID'";
		$result_id = mysqli_query($connection, $check);
	
		if($data = msqli_fetch_array($result_id, MYSQLI_NUM)){
			$redirect = sprintf("http://localhost/AddStudents.php");
			$message = "Student ID already exists! Try Again!";
			echo "<script type = 'text/javascript'>
					alert('$message');
				</script>";
			mysqli_close($connection);
			echo "<script type = 'text/javascript'>
					window.location.href='$redirect'
				</script>";
		
		} else {
			$f_result = mysqli_query($connection, $query);
			if(isset($f_result){
				$s_messg = "New Student has been added to Students' Table";
				$h_redirect = "http://localhost//homepage.html";
				echo "<script type = 'text/javascript'>
							alert('$s_messg');
					  </script>";
				mysqli_close($connection);
							echo "<script type = 'text/javascript'>
					window.location.href='$h_redirect'
				</script>";
			} else{
				echo "Something went wrong. Please try again!";
			}
		}
	}
?>	
<body>
<h1 align="center"><i><b> Adding New Student to DB </i></b></h1>
<div class="container" align="center">
	<form action="AddStudents.php" method="post" onsubmit="true">
		Student ID:
		<input type="text" name="std_id" id="ufname" value=""><br>
		Student Name:
		<input type="text" name="std_name" id="ulname" value=""><br>
		Student Major: 
		<input type="text" name="std_major" id="uname" value=""><br>
		
	<input type="submit" value="Register">
	</form>
</div>
	
</body>
</html>	
