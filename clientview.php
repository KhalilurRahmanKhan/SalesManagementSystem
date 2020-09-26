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
   <h1>Coustomer View</h1>


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
	$conn = new mysqli($servername, $username, $password,$dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully\n";

		$sql = "SELECT * FROM tb_client";

		$result = $conn->query($sql);
		echo"<table><tr><th>Coustomer ID</th><th>Coustomer Name</th><th>Address</th><th>Contact</th><th>Edit</th><th>Delete</th><th>Print</th></tr>";

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				// HERE EVERY TABLE DATA WILL CONTAIN DIFFRENT ID TO PRINT
				echo "<tr><td id='a".$row['coustomer_id']."'>".$row['coustomer_id']."</td><td id='b".$row['coustomer_id']."'>".$row['coustomer_name']."</td><td id='c".$row['coustomer_id']."'>".$row['address']."</td><td id='d".$row['coustomer_id']."'>".$row['contact']."</td>";

				// EDIT BUTTON CREATION
				echo "<td><form action='' method='GET'><input type='submit' name=".$row['coustomer_id']." value='Edit'></form></td>";
				// DELETE BUTTON CREATION
				echo "<td><form action='' method='GET'><input type='submit' name='delete".$row['coustomer_id']."' value='Delete'></form></td>";
				// PDF BUTTON CREATION
				echo "<td><form action='' method='GET'><input type='submit' name='print".$row['coustomer_id']."' value='Print'></form></td></tr>";

				// UPDATE CODE STARTS FROM HERE
				if(isset($_GET[$row['coustomer_id']])){
					echo"<form action='' method='POST'><div class='p' id='close'>";// CLASS P IS USED TO DECORATION AND ID CLOSE IS USED TO CLOSE THE POPUP PAGE
					echo"Update Information</br></br>";
					echo "Coustomer ID: <input type='text' name='coustomer_id' value=".$row['coustomer_id'].">";
					echo "</br></br>";
					echo "Coustomer Name: <input type='text' name='coustomer_name' value=".$row['coustomer_name'].">";
					echo "</br></br>";
					echo "Address: <input type='text' name='address' value=".$row['address'].">";
					echo "</br></br>";
					echo "Contact: <input type='text' name='contact' value=".$row['contact'].">";
					

					echo"<input type='submit' name = 'submit' value='Update'>";
					echo"<input type='submit' name = 'cancle' value='Cancle'>";
					echo "</div></form>";

					if(isset($_POST['submit'])){
						$coustomer_id = $_POST["coustomer_id"];
						$coustomer_name = $_POST["coustomer_name"];
						$address = $_POST["address"];
						$contact = $_POST["contact"];
						

						$ssql = "UPDATE tb_client SET coustomer_id='$coustomer_id', coustomer_name='$coustomer_name', address='$address', contact='$contact'
						WHERE coustomer_id=".$row['coustomer_id']."";
						
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
				if(isset($_GET['delete'.$row['coustomer_id']])){
					$delete = "DELETE FROM tb_client WHERE coustomer_id=".$row['coustomer_id']."";
					if ($conn->query($delete) === TRUE) {
					echo "<script type='text/javascript'>alert('Deleted successfully!')</script>";
					echo "<meta http-equiv='refresh' content='0'>"; // THIS IS FOR AUTO REFRESH CURRENT PAGE
					} else {
					echo "Delete Unsucessful". $conn->error;
					}
				}

				// PDF STARTS FROM HERE
				if(isset($_GET['print'.$row['coustomer_id']])){

					echo "<script>
					var mywindow = window.open('', 'PRINT', 'height=400,width=600');
					mywindow.document.write('<html><head><title>' + document.title  + '</title>');
					mywindow.document.write('</head><body >');
					mywindow.document.write('<h1>' + 'Reader Information'  + '</h1>');
					mywindow.document.write(document.getElementById('a".$row['coustomer_id']."').innerHTML);
					mywindow.document.write(' -- ');
					mywindow.document.write(document.getElementById('b".$row['coustomer_id']."').innerHTML);
					mywindow.document.write(' -- ');
					mywindow.document.write(document.getElementById('c".$row['coustomer_id']."').innerHTML);
					mywindow.document.write(' -- ');
					mywindow.document.write(document.getElementById('d".$row['coustomer_id']."').innerHTML);
					
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