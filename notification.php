<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>J Crytal</title>
	<!-- <link rel="stylesheet" href="css/style.css"> -->
	<!-- <link rel="stylesheet" href="css/card.css"> -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
	<script src="js/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
	<style>
	@import "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";
	body {
	    position: relative;
	    width: 100%;
	    height: 100%;
	    /*border: 3px #216509 solid;*/
	    /* float: right; */
	    position: absolute;
	    margin-top: 10px;
	    background: #e5e4e4;
	    /* left: 50px; */
	    /* border-radius: 20px; */
	}
	div#newnote {
	    position: relative;
	    margin-top: 60px;
	    width: 550px;
	    left: 20px;
	    top: 20px;
	    display: flex;
	    background: white;
	    border-radius: 20px;
	}
	div#note {
	    /*position: absolute;*/
	}
	#newnote input[type=submit] {
	    padding:5px 15px; 
	    background:#ccc; 
	    border:0 none;
	    cursor:pointer;
	    background: blue;
   		border-radius: 3px;
	}
	#main input[type=submit]{
		background: black;
		padding:5px 15px; 
	    color: white;
	    /*display: none;*/
	    border:0 none;
	    cursor:pointer;
   		border-radius: 3px;
	}
	input[type="button"] {
	    border: none;
	    color: white;
	    background: black;
	    padding: 8px 458px 8px 6px;
	}
	.delete{
		float: right;
	}
	.the{
		/* position: absolute;
		float: right; */
		display: block;
	    float: right;
	    width: 30%;
	    background: antiquewhite;
	    margin-top: 10px;
	    margin-bottom: 10px;
	    margin-right: 10px;
	    border: 1px #216509 solid;
	    padding: 8px;
	    border-radius: 0px 0px 0px 20px;
	}
	.textbox {
	    width: 500px;
	    overflow: hidden;
	    font-size: 20px;
	    padding: 8px 0px;
	    margin: 8px 20px;
	    left: 20px;
	    /* margin-left: 20px; */
	    border-bottom: 1px solid #89d0ea;
	}
	#note input[type=text],#note textarea{
		outline: none;
	    border: none;
	    cursor:pointer;
	}
	#main {
	    width: 100%;
	    position: relative;
	    margin-top: 60px;
	    margin-bottom: 20px;
	    height: 100%;
	    float: left;
	    left: 20px;
	}
	.list-std {
	    clear: both;
	    /* top: 200px; */
	    margin-top: 20px;
	    padding-left: 100px;
	    width: 100%;
	    /* position: absolute; */
	}

	#main table {
		width: 90%;
	}
	#main table, td, th{
		font-family: arial;
		border-collapse: collapse;
		border-bottom: 3px solid #11b35c;
		text-align: center;
		padding: 8px;
	}
	.nav {
		position: absolute;
		top: 5%;
		right: 10%;
	}

	.nav ul li{
		list-style-type:  none;
		display: inline-block;
		color: white;
		font-family: Raleway;
		padding: 10px 50px;
	}

	.active {
		background: red;
		border-radius: 4px;

	}

	.active:hover,.active input[type="submit"]:hover {
	    color: #cbfccb;
	    background: #f81212;
	}
	.new {
	    position: absolute;
	}
	.active a{
		text-decoration: none;
		color: white;
	}
	.active input[type="submit"] {
	    border: none;
	    color: white;
	    background: red;
	}
	td.tde {
	    border-bottom: none;
	    text-align: left;
	}
	td.nd {
	    border-top: none;
	    text-align: left;
	}

		 
	</style>

