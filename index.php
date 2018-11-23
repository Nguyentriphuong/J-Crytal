<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>J Crytal</title>
	<link rel="stylesheet" href="css/style.css">
	<!-- <link rel="stylesheet" href="css/card.css"> -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
	<script src="js/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>

</head>
<body>
	<?php 
	include('connect.php');
	

	 ?>
	<div class="wrapper">
		<div class="nav">
			<ul id="Login" style="display: none;">
				<li class="myprofile">
					My Profile
				</li>
				<li>
				Class	
				</li>
				<li>
					<a  href="#tb">List Member</a>
				</li>
				<li>
					<a  href="#chart">Chart</a>
				</li>
				<li>
				Notification	
				</li>
				<li class="active" >

				<form action="" method="post">
					<input type="submit" name="logout" value="Log out">
				</form>
				</li>
				
			</ul>
			<ul id="unlogin" style="display: ">
				<li><a  href="#tb">List Member</a></li>
				<li><a  href="#chart">Chart</a></li>
				<li class="active" >
				<!-- <a href="login.php" >Login</a> -->	
				Login
				</li>
			</ul>
		</div>
		
		<div class="header">
			<h1><span>J</span> Crytal</h1>
		</div >
		<div class="tagline">
			<p>WEBSITE quản lý thông tin sau khi ra trường <br>về thông tin lý lịch, đợn vị công tác,... cho cựu sinh viên Đại học Công nghệ  </p>
		</div>
		<div class="down">
			<img src="img/down-arrow.png" alt="No_Img">
		</div>
	</div>


	<div id="tb">
		<!-- <form action="#"> -->
		<h2 align= "center">Danh sách sinh viên các khóa</h2>
		<div class="boxsearch">
		<form action="" method="post">
			<i class="fa fa-search" aria-hidden="true" onclick="getsearch()"></i>
			<input type="submit" name="timkiem" id="timkiem" value="Search" style="display: none;">
			<input type="text" id="search" name="search" placeholder="Search name" style="width: 2%">
		</form>
			<!-- onfocus="getfocus(this)" onblur="outfocus(this)" -->
		</div>
		<?php
			if (isset($_POST['timkiem'])) { 
				$tk = $_POST['search'];
			}
		?>
		<div class=" list-std">
			<table>
				<tr>
					<th>Stt</th>
					<th>Họ và Tên</th>
					<th>Niên khóa</th>
					<th>Lớp </th>
					<th>Email</th>
					<th>Profile</th>
				</tr>
				<?php
				$ci = 1;
				$retVal = isset($tk) ? ' AND sv.name LIKE "%'.$tk.'%"' : '' ;
				$kq = mysqli_query ($link,"SELECT sv.student_id, sv.name, l.class_name,k.course_name, sv.Email  FROM cuu_sv sv
									INNER JOIN lop l ON sv.class_id = l.class_id
									INNER JOIN khoa k ON l.course_id = k.course_id
									WHERE sv.student_id != 1 $retVal
									ORDER BY sv.student_id ASC");
				while ($r = mysqli_fetch_array ($kq)) {
					echo "<tr>";
					
					echo "<td>$ci</td>";
					echo "<td>{$r['name']}</td>";
					echo "<td>{$r['class_name']}</td>";
					echo "<td>{$r['course_name']}</td>";
					echo "<td>{$r['Email']}</td>";
					echo "<td><i class='fa fa-file' aria-hidden='true' id='file' onclick='clickfile($ci)'></td>";

					echo "</tr>";
					$ci++;
				}

				?>
			</table>
		</div> 
		<!-- </form> -->
	</div>
	
	<div id="card" style="display:none;">
	
        <div id="main"></div>
		
	</div>

	<div id="chart" >
		<div id="menu_chart" style="overflow: auto; height: 300px; width: 300px;" >
			<h3><i class="fa fa-chevron-right" id="faright" aria-hidden="true" style="display: none;"></i><i class="fa fa-chevron-down" id="fadown" aria-hidden="true"></i> Biểu đồ </h3>
			<div class="ndbd" style="display: none;">
				<ul>
					<li id="chart1" onmouseover="mouseOver(this)" onmouseout="mouseOut(this)">&raquo;&nbsp;Trung bình lương theo khóa</li>
					<li id="chart2" onmouseover="mouseOver(this)" onmouseout="mouseOut(this)">&raquo;&nbsp;Trung bình lương theo lớp</li>
					<li id="chart3" onmouseover="mouseOver(this)" onmouseout="mouseOut(this)">&raquo;&nbsp;Phần trăm làm đúng công việc</li>
					<li id="chart4" onmouseover="mouseOver(this)" onmouseout="mouseOut(this)">&raquo;&nbsp;Phần trăm theo nơi làm viêc</li>
				</ul>
			</div>
			
		</div>
		<h2 align= "center">Biểu đồ, thống kê cựu sinh viên các khóa</h2>
		<div id="Ch">
			<canvas id="myC1"></canvas>
			<canvas id="myC2"></canvas>
			<canvas id="myC3"></canvas>
			<canvas id="myC4"></canvas>
		</div>
	</div>
	<div class="back-to-top"><i class="fa fa-chevron-up"></i></div>
	




	<?php
		if (isset($_POST['logout'])) { 
			$sql = "UPDATE account SET active = '0' WHERE account.active = '1'";
			$query = mysqli_query($link,$sql);
		}
		 ?>
	<?php 
		$n = mysqli_query ($link,"select * from account where active ='1'");
		$m = mysqli_fetch_array ($n);
		if ($m['active']) {
			echo "<script>"; 
			echo "document.getElementById('Login').style.display='';";
			echo "document.getElementById('unlogin').style.display='none';";
			echo "</script>";
		}
	 ?>
	
	<script>
		$(document).ready(function(){
		    $("#chart4").click(function(){

				var myC = document.getElementById('myC4').getContext('2d');
				document.getElementById('myC4').style.display='block';
				document.getElementById('myC1').style.display='none';
				document.getElementById('myC2').style.display='none';
				document.getElementById('myC3').style.display='none';


				// Global Options
				Chart.defaults.global.defaultFontFamily = 'Lato';
				Chart.defaults.global.defaultFontSize = 18;
				Chart.defaults.global.defaultFontColor = '#8e2ad4';
				<?php  
				

				?>
				var barChart = new Chart(myC, {
					type:'doughnut', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
					data: {
						// labels:['Phuong','Tuan','Hung','Nhan','Anh', 'Quan', 'Vu'],
						labels:[<?php 
								// $kq = mysqli_query ($link,"SELECT sv.name, congtac.salary FROM cuu_sv sv INNER JOIN congtac on sv.student_id = congtac.student_id WHERE sv.student_id != 1 ORDER BY sv.student_id ASC");
								$kq = mysqli_query ($link,"SELECT cq.type, COUNT(*) as data FROM congtac ct INNER JOIN coquan cq ON ct.office_id = cq.office_id group by cq.type");
								while ($r = mysqli_fetch_array ($kq)) {
									echo "'{$r['type']}',";
								}

							?>],
						datasets:[{
							label: 'Mức lương',
							data: [
							<?php $kq = mysqli_query ($link,"SELECT cq.type, COUNT(*) as data FROM congtac ct INNER JOIN coquan cq ON ct.office_id = cq.office_id group by cq.type");
								while ($r = mysqli_fetch_array ($kq)) {
									echo "'{$r['data']}',";
								}
							// 21,
							// 18,
							// 25,
							// 32,
							// 5, 
							// 18,
							// 20
							?>],
							backgroundColor:['red','blue','green'],
							borderWidth:1,
							borderColor:'#94E338',
							hoverBorderWidth:2,
							hoverBorderColor:'#8E2AD4'
						}]
					},
					options: {
						title:{
							display: true,
							// text: 'Biểu đồ hình thức công ti đang làm viêc',
							fontSize: 25,
							position : 'bottom'
						},
						legend:{
							position :'right',
							labels:{
								fontColor :'black'
							}

						},
						layout:{
							padding:{
								left: 50,
								right: 0,
								top: 10,
								bottom:0
							}
						}
					}
					

				});
		        
		    });
		});
		$(document).ready(function(){
		    $("#chart3").click(function(){

				var myC = document.getElementById('myC3').getContext('2d');
				document.getElementById('myC3').style.display='block';
				document.getElementById('myC1').style.display='none';
				document.getElementById('myC2').style.display='none';
				document.getElementById('myC4').style.display='none';

				// Global Options
				Chart.defaults.global.defaultFontFamily = 'Lato';
				Chart.defaults.global.defaultFontSize = 18;
				Chart.defaults.global.defaultFontColor = '#8e2ad4';
				<?php  
				

				?>
				var barChart = new Chart(myC, {
					type:'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
					data: {
						// labels:['Phuong','Tuan','Hung','Nhan','Anh', 'Quan', 'Vu'],
						labels:['Đúng ngành', 'Trái ngành'],
						datasets:[{
							data: [
							<?php $kq = mysqli_query ($link,"SELECT COUNT(*) as dem, true_work FROM `congtac`GROUP BY true_work ORDER BY true_work DESC");
								$a = array();
								$i =0;
								while ($r = mysqli_fetch_array ($kq)) {
									$a[$i] = $r['dem'];
									$i++;
								}
								$a[0] = ($a[0] *100)/($a[0] +$a[1]);
								$a[1] = 100 - $a[0];
								echo "$a[0], $a[1]";
							?>
							
							// 21,
							// 18,
							// 25,
							// 32,
							// 5, 
							// 18,
							// 20
							],
							backgroundColor:['red','blue'],
							borderWidth:1,
							borderColor:'#94E338',
							hoverBorderWidth:2,
							hoverBorderColor:'#8E2AD4'
						}]
					},
					options: {
						title:{
							display: true,
							// text: 'Biểu đồ làm đúng ngành',
							fontSize: 25,
							position : 'bottom'
						},
						legend:{
							position :'right',
							labels:{
								fontColor :'black'
							}

						},
						layout:{
							padding:{
								left: 50,
								right: 0,
								top: 10,
								bottom:0
							}
						}
					}
					

				});
		        
		    });
		});
		$(document).ready(function(){
		    $("#chart2").click(function(){

				var myC = document.getElementById('myC2').getContext('2d');
				document.getElementById('myC2').style.display='block';
				document.getElementById('myC1').style.display='none';
				document.getElementById('myC4').style.display='none';
				document.getElementById('myC3').style.display='none';

				// Global Options
				Chart.defaults.global.defaultFontFamily = 'Lato';
				Chart.defaults.global.defaultFontSize = 18;
				Chart.defaults.global.defaultFontColor = '#8e2ad4';
				<?php  
				

				?>
				var barChart = new Chart(myC, {
					type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
					data: {
						// labels:['Phuong','Tuan','Hung','Nhan','Anh', 'Quan', 'Vu'],
						labels:[<?php 
								// $kq = mysqli_query ($link,"SELECT sv.name, congtac.salary FROM cuu_sv sv INNER JOIN congtac on sv.student_id = congtac.student_id WHERE sv.student_id != 1 ORDER BY sv.student_id ASC");
								$kq = mysqli_query ($link,"SELECT CONCAT(k.course_name,l.class_name) AS name, AVG(ct.salary) AS salary FROM lop l 
															INNER JOIN khoa k on l.course_id = k.course_id
															INNER JOIN cuu_sv sv ON sv.class_id = l.class_id
															INNER JOIN congtac ct ON ct.student_id = sv.student_id
															GROUP BY l.class_id");
								while ($r = mysqli_fetch_array ($kq)) {
									echo "'{$r['name']}',";
								}

							?>],
						datasets:[{
							label: 'Mức lương',
							data: [
							<?php $kq = mysqli_query ($link,"SELECT CONCAT(k.course_name,l.class_name) AS name, AVG(ct.salary) AS salary FROM lop l 
															INNER JOIN khoa k on l.course_id = k.course_id
															INNER JOIN cuu_sv sv ON sv.class_id = l.class_id
															INNER JOIN congtac ct ON ct.student_id = sv.student_id
															GROUP BY l.class_id");
								while ($r = mysqli_fetch_array ($kq)) {
									echo "'{$r['salary']}',";
								}
							// 21,
							// 18,
							// 25,
							// 32,
							// 5, 
							// 18,
							// 20
							?>],
							backgroundColor:'#e1993e',
							borderWidth:1,
							borderColor:'#94E338',
							hoverBorderWidth:2,
							hoverBorderColor:'#8E2AD4'
						}]
					},
					options: {
						title:{
							display: true,
							// text: 'Biểu đồ lương của cựu sinh viên theo lớp',
							fontSize: 25,
							position : 'bottom'
						},
						legend:{
							position :'right',
							labels:{
								fontColor :'black'
							}

						},
						layout:{
							padding:{
								left: 50,
								right: 0,
								top: 10,
								bottom:0
							}
						}
					}
					

				});
		        
		    });
		});
		$(document).ready(function(){
		    $("#chart1").click(function(){

				var myC = document.getElementById('myC1').getContext('2d');
				document.getElementById('myC1').style.display='block';
				document.getElementById('myC4').style.display='none';
				document.getElementById('myC2').style.display='none';
				document.getElementById('myC3').style.display='none';

				// Global Options
				Chart.defaults.global.defaultFontFamily = 'Lato';
				Chart.defaults.global.defaultFontSize = 18;
				Chart.defaults.global.defaultFontColor = '#8e2ad4';
				<?php  
				

				?>
				var barChart = new Chart(myC, {
					type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
					data: {
						// labels:['Phuong','Tuan','Hung','Nhan','Anh', 'Quan', 'Vu'],
						labels:[<?php 
								// $kq = mysqli_query ($link,"SELECT sv.name, congtac.salary FROM cuu_sv sv INNER JOIN congtac on sv.student_id = congtac.student_id WHERE sv.student_id != 1 ORDER BY sv.student_id ASC");
								$kq = mysqli_query ($link,"SELECT k.course_id,k.course_name AS name, AVG(ct.salary) AS salary FROM khoa k 
															INNER JOIN lop l on  k.course_id = l.course_id
															INNER JOIN cuu_sv sv ON sv.class_id = l.class_id
															INNER JOIN congtac ct ON ct.student_id = sv.student_id
															GROUP BY k.course_id");
								while ($r = mysqli_fetch_array ($kq)) {
									echo "'{$r['name']}',";
								}

							?>],
						datasets:[{
							label: 'Mức lương',
							data: [
							<?php $kq = mysqli_query ($link,"SELECT k.course_id,k.course_name AS name, AVG(ct.salary) AS salary FROM khoa k 
															INNER JOIN lop l on  k.course_id = l.course_id
															INNER JOIN cuu_sv sv ON sv.class_id = l.class_id
															INNER JOIN congtac ct ON ct.student_id = sv.student_id
															GROUP BY k.course_id");
								while ($r = mysqli_fetch_array ($kq)) {
									echo "'{$r['salary']}',";
								}
							// 21,
							// 18,
							// 25,
							// 32,
							// 5, 
							// 18,
							// 20
							?>],
							backgroundColor:'#e1993e',
							borderWidth:1,
							borderColor:'#94E338',
							hoverBorderWidth:2,
							hoverBorderColor:'#8E2AD4'
						}]
					},
					options: {
						title:{
							display: true,
							// text: 'Biểu đồ lương của cựu sinh viên theo khóa học',
							fontSize: 25,
							position : 'bottom'
						},
						legend:{
							position :'right',
							labels:{
								fontColor :'black'
							}

						},
						layout:{
							padding:{
								left: 50,
								right: 0,
								top: 10,
								bottom:0
							}
						}
					}
					

				});
		        
		    });
		});
	

	</script>
	<script>
		function getsearch() {
			// body...
			// $('#search').slideToggle();
			// $('#searchbox').slideToggle();
			var x = document.getElementById('search').style.width;
			if (x == '2%') {
				document.getElementById('search').style.width = "22%";
				document.getElementById('timkiem').style.display="";
				document.getElementsByClassName('fa-search')[0].style.left="92%";
			}
			else{
				document.getElementById('search').style.width = "2%";
				document.getElementById('timkiem').style.display="none";
				document.getElementsByClassName('fa-search')[0].style.left="97.8%";
			}
			
		}
		function mouseOver(x) {
		    x.style.color = "red";
		}

		function mouseOut(x) {
		    x.style.color = "#0a36b5";
		}
		$(function() {
			// cho tat ca cac noi dung co lại
			$('.ndbd').slideUp();
			$('#menu_chart h3').click(function(event) {
				/* Act on the event */
				console.log('noi dung da chay ');
				$('.ndbd').slideToggle();
				$('#faright').slideToggle();
				$('#fadown').slideToggle();
			});
		});

		
		function clickfile(ci){
		// 		/* Act on the event */
		 		//alert(ci);
				// Tạo một biến lưu trữ đối tượng XML HTTP. Đối tượng này
                // tùy thuộc vào trình duyệt browser ta sử dụng nên phải kiểm
                // tra như bước bên dưới
                var xmlhttp;
                 
                // Nếu trình duyệt là  IE7+, Firefox, Chrome, Opera, Safari
                if (window.XMLHttpRequest)
                {
                    xmlhttp = new XMLHttpRequest();
                }
                // Nếu trình duyệt là IE6, IE5
                else
                {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                 
                // Khởi tạo một hàm gửi ajax
                xmlhttp.onreadystatechange = function()
                {
                    // Nếu đối tượng XML HTTP trả về với hai thông số bên dưới thì mọi chuyện 
                    // coi như thành công
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        // Sau khi thành công tiến hành thay đổi nội dung của thẻ div, nội dung
                        // ở đây chính là 
                        document.getElementById("main").innerHTML = xmlhttp.responseText;
                    }
                };
                 
                // Khai báo với phương thức GET, và url chính là file result.php
                xmlhttp.open("GET", "result.php?q="+ci, true);
                 
                // Cuối cùng là Gửi ajax, sau khi gọi hàm send thì function vừa tạo ở
                // trên (onreadystatechange) sẽ được chạy
                xmlhttp.send();
				var card = document.getElementById("card").style.display;
				// var disp = card.style.display;
				if (card == "none") 
				{
					document.getElementById("card").style.display = "block";

				}
			$(document).ready(function() {
				$("#card").click(function(event) {
					/* Act on the event */
					var card = document.getElementById("card").style.display;
					// var disp = card.style.display;
					if (card != "none") 
					{
						document.getElementById("card").style.display = "none";

					}
				});
			});
		}
		
	</script>
</body>
</html>