<?php
include("payment.html");
$servername="localhost";
$username="root";
$password="";
$db_name="db_empl";
$conn=mysqli_connect($servername,$username,$password,$db_name);
if(!$conn)
{
die("Error");
}
$payment_no=$_POST['payment_no'];
$payment_time=$_POST['payment_time'];
$p_date=$_POST['p_date'];

$sql="INSERT INTO tb_payment(payment_no,payment_time,p_date) VALUES('$payment_no','$payment_time','$p_date')";
if(mysqli_query($conn,$sql))
{
echo "<p align='center'> <font color=blue  size='6pt'>New Record Inserted</font> </p>";
}
else
{
echo"Error";
}
?>