<?php include 'header.php'?>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

 <div class="table"><div id="printableArea">

<?php
$conn = mysqli_Connect('localhost','root','','db_empl');
$sql = "SELECT  tb_client.coustomer_id,tb_client.coustomer_name,tb_client.address,tb_product.product_id,tb_product.quantity,tb_product.price,tb_payment.payment_no,tb_payment.payment_time,tb_payment.p_date
FROM ((tb_client
INNER JOIN tb_product ON tb_client.coustomer_id = tb_product.product_id)
INNER JOIN tb_payment ON tb_client.coustomer_id = tb_payment.payment_no);
";
$result = $conn->query($sql);


?>
<style>
table, th, td {
    border: 1px solid black; text-align: center;
}
</style>
</head>
<body style="background-image:url('')">
<table style="width:100%">
  <tr style="color:blue">
    <center style="color: blue">
      <h1>Cloth store</h1>
      <p>Address:Road-11,Shop-15,Uttara</p>
      <p>Contact: 015-------, Email: abc@gmail.com</p>
    <h3 style="color:blue;text-align: center;padding: 20px">Sales Receipt</h3>
     
      </center>
    <th>Payment no</th>
    <th>Coustomer id</th>
    <th>Coustomer name</th> 
    <th>address</th>
    <th>Product id</th>
    <th>Price</th>
    <th>Payment time</th>
    <th>Date</th>
    
  </tr>
  

<?php
while ($accused=mysqli_fetch_assoc($result)) 
{
  echo "<tr>";
  echo"<td>".$accused['payment_no']."</td>";
  echo"<td>".$accused['coustomer_id']."</td>";
  echo"<td>".$accused['coustomer_name']."</td>";
  echo"<td>".$accused['address']."</td>";
  echo"<td>".$accused['product_id']."</td>";
  echo"<td>".$accused['price']."</td>";
  echo"<td>".$accused['payment_time']."</td>";
  echo"<td>".$accused['p_date']."</td>";
  
  echo "</tr>";
  }
?>
</table>
<center>
 <p style="color:blue;text-align: right;  padding: 40px">-------------------------<br>Manager signature</p>
<img src="t.jpg" style="width:225px;height:45px;"></center>

<input type="button" onclick="printDiv('printableArea')" value="PRINT" />

<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}</script><br>

<?php include 'footer.php'?>