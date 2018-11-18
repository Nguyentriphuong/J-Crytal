<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/card.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400">
    <script src="js/jquery-1.12.4.js"></script>
    <!-- <script src="js/index.js"></script> -->
</head>
<body>

<?php
$q = intval($_GET['q']);
// $q = $_GET['q'];
$id_active = $q+1;
include("connect.php");
include("variable.php");

?>
<!-- <div id="card"">
 -->        <div class="card-header" >

           <div class="cover" style="background-image: url(img/user.jpg);"></div>
          <!--  <div class="close">
               <i class="fa fa-times-circle" aria-hidden="true" id="icon_x"></i>   
           </div> -->
           
           <div class="name">
               <span class="first"><?php echo "$firstname"; ?></span>
               <span class="last"> <?php echo "$lastname"; ?> </span>
           </div>
       </div>
       <div class="container">
       
           <table style="width:100%" >
               <tr>
                   <th>Thông tin liên hệ</th>
               </tr>
               <tr>
                   <td>Ngày sinh: <span id="ns"><?php echo "$birthday"; ?></span></td>
               </tr>
               <tr>
                   <td>Giới tính: <span id="gt"><?php echo "$sex"; ?></span></td>
               </tr>
               <tr>
                   <td>Số điện thoại: <span id="sdt"><?php echo "$phone"; ?></span></td>
               </tr>
               <tr>
                   <td>Email: <span id="email"><?php echo "$Email"; ?></span></td>
               </tr>
               <tr class="bott">
                   <td>Địa chỉ: <span id="dc"><?php echo " $district, $province"; ?></span></td>
               </tr>
           </table>
           <table style="width:100%" >
               <tr>
                   <th>Thông tin khóa học</th>
               </tr>
               <tr>
                   <td>Khóa học: <span id="kh"><?php echo "$course_name"; ?></span></td>
               </tr>
               <tr>
                   <td>Lớp: <span id="lop"><?php echo "$class_name"; ?></span></td>
               </tr>
               <tr class="bott">
                   <td>Thời gian đào tạo: <span id="tgdt"><?php echo "$time_edu"; ?></span></td>
               </tr>
           </table>
           <table style="width:100%" >
               <tr>
                   <th>Quá trình công tác</th>
               </tr>
               <tr>
                   <td>Nơi làm việc: <span id="nlv"><?php echo "$office" ?></span></td>
               </tr>
               <tr>
                   <td>Thời gian: <span id="begin"><?php echo "$t_begin"; ?></span> --- <span id="end"><?php echo "$t_end"; ?></span></td>
               </tr>
               <tr>
                   <td>Chức vụ, vị trí: <span id="vc"><?php echo "$position"; ?></span></td>
               </tr>
               <tr class="bott">
                   <td>Mức lương: <span id="ml"><?php echo "$salary"; ?></span></td>
               </tr>
           </table>
     </div>  
 <!-- </div>           -->


</body>
</html>