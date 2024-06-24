<?php
require "connect_sql.php";
if(isset($_REQUEST['id']) && $_REQUEST['id'] != null){
    $id = $_GET['id'];
    $sql=mysqli_query($conn,"SELECT dangki.id FROM `dangki` INNER JOIN donhang ON donhang.id_khachhang=dangki.id  WHERE donhang.id='$id';");
    $row=mysqli_fetch_array($sql);
    $idkh=$row['id'];
    $sql="DELETE FROM donhang WHERE id='$id'";
    if($conn -> query($sql)===true){
        header('location: adminhome.php?id='."$idkh".'');
    }
}
$conn->close(); 
?>