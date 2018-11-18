<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	<div class="login-box">
		<form action="" method="POST">
			<h1>Login Here</h1>
			<div class="textbox">
				<i class="fa fa-user" aria-hidden = "true"></i>
				<input type="text" placeholder="Username or Email" name= "name" >
			</div>
			<div class="textbox" >
				<i class="fa fa-lock" aria-hidden = "true"></i>
				<input type="password" placeholder="Password" name= "password" >
			</div>

			<input class="btn" type="submit" name="submit" value="Sign up">
		</form>
		<br>
		<span id="w_mk" style="display: none;">Tên hoặc mât khẩu không đúng</span>
		<p> Or <a href="register.php">Create New Account</a></p>
	</div>
	<?php  
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	include('connect.php');
	if (isset($_POST['submit'])) {
		# code...
		$name = mysqli_real_escape_string($link, $name);
		$password = mysqli_real_escape_string($link, $password);
		$password = md5($password); //ma hoa du lieu
		$sql = " SELECT * FROM  account WHERE name = '$name' AND password = '$password'";
		$query = mysqli_query($link,$sql);
		$r = mysqli_fetch_array ($query);
		$account_id =  $r['id'];
		$num_row =  mysqli_num_rows($query);
		if ($num_row != 0) {
			//echo "Bạn đăng nhập thành công $num_row";
			$q = mysqli_query($link,"UPDATE account SET active = '1' WHERE account.id = '$account_id'");
			echo "<script>"; 
			echo 'myWindow = window.open("index.php", "_self");';
			echo "</script>";

		}
		
		else 
		{	
			echo "<script>";   
			echo "document.getElementById('w_mk').style.display='';";
			echo "</script>";
		}
	}
	?>
</body>
</html>