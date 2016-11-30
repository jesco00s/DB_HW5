<?php

//connect to Database
function connect_db()
{
   $username="root";    
   $password="root";  	
   $dbname ="dbhw5";     
   $servername ="localhost";     

   //create the connection
   $connection = mysqli_connect($servername, $username, $password, $dbname);
	if(!$connection)
	  die("Connection failed: " . $connection->connect_error);
   else
	  return $connection;
}

// Insert into any table, any values from data passed in as String parameters
function insert($table, $values, $connection)
{
	$query = 'INSERT into ' . $table . ' values (' . $values . ')' ;
	$result = $connection->query($query);
}

function print_table($result)
{
   echo '<table>';
   $first_row = true;
   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
   {
      if ($first_row) 
      {
         $first_row = false;

         // Output header row from keys.
         echo '<tr>';
         foreach($row as $key => $field) 
             echo '<th>' . $key . '</th>';
         echo '</tr>';
      }

      echo '<tr>';
      foreach($row as $key => $field) 
         echo '<td>' . $field . '</td>';

   echo '</tr>';
   }
   echo '</table>';
}

function init_db($connection)
{
	$result = $connection->query("DELETE from students");
	$result = $connection->query("DELETE from jobs");
	$result = $connection->query("DELETE from applications");

	insert("students", "1, 'Jose Escobar', 'Computer Engineering'", $connection);
	insert("students", "2, 'Fabian Monasterio', 'Computer Science'", $connection);
	insert("students", "3, 'Omar Zambrano', 'Computer Science'", $connection);
	
	insert("jobs", "1, 'Walmart', 'Software Programmer'", $connection);
	insert("jobs", "2, 'Toyota', 'Mechanical Engineer'", $connection);
	insert("jobs", "3, 'General Electric', 'Electrical Engineer'", $connection);
	
	insert("applications", "1, 1", $connection);
	insert("applications", "2, 3", $connection);
}

// execute a query and print the results
function query($q, $connection) 
{
   $result = $connection->query($q);
   echo '<br>---------------------------------<br>';
   echo 'Query: <br>' . $q . '<br><br>Result: ';
   print_table($result);
}


?>