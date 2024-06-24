<?php
require "connect_sql.php";
if(isset($_REQUEST['id']) && $_REQUEST['id'] != null){
    $id = $_GET['id'];
    $sql="DELETE FROM comment WHERE id='$id'";
    if($conn -> query($sql)===true){
        header('location: adminhome.php?idhome=sp');
    }
}
$conn->close(); 
?>