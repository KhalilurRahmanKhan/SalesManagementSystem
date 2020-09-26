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
   <h1>Product View</h1>


<style>
// THIS STYLE IS IMPORTANT FOR POPUP UPDATE PAGE 
	.p{
	background: #f5f3f3;
	z-index: 9999;
	height: 300px;
	width: 400px;
	position: absolute;
	margin-left: 20%;
	margin-top: -60px;
	padding-bottom: 35px;
	border: 1px dotted green;
	padding-top: 15px;
}
</style>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db_empl";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully\n";

		$sql = "SELECT * FROM tb_product";

		$result = $conn->query($sql);
		echo"<table><tr><th>Product Id</th><th>Product Type</th><th>Quantity</th><th>Price</th><th>Edit</th><th>Delete</th><th>Print</th></tr>";

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				// HERE EVERY TABLE DATA WILL CONTAIN DIFFRENT ID TO PRINT
				echo "<tr><td id='a".$row['product_id']."'>".$row['product_id']."</td><td id='b".$row['product_id']."'>".$row['product_type']."</td><td id='c".$row['product_id']."'>".$row['quantity']."</td><td id='d".$row['product_id']."'>".$row['price']."</td>";

				// EDIT BUTTON CREATION
				echo "<td><form action='' method='GET'><input type='submit' name=".$row['product_id']." value='Edit'></form></td>";
				// DELETE BUTTON CREATION
				echo "<td><form action='' method='GET'><input type='submit' name='delete".$row['product_id']."' value='Delete'></form></td>";
				// PDF BUTTON CREATION
				echo "<td><form action='' method='GET'><input type='submit' name='print".$row['product_id']."' value='Print'></form></td></tr>";

				// UPDATE CODE STARTS FROM HERE
				if(isset($_GET[$row['product_id']])){
					echo"<form action='' method='POST'><div class='p' id='close'>";// CLASS P IS USED TO DECORATION AND ID CLOSE IS USED TO CLOSE THE POPUP PAGE
					echo"Update Information</br></br>";
					echo "Product Id: <input type='text' name='product_id' value=".$row['product_id'].">";
					echo "</br></br>";
					echo "Product type: <input type='text' name='product_type' value=".$row['product_type'].">";
					echo "</br></br>";
					echo "Quantity: <input type='text' name='quantity' value=".$row['quantity'].">";
					echo "</br></br>";
					echo "Price: <input type='text' name='price' value=".$row['price'].">";
					

					echo"<input type='submit' name = 'submit' value='Update'>";
					echo"<input type='submit' name = 'cancle' value='Cancle'>";
					echo "</div></form>";

					if(isset($_POST['submit'])){
						$product_id = $_POST["product_id"];
						$product_type = $_POST["product_type"];
						$quantity = $_POST["quantity"];
						$price= $_POST["price"];
						

						$ssql = "UPDATE tb_product SET product_id='$product_id', product_type='$product_type', quantity='$quantity', price='$price'
						WHERE product_id=".$row['product_id']."";
						
						if ($conn->query($ssql) === TRUE) {
						echo "<script type='text/javascript'>alert('Submitted successfully!')</script>";
						} else {
						echo "Upadate Unsucessful". $conn->error;
						}

					}
					if(isset($_POST['cancle'])){
						echo "<script>document.getElementById('close').style.display='none'</script>";
					}
				}

				// DELETE CODE STARTS FORM HERE
				if(isset($_GET['delete'.$row['product_id']])){
					$delete = "DELETE FROM tb_product WHERE product_id=".$row['product_id']."";
					if ($conn->query($delete) === TRUE) {
					echo "<script type='text/javascript'>alert('Deleted successfully!')</script>";
					echo "<meta http-equiv='refresh' content='0'>"; // THIS IS FOR AUTO REFRESH CURRENT PAGE
					} else {
					echo "Delete Unsucessful". $conn->error;
					}
				}

				// PDF STARTS FROM HERE
				if(isset($_GET['print'.$row['product_id']])){

					echo "<script>
					var mywindow = window.open('', 'PRINT', 'height=400,width=600');
					mywindow.document.write('<html><head><title>' + document.title  + '</title>');
					mywindow.document.write('</head><body >');
					mywindow.document.write('<h1>' + 'Reader Information'  + '</h1>');
					mywindow.document.write(document.getElementById('a".$row['product_id']."').innerHTML);
					mywindow.document.write(' -- ');
					mywindow.document.write(document.getElementById('b".$row['product_id']."').innerHTML);
					mywindow.document.write(' -- ');
					mywindow.document.write(document.getElementById('c".$row['product_id']."').innerHTML);
					mywindow.document.write(' -- ');
					mywindow.document.write(document.getElementById('d".$row['product_id']."').innerHTML);
					
					mywindow.document.write('</body></html>');
					mywindow.document.close(); // necessary for IE >= 10
					mywindow.focus(); // necessary for IE >= 10*/

					mywindow.print();
					mywindow.close();
					history.back(); // IT WILL TAKE YOU BAKE PAGE
					</script>";
				}





			}echo"</table>";
		}else{
				echo "No search found!!!";
		}
	$conn->close();
	 ?>
</center> 

<?php include 'footer.php' ?>
</body>
</html>