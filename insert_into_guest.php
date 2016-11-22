<?php

//connect to Database
function connect_db ()
{
   $username="root";    // change to your mysql username
   $password="root";  // change to your mysql password
   $dbname ="dbhw5";     // change to your mysql username
   $servername ="localhost";     

   //create the connection
   $connection = mysqli_connect($servername, $username, $password, $dbname);
	if(!$connection)
	  die("Connection failed: " . $connection->connect_error);
   else
	  return $connection;
}

function print_table($result)
{
   echo '<table>';
   $first_row = true;
   while ($row = mysqli_fetch_assoc($result)) 
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

// execute a query and print the results
function query($q, $connection) 
{
   $result = $connection->query($q);
   echo '<br>---------------------------------<br>';
   echo 'Query: <br>' . $q . '<br><br>Result: ';
   print_table($result);
}

// the top level function
function show_student()
{
   // Connect to the database
   
   echo 'in function';
   $connection = connect_db();
   echo '<br> Table students: ';
   $query = 'SELECT * from students';
   query($query, $connection);
}


//------------------------------------------------------
// the main program
//------------------------------------------------------
if (isset($_POST['submit'])) 
{
   
   //Printing out the variable names!
   //echo 'Student name is: ' . $_POST['studentName'];
   
   show_student();

}
?>