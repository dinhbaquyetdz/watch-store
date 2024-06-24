<?php
require "connect_sql.php";
if(isset($_REQUEST['id']) && $_REQUEST['id'] != null){
    $id = $_GET['id'];
    $sql="DELETE FROM dangki WHERE id='$id'";
    if($conn -> query($sql)===true){
        header('location: adminhome.php?idhome=kh');
    }
}
$conn->close(); 
?>