</head>
<body>

	<?php 
	include('connect.php');
	?>
	<!-- <div class="wrapper"> -->
		<div class="nav">
			<ul id="Login" >
				<li class="Home" style="color: #216509;">
					Home <i class="fa fa-home" aria-hidden="true"></i>
				</li>
				<li class="active">

				<form action="" method="post">
					<input type="submit" name="logout" value="Log out">
				</form>
				</li>
				
			</ul>
		</div>
	<div id="note">
		<div id="newnote">
		<!-- <div class="new">
			<input type="button" value="Thông báo mới">
			<p>Thông báo mới</p>
		</div> -->
		<div id="forms">
			
		
			<form action="" method="POST">
				
				<div class="textbox">
					<input type="text" id="tieude" name="tieude" placeholder="   Tiêu đề"><br>
				</div>
				<div class="textbox" >
					<!-- <textarea name="noidung" id="noidung"  placeholder="   Nội dung"></textarea><br> -->
					<input type="text" id="noidung" name="noidung" placeholder="   Nội dung" ><br>
				</div>
				<div>
					<input type="submit" name="ThongBao" id="thongbao" value="POST">
				</div>
				

			</form>	
		</div></div>
		
	</div>	
	<div id="main">
		<?php 
			$i = 1;
		    $sql1 = "SELECT * FROM thongbao ORDER by id_tb DESC limit 10" ;
			$rel = mysqli_query($link, $sql1);
			echo "<form action='' method='post'>";
			
		    while ($row = mysqli_fetch_array ($rel)){
		    	$id_tb = $row["id_tb"];
		    	echo "<table>";
		    	echo "<tr><td rowspan='2' style='width: 15%;' >$i</td><td class = 'tde' style='width: 70%;'><b>{$row['tieude']}</b></td>
		    			<td rowspan='2'  style='width: 15%;'><input type='submit'  name='Xoa' value='Xóa ".$id_tb."' >
		    			</td></tr>";
		    	echo "<tr><td class = 'nd'>{$row['noidung']}</td></tr>";
		    	$i++;
		    	echo "</table>";
		    };
		    
		    echo "</form>";
		?>

		<!-- <table>
			<?php  ?>
		</table> -->
	</div> 	
	
	<?php 
	$i = 1;
	$tieude = (isset($_POST['tieude'])) ? $_POST['tieude'] : '' ;
	$noidung = (isset($_POST['noidung'])) ? $_POST['noidung'] : '' ;
	$s = "SELECT MAX(id_tb) AS sum FROM thongbao";
	$q = mysqli_query($link,$s);
	$r = mysqli_fetch_array ($q);
	$i = $r['sum'] + $i;

	if (isset($_POST['ThongBao'])) {

		if ($tieude != '' && $noidung != '') {
			# code...
			$sql = "INSERT INTO thongbao (tieude, noidung, id_tb, lastupdate) VALUES ('$tieude', '$noidung', '$i', CURRENT_TIMESTAMP)";
			$query = mysqli_query($link,$sql);
			$sql1  = "UPDATE cuu_sv SET message = '1' WHERE cuu_sv.student_id != 0";
			$query1 = mysqli_query($link,$sql1);
			echo "<script>";   
			echo 'myWindow = window.open("notification.php", "_self");';
			echo "</script>";

		}	

	}
	if (isset($_POST['Xoa'])) {
		echo "co chay k da";
		$string1= $_POST['Xoa'];
		$string2 = substr( $string1, 5, strlen($string1) );
		$string2 = (int)$string2;

		$sql = "DELETE FROM thongbao WHERE id_tb=$string2";

		$query = mysqli_query($link,$sql);
		$sql2 = "UPDATE thongbao SET id_tb = (id_tb-1) WHERE thongbao.id_tb > $string2";
		$query2 = mysqli_query($link,$sql2);
		echo "<script>";   
		echo 'myWindow = window.open("notification.php", "_self");';
		echo "</script>";
	}

	
	?>
	<?php
		if (isset($_POST['logout'])) { 
			$sql = "UPDATE account SET active = '0' WHERE account.active = '1'";
			$query = mysqli_query($link,$sql);
			echo "<script>";   
			echo 'myWindow = window.open("index.php", "_self");';
			echo "</script>";
		}
	?>

<script>

	function over(argument) {

		document.getElementById(argument).style.display ='inline';
	}
	function out(argument){
		document.getElementById(argument).style.display ='none';
	}
</script>
</body>
</html>