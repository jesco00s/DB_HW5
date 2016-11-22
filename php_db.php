<? php

//connect to Database
function connect_db ()
{
   $username="root";    // change to your mysql username
   $password="root";  // change to your mysql password
   $dbname ="dbhw5";     // change to your mysql username
   $servername ="localhost";     

   //create the connection
   $connection = new mysqli($servername, $username, $password, $dbname);	
   if ($connection->connect_error) 
	  die("Connection failed: " . $connection->connect_error);
   else
	  return $connection;
}

function prove(){
	echo 'made it to the other file';
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
?>