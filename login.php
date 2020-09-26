<?php
	include "db/conf.php";
	include "db/db.php";
	include "db/session.php";
	Session::checkLogin();
	$db = new Database();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["user_name"];
		$pass = md5($_POST["pass"]);
        $query = "SELECT * FROM empl_account WHERE `empl_user_name`='$username' and `empl_pass`='$pass'";
        $result = $db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc(); 
            Session::set("login", true);
            header("Location: index.php");
        }else{
			header("Location:login.php?msg='Wrong information! Please try again'");
		}
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LogIn</title>
		
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<form action="login.php" method="post">
			<div class="login">
			
				<h1 >Log In</h1><br><br>
				<b>User Name </b><br>
				<input class="us" type="text" name="user_name" required="1"><br>
				
				<b>Password </b><br>
				<input class="pass" type="password" name="pass" required="1"><br>
				<button type="submit" class="sub">Submit</button>
			</div>
		</form>
		<?php
			if(isset($_GET["msg"])){
				$msg = $_GET["msg"];
		?>
		<script>
			window.alert(<?php echo $msg;?>);
			window.location = "login.php";
		</script>
		<?php
			}
		?>
	</body>
</html>