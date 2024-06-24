<?php 
require "connect_sql.php";

session_start();
if($_SESSION['email'] == null ){
    header("location: home.php");
}
$mail=$_SESSION['email'];
$query =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail' AND level='1'");
$row=mysqli_fetch_assoc($query);
$id=$row['id'];

//lấy thông tin người đang nhập
$a = $row['ten'];

//lấy thông tin người đang nhập
$query =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail' AND level='1'");
$row=mysqli_fetch_assoc($query);
$id=$row['id'];
//lấy thông tin sản phẩm
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>GIỎ HÀNG</title>
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
  .col-6.col-sm-4.col-lg-2{
    background-color: white;
    border-radius: 5px;
    margin-top: 5px;
   font-size: 12px;
   font-family: Arial, Helvetica, sans-serif;
  }
  .col-6.col-sm-4.col-lg-2>a{
    text-decoration: none;
    font-size: 20px;
  }
  .col-6.col-sm-4.col-lg-2>.row>.col-12>h4{
    text-align: center;
    font-size: 20px;
  }
  .col-6.col-sm-4.col-lg-2>.row>.col-12>h4>a{
    text-decoration: none;
    color: red;
  }
  .col-6.col-sm-4.col-lg-2>.row>.col-12>h4>a:hover{
    color: blue;
  }
  .col-6.col-sm-4.col-lg-2:hover{
    position: relative;
    bottom:5px;
    left: 5px;
    border: 1px solid aquamarine;
    border-style: outset;
  }
  .col-6.col-sm-4.col-lg-2>a:hover{
    text-decoration: underline;
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

</style>
<body>
    <div class="container-fluid">
      <div class="row">
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
                      <div class="dropdown-content">
                      <a href="infor_user.php"><?php echo "$a" ?></a><br>
                      <a href="logout.php" >Đăng xuất</a>
                      </div>
                  </div>  
                  
                  </form>
                </div>
              </div>
            </nav>
          </div>
      </div>
      </div>
      </div>
     
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
            <h2 >
            <a href="shop.php" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin-bottom: 10px; ">Trang chủ</a><span style="color: gray;">/</span>
            <a href="giohang.php" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin-bottom: 10px;color: red; ">Giỏ hàng</a>
            </h2>
            <?php
            //lấy dữ liệu tìm kiếm hoặc đơn hàng
            if(isset($_GET['search'])){
                $search=$_GET['boxsearch'];
                $sql=mysqli_query($conn,"SELECT list.doituong,list.duongkinh,list.name,list.image,list.infor,list.mota,list.gia,giohang.id,giohang.id_sp,giohang.soluong FROM `giohang` INNER JOIN dangki ON giohang.id_khachhang=dangki.id INNER JOIN list ON giohang.id_sp=list.id WHERE (name LIKE '%$search%' OR infor LIKE '%$search%' OR gia LIKE '%$search%') AND giohang.id_khachhang='$id'");
           
                }else{
                    $sql=mysqli_query($conn,"SELECT list.doituong,list.duongkinh,list.name,list.image,list.infor,list.mota,list.gia,giohang.id,giohang.id_sp,giohang.soluong FROM `giohang` INNER JOIN dangki ON giohang.id_khachhang=dangki.id INNER JOIN list ON giohang.id_sp=list.id WHERE giohang.id_khachhang='$id' ORDER BY giohang.id DESC");
                }
           
            ?>
            <?php
            $count=0;
            while($row=mysqli_fetch_array($sql)){
                $count=$count+1;
                $b=$row['id_sp'];
                $a=$row['id'];
                $name=$row['name'];
                $mota=$row['mota'];
                $infor=$row['infor'];
                $gia=$row['gia'];
                $sl=$row['soluong'];
                $dt="";
                if($row['doituong']==1){
                  $dt="trẻ em";
                }elseif($row['doituong'] == 2){
                  $dt="nữ";
                }elseif($row['doituong'] == 3){
                  $dt="nam";
                }
                $dk=$row['duongkinh'];
                echo "
                <div class='row p-3 mb-2 bg-body-tertiary rounded' style='height:100px;'>
                <table>
                <tr>
                <td rowspan='2' colspan='2'><img src='photo/".$row['image']."' style='width: 50px; '></td>
                <td colspan='2'>Sản phẩm</td>
                <td class='text-center'>Số lượng</td>
                <td>Giá</td>
                <td>Tổng tiền</td>
                <td><a href='deleteghus.php?id=$a'><button type='button' class='btn btn-danger'>Xóa</button></a></td>
                <td><a href='buygh.php?idgh=$a'><button type='button' class='btn btn-primary'>Mua</button></a></td>
                </tr>

                <tr>
                <td style='width: 200px;'>$name $dt $dk mm</td>
                <td></td>
                <td class='text-center'>$sl</td>
                <td style='width: 200px;'>$gia</td>
                <td style='width: 200px;'>".$gia*$sl."</td>
                </tr>
                </table>
               
                
                
                ";
           
            
                 echo "</div>"; }
            ?>
            
            </div>
            <div class="col-1"></div>
            
        </div>
<!-- footer -->
<!-- <div class="footer">
          <div class="row" style="height: 300px;">
            <div class="col-4 px-0">
              <div class="gt">
                <b style="color: brown;">THÔNG TIN CHUNG</b><br>
                <a href="">Giới thiệu</a><br>
                <a href="">Tin tức - Sự kiện</a><br> 
                <a href="">Hệ thống cửa hàng</a> <br>
                <a href="">Hướng dẫn mua hàng Online</a><br> 
                <a href="">Giao hàng & Thanh toán</a><br>
                <a href="">Liên hệ</a><br>
              </div>
            </div>
            <div class="col-4 px-0">
              <div class="gt">
                <b style="color: brown;"> HỖ TRỢ KHÁCH HÀNG</b><br>
                <a href="">Tìm hiểu mua trả góp 0%</a><br> 
                <a href=""> Chính sách & Quy định chung</a><br>
                <a href=""> Chính sách bảo hành</a> <br>
                <a href=""> Chính sách đổi hàng</a><br> 
                <a href="">Chính sách vận chuyển</a> <br>
                <a href="">Chính sách bảo mật</a>  <br>
              </div>
            </div>
            <div class="col-4 px-0">
              <div class="gt">
                <b style="color: brown;"> KẾT NỐI TỚI T</b><br>
                <a href="https://www.facebook.com/profile.php?id=100016474742675"><img src="image/fb1.png" width="50px" class="rounded">Fanpage Facebook</a><br> 
                <a href="https://www.youtube.com/channel/UCf_c4fVqg5M9NumY5qysV3g"><img src="image/youtube.jpg" width="50px" class="rounded">Kênh Youtube</a><br>
                <a href="https://chat.zalo.me/?null"><img src="image/zl.png" width="50px" class="rounded">Zalo chat</a><br>
                <a href="http://online.gov.vn/Home/WebDetails/2912?AspxAutoDetectCookieSupport=1"><img src="image/dangki.png" width="100px" class="rounded" alt=""></a> 
              </div>
            </div>
          </div>
      </div> -->
    </div>

</body>
</html>