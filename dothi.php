<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Do thi demo</title>
	<link rel="stylesheet" href="style.css" media="screen">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
	<script src="js/jquery-1.12.4.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<?php include("connect.php"); ?>
	<div class="container">
		<canvas id="myC"></canvas>
	</div>
	<script>
		var myC = document.getElementById('myC').getContext('2d');


		// Global Options
		Chart.defaults.global.defaultFontFamily = 'Lato';
		Chart.defaults.global.defaultFontSize = 18;
		Chart.defaults.global.defaultFontColor = 'red';
		<?php  
		

		?>
		var barChart = new Chart(myC, {
			type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
			data: {
				// labels:['Phuong','Tuan','Hung','Nhan','Anh', 'Quan', 'Vu'],
				labels:[<?php 
						$kq = mysqli_query ($link,"SELECT sv.name, congtac.salary FROM cuu_sv sv INNER JOIN congtac on sv.student_id = congtac.student_id WHERE sv.student_id != 1 ORDER BY sv.student_id ASC");
						while ($r = mysqli_fetch_array ($kq)) {
							echo "'{$r['name']}',";
						}

					?>],
				datasets:[{
					label: 'Mức lương',
					data: [
					<?php $kq = mysqli_query ($link,"SELECT sv.name, congtac.salary FROM cuu_sv sv INNER JOIN congtac on sv.student_id = congtac.student_id WHERE sv.student_id != 1 ORDER BY sv.student_id ASC");
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
					backgroundColor:'#cddc39',
					borderWidth:1,
					borderColor:'#94E338',
					hoverBorderWidth:2,
					hoverBorderColor:'#8E2AD4'
				}]
			},
			options: {
				title:{
					display: true,
					text: 'Vi du demo thoi',
					fontSize: 30,
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

	</script>
</body>
</html> -->