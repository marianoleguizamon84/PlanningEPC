<h2>UA Planning FC DB test</h2>
<?php

$hostname = "localhost"; 
$username = "PlannFC_QAUser";
$password = "UAplanningfc.125";
$dbname = "planningfc_qa_db";

//connection to the database server
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to DB server");
echo "Connected to DB <b>$dbname</b><br>";
?>

<?php
//select a database to work with
$selected = mysql_select_db($dbname, $dbhandle) 
  or die("Could not select DB");
?>

<?php
//execute the SQL query and return records
$result = mysql_query("SELECT * FROM mrbs_users");
//fetch tha data from the database
while ($row = mysql_fetch_array($result)) {
   echo "ID: ".$row{'name'}." Domain: ".$row{'email'}."<br>";
}
?>


<?php
//close the connection
mysql_close($dbhandle);
?>

<?php phpinfo(); ?>
