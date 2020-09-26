<?php include 'header.php' ?>
<html>
<head>

<style>
table, th,td
 {
    border: 1px solid black;
}
</style>
</head>

<body>
<center>
<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbName = "db_empl"; 
  $connection = mysqli_connect($servername, $username, $password, $dbName);
  if ($connection) 
{
    echo "<br>";
  } 
else
 {
    die("Connection failed.<br>".mysqli_connect_error());
  }

  $searchKeyword = $_POST["searchKeyword"]; 
  $SQL = "SELECT * FROM `tb_client` WHERE '".$searchKeyword."' IN (coustomer_id,coustomer_name,address,contact)";
  $result = mysqli_query($connection, $SQL);
  if (!$result || mysqli_num_rows($result) > 0) 
{
 echo  "<table><tr><th>Coustomer ID&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Coustomer Name&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Address&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Contact&nbsp;&nbsp;&nbsp;&nbsp;</th></tr>";
    
   
   while($row = mysqli_fetch_assoc($result)) 
   {
  echo "<tr>";
 echo"<td>".$row['coustomer_id']."</td>";
  echo"<td>".$row['coustomer_name']."</td>";
  echo"<td>".$row['address']."</td>";
  echo"<td>".$row['contact']."</td>";
 
 
  echo "</tr>";
 echo "</table>";
  }
  } 
  else 
  {
    echo "0 Result";
  }

?>
</center>
<?php include 'footer.php' ?>
</body>

</html>
