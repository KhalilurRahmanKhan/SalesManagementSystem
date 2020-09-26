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
  $SQL = "SELECT * FROM `tb_product` WHERE '".$searchKeyword."' IN (product_id,product_type,quantity,price)";
  $result = mysqli_query($connection, $SQL);
  if (!$result || mysqli_num_rows($result) > 0) 
{
 echo  "<table><tr><th>Product ID&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Product Name&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Quantity&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Price&nbsp;&nbsp;&nbsp;&nbsp;</th></tr>";
    
   
   while($row = mysqli_fetch_assoc($result)) 
   {
  echo "<tr>";
 echo"<td>".$row['product_id']."</td>";
  echo"<td>".$row['product_type']."</td>";
  echo"<td>".$row['quantity']."</td>";
  echo"<td>".$row['price']."</td>";
 
 
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
