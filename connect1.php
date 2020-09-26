<?php
include("product.html");
$servername="localhost";
$username="root";
$password="";
$db_name="db_empl";
$conn=mysqli_connect($servername,$username,$password,$db_name);
if(!$conn)
{
die("Error");
}
$product_id=$_POST['product_id'];
$product_type=$_POST['product_type'];
$quantity=$_POST['quantity'];
$price=$_POST['price'];
$sql="INSERT INTO tb_product(product_id,product_type,price,quantity) VALUES('$product_id','$product_type','$price','$quantity')";
if(mysqli_query($conn,$sql))
{
echo "<p align='center'> <font color=blue  size='6pt'>New Record Inserted</font> </p>";
}
else
{
echo"Error";
}
?>