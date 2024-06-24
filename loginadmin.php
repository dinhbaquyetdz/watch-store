<?php
session_start();
require "connect_sql.php";
if(isset($_POST['login'])){
    $mail = $_POST['email1'];
    $pass = $_POST['password'];
   
    $pass = md5($pass);

    // $link = new mysqli("localhost", "root", "", "shopdongho");
    $query =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email1 = '$mail' AND level = '2'");
    if(mysqli_num_rows($query) == 0){
       
            echo '<script>alert("Tài khoản này không tồn tại!!!")</script>';
     
    }else{
        $row = mysqli_fetch_array($query);
        
        if($pass != $row['pass']){
            // echo "mat khau khong dung <a href='javascript: history.go(-1)'>Trở lại</a>";
            echo '<script>alert("Mật khẩu không đúng!!!")</script>';
        }else{
            $_SESSION['email1'] = $mail;
            
                header("location: adminhome.php");
            
        }
    }
      
    

    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    *{
        box-sizing: border-box;
    }
    body{
        font-size: 17px;
    }
    #wrapper{
        display: flex;
        justify-content: center;
        align-items: center;
        /* min-height: 80vh; */
    }
    form{
        /* border: 1px solid #dadce0; */
        border-radius: 5px;
        padding: 30px;
    }
    h3{
        text-align: center;
        font-size: 24px;
    }
    p{
        height: 30px;
        position: relative;
    }
    p>label{
        transform: translateY(13px);
    }
    #checkpass{
        width: 15px;
        margin-top: 20px;
    }
    .form_group{
        margin-bottom: 15px;
        position: relative;
    }
    input{
        height: 50px;
        width: 300px;
        outline: none;
        border: 1px solid #dadce0;
        padding: 10px;
        border-radius: 5px;
        font-size: inherit;
        color: #202124;
        transition: all 0.3s ease-in-out; 
    }
    .form_group>label{
        position: absolute;
        padding: 0px 5px;
        left: 5px;
        top: 50%;
        pointer-events: none;
        transform: translateY(-50%);
        background-color: #fff;
        transition: all 0.3s ease-in-out;
    }
    .form_group input:focus{
        border: 2px solid blue;
    }
    .form_group input:focus + label, .form_group input:valid + label{
        top: 0px;
        font-size: 13px;
        color: blue;
    }
    input#login{
        background-color: rgb(0, 132, 255);
        color: #fff;
    }
    input#login:hover{
        opacity: 0.85;
    }
</style>
<script>
     var count = 1;
     function checkp() {
      var img=['image/check1.jpg','image/check2.jpg']
      document.getElementById("checkpass").src=img[count];
       count++;
        if(count == 2){
            document.getElementById("pass").setAttribute('type','text');
            count = 0;
        }if(count == 1){
            document.getElementById("pass").setAttribute('type','password');
         }
    }
</script>
<body >
    <div class="container">
        <div class="row">
            <div class="col-4">
                <!-- <img src="image/bg2.jpg" class="w-100 h-100" alt=""> -->
            </div>
            <div class="col-4 shadow p-3 m-5">
                <div id="wrapper">
                    <form action="loginadmin.php" method="post">
                        <h3 style="font-family: Arial; font-weight: bold;width: 130px; margin-left: 80px;" class="shadow  mb-3">Đăng Nhập</h3>
                        <div class="form_group shadow  mb-3">
                            <input type="text" name="email1" id="" required>
                            <label for="">email or phone</label>
                        </div>
                        <div class="form_group shadow  mb-3">
                            <input type="password" name="password" id="pass" required>
                            <label for="">password</label>
                        </div>
                       
                        <div class="check">
                            <p><img id="checkpass" src="image/check1.jpg" onclick="checkp()" alt=""><label style="position: absolute;">Hiển thị mật khẩu</label></p>
                        </div>
                        
                        <input type="submit" value="Đăng nhập" name="login" id="login">
                        <div class="dangki">
                            <p style="text-align: center;"><a href="dangkiadmin.html">Bạn chưa có tài khoản?</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</body>
</html>


