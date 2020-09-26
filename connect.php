<?php
include("client.html");
$servername="localhost";
$username="root";
$password="";
$db_name="db_empl";
$conn=mysqli_connect($servername,$username,$password,$db_name);
if(!$conn)
{
die("Error");
}
$coustomer_id=$_POST['coustomer_id'];
$coustomer_name=$_POST['coustomer_name'];
$address=$_POST['address'];
$contact=$_POST['contact'];
$sql="INSERT INTO tb_client(coustomer_id,coustomer_name,address,contact) VALUES('$coustomer_id','$coustomer_name','$address','$contact')";
if(mysqli_query($conn,$sql))
{
echo "<p align='center'> <font color=blue  size='6pt'>New Record Inserted</font> </p>"; 
}
else
{
echo"Error";
}
?>