

<?php
require "connect_sql.php";

if (isset($_POST['dangky'])) {
    $ho = $_POST['ho'];
    $ten = $_POST['ten'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $date = $_POST['date'];
    $confirm = $_POST['confirm'];
    $gt = $_POST['gt'];
    if(!empty($ho) && !empty($ten) && !empty($email) && !empty($pass) && !empty($confirm) && !empty($gt) && !empty($date))
    {
        
        $check = "SELECT email1 FROM dangki WHERE email1 = '$email' ";
        $result = mysqli_query($conn, $check) or die( mysqli_error($conn));
        if(mysqli_num_rows($result) == 0){
        //insert
        $adduser = "INSERT INTO `dangki` (`ho`, `ten`, `gt`, `email1`,`date`, `pass`,`level`) VALUES('$ho', '$ten', '$gt', '$email','$date', md5('$pass'),'2' ) ";
        if($conn->query($adduser)===true){
        //    echo "dang ky thanh cong";
            header("location: loginadmin.php");
        }else{
            echo "loi {$adduser}".$conn->error;
        }
        }else{
            header("location: loginadmin.php");
        }     
   
    }else{
        header("location: dangkiadmin.html");
    }

}
?>