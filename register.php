<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	<div class="login-box">
		<form action="" method="POST">
			<h1>Register Here</h1>
			<div class="textbox">
				<i class="fa fa-user" aria-hidden = "true"></i>
				<input type="text" placeholder="Username or Email" name= "name" >
			</div>
			<div class="textbox" >
				<i class="fa fa-lock" aria-hidden = "true"></i>
				<input type="password" placeholder="Password" name= "password" >
			</div>
			<div class="textbox" >
				<i class="fa fa-repeat" aria-hidden="true" id="re_p"></i>
				<input type="password" placeholder="Re-enter Password" name= "repassword" >
			</div>
			<div class="textbox" >
				<i class="fa fa-ticket" aria-hidden="true"></i>
				<input type="password" placeholder="Active Code" name= "repassword" >
			</div>

			<input class="btn" type="submit" name="submit" value="Sign in">
			<span id="w_mk2" style="display: none;">Tài khoản đã tồn tại</span>
		</form>
		
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
		$num_row =  mysqli_num_rows($query);
		if ($num_row != 0) {
			// phần không thể tạo vì tồn tại account
			echo "<script>";   
			echo "document.getElementById('w_mk2').style.display='';";
			echo "</script>";

		}
		
		else 
		{	
			// phần có thể đăng ký
			echo "<script>";   
			echo "document.getElementById('w_mk2').style.display='none';";
			echo "</script>";
			//
			$s = "SELECT * FROM cuu_sv ORDER BY student_id DESC LIMIT 1";
			$q1 = mysqli_query($link,$s);
			$r = mysqli_fetch_array ($q1);
			$stt1 = $r['student_id'] + 1;
			echo "$stt1";
			$sql1 = "INSERT INTO cuu_sv(student_id) VALUES ('$stt1')";
			$query1 = mysqli_query($link,$sql1);
			//
			$s = "SELECT * FROM account ORDER BY id DESC LIMIT 1";
			$q1 = mysqli_query($link,$s);
			$r = mysqli_fetch_array ($q1);
			$stt2 = $r['student_id'] + 1;
			$sql2 = "INSERT INTO account(id,name,password,student_id,active) VALUES ('$stt2','$name', '$password','$stt1','1');";
			$query2 = mysqli_query($link,$sql2);
			//
			echo "<script>";
			echo 'myWindow = window.open("index.php", "_self");';
			echo "</script>";
		}
		
	}
	
	?>
</body>
</html>
