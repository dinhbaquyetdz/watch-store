<?php
require "connect_sql.php";
if(isset($_REQUEST['id']) && $_REQUEST['id'] != null){
    $id=$_GET['id'];
    $sql="DELETE FROM giohang WHERE id='$id'";
    if($conn -> query($sql)===true){
        header('location: giohang.php');
    }
}
$conn->close(); 
?>