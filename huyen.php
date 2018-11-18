<!DOCTYPE html>
<html>
<head>
    <script>
        function changedistrict(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("xa").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","xa.php?q="+str,true);
        xmlhttp.send();
    }
}
    </script>
</head>
<body>

<?php
//$q = intval($_GET['q']);
$q = $_GET['q'];
include("connect.php");
?>
<label for="district">Huyện/Quận</label>: 
            <select id="district" name="district" onchange="changedistrict(this.value)">
                <option value=""></option>
                <?php 
                $sql = "SELECT * FROM district where provinceid = '$q'" ;
                $rel = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_array ($rel)):; 
                ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                <?php endwhile; ?>
             </select>

</body>
</html>