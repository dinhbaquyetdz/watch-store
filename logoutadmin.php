<?php
session_start();

if(isset($_SESSION['email1'])){
    unset($_SESSION['email1']);
    header("location: loginadmin.php");
}


?>