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
   <h1>Payment View</h1>


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

		$sql = "SELECT * FROM tb_payment";

		$result = $conn->query($sql);
		echo"<table><tr><th>Payment no</th><th>Payment time</th><th>Payment Date</th><th>Edit</th><th>Delete</th><th>Print</th></tr>";

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				// HERE EVERY TABLE DATA WILL CONTAIN DIFFRENT ID TO PRINT
				echo "<tr><td id='a".$row['payment_no']."'>".$row['payment_no']."</td><td id='b".$row['payment_no']."'>".$row['payment_time']."</td><td id='c".$row['payment_no']."'>".$row['p_date']."</td>";

				// EDIT BUTTON CREATION
				echo "<td><form action='' method='GET'><input type='submit' name=".$row['payment_no']." value='Edit'></form></td>";
				// DELETE BUTTON CREATION
				echo "<td><form action='' method='GET'><input type='submit' name='delete".$row['payment_no']."' value='Delete'></form></td>";
				// PDF BUTTON CREATION
				echo "<td><form action='' method='GET'><input type='submit' name='print".$row['payment_no']."' value='Print'></form></td></tr>";

				// UPDATE CODE STARTS FROM HERE
				if(isset($_GET[$row['payment_no']])){
					echo"<form action='' method='POST'><div class='p' id='close'>";// CLASS P IS USED TO DECORATION AND ID CLOSE IS USED TO CLOSE THE POPUP PAGE
					echo"Update Information</br></br>";
					echo "Payment no: <input type='text' name='payment_no' value=".$row['payment_no'].">";
					echo "</br></br>";
					echo "Payment time: <input type='time' name='payment_time' value=".$row['payment_time'].">";
					echo "</br></br>";
					echo "Payment Date: <input type='date' name='p_date' value=".$row['p_date'].">";
					echo "</br></br>";
					
					

					echo"<input type='submit' name = 'submit' value='Update'>";
					echo"<input type='submit' name = 'cancle' value='Cancle'>";
					echo "</div></form>";

					if(isset($_POST['submit'])){
						$payment_no = $_POST["payment_no"];
						$payment_time = $_POST["payment_time"];
						$p_date = $_POST["p_date"];
						
						

						$ssql = "UPDATE tb_payment SET payment_no='$payment_no', payment_time='$payment_time, p_date='$p_date'
						WHERE payment_no=".$row['payment_no']."";
						
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
				if(isset($_GET['delete'.$row['payment_no']])){
					$delete = "DELETE FROM tb_payment WHERE payment_no=".$row['payment_no']."";
					if ($conn->query($delete) === TRUE) {
					echo "<script type='text/javascript'>alert('Deleted successfully!')</script>";
					echo "<meta http-equiv='refresh' content='0'>"; // THIS IS FOR AUTO REFRESH CURRENT PAGE
					} else {
					echo "Delete Unsucessful". $conn->error;
					}
				}

				// PDF STARTS FROM HERE
				if(isset($_GET['print'.$row['payment_no']])){

					echo "<script>
					var mywindow = window.open('', 'PRINT', 'height=400,width=600');
					mywindow.document.write('<html><head><title>' + document.title  + '</title>');
					mywindow.document.write('</head><body >');
					mywindow.document.write('<h1>' + 'Reader Information'  + '</h1>');
					mywindow.document.write(document.getElementById('a".$row['payment_no']."').innerHTML);
					mywindow.document.write(' -- ');
					mywindow.document.write(document.getElementById('b".$row['payment_no']."').innerHTML);
					mywindow.document.write(' -- ');
					mywindow.document.write(document.getElementById('c".$row['payment_no']."').innerHTML);
					mywindow.document.write(' -- ');
					
					
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