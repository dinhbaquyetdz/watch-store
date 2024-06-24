<?php 
session_start();
if($_SESSION['email'] == null ){
    header("location: home.php");
}
require "connect_sql.php";
$mail =  $_SESSION['email'] ;
//lấy thông tin người đang nhập
$query1 =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail'");
$row1 = mysqli_fetch_array($query1);
$a = $row1['ten'];
$get=mysqli_query($conn,"SELECT * FROM list");
//lấy thông tin người đang nhập
$query =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail' AND level='1'");
$row=mysqli_fetch_assoc($query);
$id=$row['id'];
//lấy id sp
if(isset($_GET['idsp'])){
    $idsp=$_GET['idsp'];
    $query2 =mysqli_query($conn,"SELECT * FROM `list` WHERE id = '$idsp'");
    $row2=mysqli_fetch_assoc($query2);
  }
  $checkgh=mysqli_query($conn,"SELECT * FROM giohang WHERE id_khachhang='$id'");
  $num=mysqli_num_rows($checkgh);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Lịch sử giao dịch</title>
</head>
<style>
     li{
    list-style-type: none;
  }
  a{
    text-decoration: none;
  }
  body{
    position: absolute;
    z-index: -1;
    width: 100%;
    background-color: aliceblue;
  }
  .shop:hover{
    position: relative;
    bottom: 2px;
    left: 2px;
  }
  .col-4.px-0{
    background-color: black;
  }
  .col-4>.gt{
    margin-left: 200px;
  }
  .col-4>.gt>a{
    text-align: center;
    line-height: 15px;
    text-decoration: none;
    color: darksalmon;
  }
  .col-4>.gt>a:hover{
    color: brown;
  }
  .dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  max-width: 700px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  text-align: center;
  padding: 0%;
  z-index: 1;
  border-radius: 5px;
 
  transition: all 0.3s ease-in-out;
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
.danhmuc{
  display: flex;
}
ul>a>li{
color: black;
transition: all 0.2s ease-in-out;
}
ul>a>li:hover{
  color: blueviolet;
  position: relative;
  transform: translateX(20%);
}
.logo{
    color:brown;
    font-family: Fantasy;
    font-size: 200px;
    
    position: fixed;
    top:200px;
    left: 50px;
}
</style>
<body>
    <div class="container-fluid">
    <!-- menu -->
    <div class="header sticky-top shadow pb-1 mb-2">
      <div class="row" >
          <div class="col-12 px-0" >
            <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark" >
              <div class="container-fluid" >
                <a class="navbar-brand" href="shop.php">WATCH STORE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">Hotline: 18001008</a>
                    </li>
                    <div class="dropdown btn btn-tertiary">
                      <span style="color: #f9f9f9;"><a href="sanpham.php" style="color: #f9f9f9;">Sản phẩm<a></span>
                      <div class="dropdown-content " style="min-width: 700px;">
                      <div class="row w-100" >
                      
                        <div class="col-2 danhmuc">
                         <ul>
                          <h5>Thương hiệu</h5>
                          <?php
                          $th=mysqli_query($conn,"SELECT DISTINCT `thuonghieu` FROM `list`");
                          while($rowth=mysqli_fetch_array($th)){
                            $getth=$rowth['thuonghieu'];
                            ?>
                            <a href="sanpham.php?TH=<?=$getth?>"><li><?= $getth ?></li></a>
                            <?php
                          }
                          ?> 
                         </ul>
                          </div>

                          
                          <div class="col-2 danhmuc">
                         <ul>
                          <h5>Xuất xứ</h5>
                          <?php
                          $xx=mysqli_query($conn,"SELECT DISTINCT `xuatxu` FROM `list`");
                          while($rowxx=mysqli_fetch_array($xx)){
                            $getxx=$rowxx['xuatxu'];
                            ?>
                            <a href="sanpham.php?XX=<?= $getxx ?>"><li><?= $getxx ?></li></a>
                            <?php
                          }
                          ?> 
                         </ul>
                          </div>

                          <div class="col-2 danhmuc">
                         <ul>
                          <h5>Đối tượng</h5>
                          <?php
                          $dt=mysqli_query($conn,"SELECT DISTINCT `doituong` FROM `list`");
                          while($rowdt=mysqli_fetch_array($dt)){
                            $getdt="";
                            $DT=$rowdt['doituong'];
                            if($rowdt['doituong']==1){
                              $getdt="trẻ em";
                            }elseif($rowdt['doituong']==2){
                              $getdt="nữ";
                            }elseif($rowdt['doituong']==3){
                              $getdt="nam";
                            }
                            ?>
                            <a href="sanpham.php?DT=<?= $DT ?>"><li><?= $getdt ?></li></a>
                            <?php
                          }
                          ?> 
                         </ul>
                          </div>
                          
                          <div class="col-2 danhmuc">
                         <ul>
                          <h5>Bộ máy</h5>
                          <?php
                          $bm=mysqli_query($conn,"SELECT DISTINCT `bomay` FROM `list`");
                          while($rowbm=mysqli_fetch_array($bm)){
                            $getbm=$rowbm['bomay'];
                            ?>
                            <a href="sanpham.php?BM=<?= $getbm?>"><li><?= $getbm ?></li></a>
                            <?php
                          }
                          ?> 
                         </ul>
                          </div>
                        <div class="col-4">
                          <img src="image/banner_menu1.jpg" class="w-100 m-0" alt="">
                          <img src="image/banner_menu2.jpg" class="w-100 m-0" alt="">
                        </div>
                      </div>
                      </div>
                  </div> 
                  </ul>
                  <form class="d-flex" role="search" method="get">
                    <input class="form-control me-2" name="boxsearch" style="min-width: 500px;" type="search" placeholder="Search . . ." aria-label="Search">
                    <button class="btn btn-outline-success "name="search"  type="submit">Search</button>
                    
                    <a href="giohang.php?idus=<?php echo $id?>" class="shop"><img src="image/snapedit_1693557303745.png" style="width: 50px; padding: 0;border-radius: 5px; border-color:aquamarine; margin-left: 10px;"></a>
                    <p style="z-index: 1; color: red;"><?php echo $num?></p>
                    
                          <!-- <button style="width: 200px; border-radius: 5px; border-color: aquamarine; margin-left: 10px;"><a href="login.php" style="text-decoration: none;color: aliceblue;">Đăng Nhập</a></button> -->
                  <div class="dropdown">
                      <span><?php if(!empty($row['image'])){echo '<img src="photo/'.$row['image'].'" alt=""  style="width: 50px; height: 50px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">';}
                                  else{?><img src="image/avtjpg.jpg" alt=""  style="width: 50px; height: 50px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">
                    <?php } ?></span>
                      <div class="dropdown-content" >
                      <a href="infor_user.php"><?php echo "$a" ?></a><br>
                      <a href="logout.php?id=<?php echo $id?>" >Đăng xuất</a>
                      </div>
                  </div>  
                  
                  </form>
                </div>
              </div>
            </nav>
          </div>
      </div>
      
      </div>
        <!-- content -->
        <div class="row mt-5">
          <div class="col-6">
            <div class="logo shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                Q_pay
            </div>
          </div>
          <div class="col-3">
            <div class="row ">
            <div class="col-2"></div>
            <div class="col-10 shadow-lg p-3 mb-5 bg-body-tertiary rounded"> <h3 style="color: red;font-family: Arial, Helvetica, sans-serif;">Lịch sử giao dịch</h3></div></div>    
           
            <div class="row">
                <div class="col-2"></div>
                <div class="col-10 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <?php 
                    
                    $getgd=mysqli_query($conn,"SELECT giaodich.content,giaodich.monney,giaodich.thoigian,giaodich.id FROM giaodich INNER JOIN dangki ON giaodich.id_khachhang=dangki.id WHERE giaodich.id_khachhang='$id' ORDER BY giaodich.id DESC");
                    if(mysqli_num_rows($getgd)>0){
                        while($rowgd=mysqli_fetch_array($getgd)){
                            $content="";
                            $idgd=$rowgd['id'];
                            $monney="";
                            $time=$rowgd['thoigian'];
                            if($rowgd['content'] == 1){
                                $content="Nạp tiền ví Q_pay";
                                $monney="+".$rowgd['monney'];
                            }elseif($rowgd['content'] == 2 ){
                                $content="Thanh toán đơn hàng";
                                $monney="-".$rowgd['monney'];
                            }
                            ?>
                            <table style="border-bottom: 1px solid gray;">
                            <tr>
                                <th>Mã giao dịch: </th>
                                <td><?= $idgd?></td>
                            </tr>
                            <tr>
                                <th>Nội dung: </th>
                                <td><?= $content?></th>
                            </tr>
                            <tr>
                                <th>Tài khoản: </th>
                                <td><?= $monney?> vnd</td>
                            </tr>
                            <tr>
                                <th>Thời gian giao dịch: </th>
                                <td><?= $time?></td>
                            </tr>
                            </table>
                   
                   
                        <?php
                         }
                    }else{
                         echo"<h3 style='color:red;'>Không có giao dịch</h3>";   
                    }
                    ?>
                </div>
            </div>
          </div>
          <div class="col-2"></div>
      </div>
    </div>
</body>
</html>