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
   $SQL = "SELECT * FROM `tb_payment` WHERE '".$searchKeyword."' IN (payment_no,payment_time,p_date)";
  $result = mysqli_query($connection, $SQL);
  if (!$result || mysqli_num_rows($result) > 0) 
{
 echo  "<table><tr><th>Payment no&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Payment Time&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Payment Date&nbsp;&nbsp;&nbsp;&nbsp;</th></tr>";
    
   
   while($row = mysqli_fetch_assoc($result)) 
   {
  echo "<tr>";
 echo"<td>".$row['payment_no']."</td>";
  echo"<td>".$row['payment_time']."</td>";
  echo"<td>".$row['p_date']."</td>";

 
 
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
