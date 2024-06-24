<?php
session_start();
if($_SESSION['email'] == null ){
    header("location: home.php");
}
require "connect_sql.php";
$err="";
$mail =  $_SESSION['email'] ;
//lấy thông tin người đang nhập
$query1 =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail'");
$row1 = mysqli_fetch_assoc($query1);
$ab = $row1['ten'];
$get=mysqli_query($conn,"SELECT * FROM list");
//lấy thông tin người đang nhập
$query =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail' AND level='1'");
$row=mysqli_fetch_assoc($query);
$id=$row['id'];

// $wallet=$row['wallet'];

// $checkgh=mysqli_query($conn,"SELECT * FROM giohang WHERE id_khachhang='$id'");
// $num=mysqli_num_rows($checkgh);

 //nạp tiền
 if(isset($_POST['submit'])){
    // var_dump($_POST);
    if(!empty($_POST['monney']) && !empty($_POST['tk'])){
        $monney=$_POST['monney'];
        $vi=$_POST['vi'];
        $pin=$_POST['pin'];
        $ten=$_POST['tk'];
        // $a=0;
        $checkvi=mysqli_query($conn,"SELECT * FROM wallet WHERE id_khachhang='$id' AND loaivi='$vi'");
        if(mysqli_num_rows($checkvi)>0){
            while($rowvi=mysqli_fetch_array($checkvi)){
                if( $ten != $rowvi['tentaikhoan']){
                    $err="<font color='red'><h4>Sai tên tài khoản<a href='lienketvi.php'>Thêm tài khoản</a></h4></font>";  
                }else{
                    if($rowvi['pinnumber'] != $pin){
                        $err="<font color='red'><h4>Mã pin không đúng!</h4></font>";
                    }else{
                        // $wallet=$rowvi['money'];
                        // $wallet +=$monney;
                        // $nap="UPDATE wallet set `money`='$monney' WHERE id_khachhang='$id' AND loaivi='$vi'";
                        $gd=mysqli_query($conn,"INSERT INTO `giaodich` (`id_khachhang`,`content`,`monney`,`thoigian`) VALUES ('$id','1','$monney',CURRENT_TIME)");
                        // if($conn->query($nap)===true){
                            $wl=mysqli_query($conn,"SELECT `wallet` FROM dangki WHERE id='$id'");
                            while($wlus=mysqli_fetch_array($wl)){
                                $money=$wlus['wallet'];
                                $money += $monney;
                            }
                            $up="UPDATE dangki SET wallet='$money' WHERE id='$id'";
                            if($conn->query($up)===true){
                                $err="<font color='blue'><h4>Nạp tiền thành công</h4></font>";
                            }else{
                                $err="<font color='red'><h4>Nạp tiền thất bại</h4></font>";    
                            }
                        // }else{
                        //     $err="<font color='red'><h4>Nạp tiền thất bại</h4></font>";
                        // }
                    }
                }
                
            }
            
        }else{
            $err="<font color='blue'><h4>Chưa liên kết tới ví <a href='lienketvi.php'>Liên kết ngay</a></h4></font>";
        }
    }else{
        $err="<font color='red'><h4>Chưa nhập đầy đủ thông tin <a href='lienketvi.php>Liên kết ngay</a></h4></font>";
    }
   
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Wallet</title>
</head>
<style>
   .dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 90px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  text-align: center;
  padding: 0%;
  z-index: 1;
  border-radius: 5px;
}
.dropdown-content>a{
    text-decoration: none;
    color: black;
}
.dropdown-content>a:hover{
    color: blue;
    text-decoration: underline;
}
.dropdown:hover .dropdown-content {
  display: block;
}

</style>
<body class="w-100 h-100 bg-secondary-subtle">
<div class="container-fluid">
    <!-- menu -->
    <div class="row">
    <nav class="navbar bg-light">
    <div class="container-fluid">
    <a href="shop.php" style="text-decoration: none;"><h2>HOME</h2></a>
        <a class="navbar-brand" href="#">
        <div class="dropdown">
        
        <span><?php if(!empty($row1['image'])){echo '<img src="photo/'.$row1['image'].'" alt=""  style="width: 50px; height: 50px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">';}
                    else{?><img src="image/avtjpg.jpg" alt=""  style="width: 50px; height: 50px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">
        <?php } ?></span><?php echo "$ab" ?>
                    <div class="dropdown-content">
            <a href="logout.php" >Đăng xuất</a>
            </div>
        </div>  
        </a>
    </div>
    </nav>
    </div>
   
<!-- content -->
<div class="row mt-5 ">
    <div class="col-4 ">
    <div class="row">
        <div class="col-12 text-center">
        <img src="image/vnpay1.jpg" style="max-width: 200px;">
        </div>
    
    </div>
    <div class="row">
        <div class="col-12 text-center">
        <img src="image/momo.png" style="max-width: 200px;" alt="">
        </div>
    
    </div>
    
    </div>
    <div class="col-7 text-center">
       
                
        
        <div class="row"><h2 class="text-center">Q_PAY</h2></div>
        <div class="row mt-5">
        <!-- chọn loại ví -->
       
        
        <!-- nạp tiền -->
        <form action="" method="post">
            <div class="wallet">
            <label for="" class="text-left"><h4>Ví liên kết:</h4></label>
            <select class="form-select mb-5" aria-label="Default select example" name="vi">
            <option selected value="1">VNpay</option>
            <option value="2">MOMO</option>
            </select>
            </div>
            <div class="wallet mb-2">
            <label for="" class="text-left"><h4>Tài khoản:</h4></label>
            <input type="text" name="tk" id="" placeholder="Nhập tên tài khoản" class="w-100 ">
            </div>
            <div class="wallet mb-2">
            <label for="" class="text-left"><h4>Số tiền cần nạp:</h4></label>
            <input type="number" name="monney" id="" placeholder="Nhập số tiền cần nạp" class="w-100 ">
            </div>
            <div class="wallet mb-2">
            <label for="" class="text-left"><h4>Mã Pin:</h4></label>
            <input type="number" name="pin" id="" placeholder="Nhập mã pin" class="w-100 ">
            </div>
            <div class="wallet">
            <input type="submit" class="btn btn-primary" name="submit" value="Nạp">
            </div>
            <a href="lienketvi.php">Liên kết ví</a>
            <div class="notification"><?php echo $err?></div>
            <?php
           
            ?>
        </form>
        </div>
        
    </div>
   <div class="col-1"></div>
</div>

</div>
</body>
</html>