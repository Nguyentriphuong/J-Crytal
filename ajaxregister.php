<?php 
	include('connect.php');
	// $name = isset($_POST['name']) ? $_POST['name'] : '';
	// $password = isset($_POST['password']) ? $_POST['password'] : '';
	$name = $_POST['user'];
	$password = $_POST['password'];
	
	// if (isset($_POST['submit'])) {
		# code...
		
		$name = mysqli_real_escape_string($link, $name);
		$password = mysqli_real_escape_string($link, $password);
		$password = md5($password); //ma hoa du lieu
		$sql = " SELECT * FROM  account WHERE name = '$name' AND password = '$password'";
		$query = mysqli_query($link,$sql);
		$num_row =  mysqli_num_rows($query);
		if ($num_row != 0) {
			// phần không thể tạo vì tồn tại account
			echo "Tài khoản đã tồn tại";

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
		
	// }
	
?>