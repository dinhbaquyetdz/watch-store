

<?php
require "connect_sql.php";

if(isset($_POST['dangky'])) {
    $ho = $_POST['ho'];
    $ten = $_POST['ten'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['password'];
    $date = $_POST['date'];
    $confirm = $_POST['confirm'];
    $gt = $_POST['gt'];
    $address=$_POST['address'];
    // $level = $_POST['level'];
    if(!empty($ho) && !empty($ten) && !empty($email) && !empty($pass) && !empty($confirm) && !empty($gt) && !empty($date) && !empty($address))
    { 
        $check = "SELECT email FROM dangki WHERE email = '$email' ";
        $result = mysqli_query($conn, $check) or die( mysqli_error($conn));
        if(mysqli_num_rows($result) == 0){
        //insert
        $adduser = "INSERT INTO `dangki` (`ho`, `ten`, `gt`, `email`,`date`, `pass`,`level`,`address`,`phone`) VALUES('$ho', '$ten', '$gt', '$email','$date', md5('$pass'),'1','$address','$phone' ) ";
        if($conn->query($adduser)===true){
        //    echo "dang ky thanh cong";
            header("location: login.php");
        }else{
            echo "loi {$adduser}".$conn->error;
        }
        }else{
            header("location: login.php");
        }     
   
    }else{
        header("location: dangki.html");
    }

}
?>