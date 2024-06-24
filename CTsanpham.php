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
    $sl=$row2['soluong'];
    $query4=mysqli_query($conn,"SELECT dangki.ho,dangki.ten,dangki.image,comment.cmt FROM comment INNER JOIN dangki ON comment.id_khachhang=dangki.id WHERE comment.id_sp='$idsp'"); 
  }
 //thêm giỏ hàng
if(isset($_POST['gio'])){
  $soluong=$_POST['soluong'];
$query5 =mysqli_query($conn,"SELECT * FROM `list` WHERE id = '$idsp'");
//khi thêm sẽ ktra số lượng sản phẩm
while($row5=mysqli_fetch_array($query5)){
  $slsau=$row5['soluong'];
  if($slsau > 0){
    // $slsau -=1;
    $addgh="INSERT INTO giohang (`id_sp`,`id_khachhang`,`soluong`) VALUES ('$idsp','$id','$soluong')";
    // $updatesp=mysqli_query($conn,"UPDATE list SET soluong='$slsau' WHERE id='$idgh'");
    if($conn->query($addgh)===true){
      header("location: giohang.php");
  }
  }elseif($slsau <= 0){
    echo "<script>alert('Sản phẩm đã hết!!!')</script>";
   
  }
 
}
}

 
 
//số lượng hàng trong giỏ
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
    <title>Chi tiết sản phẩm</title>
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
                  <form class="d-flex" role="search" method="post">
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
      <div class="row">
        <div class="col-2"></div>
        <div class="col-4">
        <?php if(!empty($row2['image'])){echo '<img src="photo/'.$row2['image'].'" alt="" class="w-100" style=" border-radius: 100%; border-color: aquamarine; margin: 0 15px;">';}
                                  else{?><img src="image/avtjpg.jpg" alt=""  style="width: 50px; height: 50px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">
            <?php } ?>
        </div>
        <div class="col-1"> </div>
        <div class="col-4">
        <div class="row">
        <h5 >
        <a href="shop.php" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin-bottom: 10px; ">Trang chủ</a><span style="color: gray;">/</span>
        <a href="sanpham.php" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin-bottom: 10px; ">Sản phẩm</a><span style="color: gray;">/</span>
        <a href="CTsanpham.php?idsp=<?= $idsp?>" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: red; margin-bottom: 10px; "><?=$row2['name'] ?></a>
        </h5>
        </div>
       <div class="row">
        <?php 
        $query2 =mysqli_query($conn,"SELECT * FROM `list` WHERE id = '$idsp'");
        while($row2=mysqli_fetch_assoc($query2)){
          $tensp=$row2['name'];
          $xx=$row2['xuatxu'];
          $dk=$row2['duongkinh'];
          $th=$row2['thuonghieu'];
          $bm=$row2['bomay'];
          $dt="";
          $gia=($row2['gia']);
          $tt=$row2['infor'];
          $mt=$row2['mota'];
          $namsx=$row2['namsx'];
          $cl=$row2['chatlieu'];
          $ma=$row2['id'];
          if($row2['doituong']==1){
            $dt="trẻ em";
          }elseif($row2['doituong'] == 2){
            $dt="nữ";
          }elseif($row2['doituong'] == 3){
            $dt="nam";
          }

          echo "<h2 > $tensp hàng $xx đường kính $dk mm $dt </h2>" ; ?>
          <span style=" border-bottom: 1px solid gray; width: 50px; opacity: 0.8;"></span>
          <p style="color: red; font-size: 30px; font-weight: 600;" class="card-text"><?php echo number_format(floatval($row2['gia']), 0, ".", ",");?><sup> đ</sup></p>
       
       <?php
          echo "<p style='font-size: 20px;'>$tt, $tensp có đường kính $dk, chất liệu $cl dành cho $dt, $mt được sản xuất vào năm $namsx<p>" ;
      ?>
        <form action="" method="post">
          <table>
            <tr>
              <td>Số lượng: <input type="number" name="soluong" id="" min="1" max="<?= $sl?>" value="1"></td>
            </tr>
            <tr>
              <td><button type="submit" name="gio" class="btn btn-danger mt-4">Thêm giỏ hàng</button></td>
            </tr>
          </table>
        </form>
        <p style="font-size: 20px; font-weight: 500;border-top: 1px solid gray; margin-top: 10px;">Mã: <?php echo "<font color='red'>$ma</font>"?></p>
        <p style="font-size: 20px; font-weight: 500; border-top: 1px solid gray;">Danh mục: <?php echo "<a href='sanpham.php' style='color:red;'>Đồng hồ</a><span style='color:gray;'>/</span><a href='sanpham.php?TH=$th' style='color:red;'>$th</a><span style='color:gray;'>/</span><a href='sanpham.php?BM=$bm' style='color:red;'>$bm</a>"?></p>
        <?php
         }
        ?>
       </div>
       </div>
        <div class="col-1"></div>
      </div>
      <!-- đánh giá -->
       <div class="row my-5 ">
        <div class="col-1"></div>
        <div class="col-10 ">
        <h3 class="border-bottom border-info ">Các đánh giá</h3>
                <div class="row border border-top-0">
                  <div class="col-10 border-bottom">
                    <table>
                    <?php
                      while($row4=mysqli_fetch_array($query4)){
                        $ho=$row4['ho'];
                        $ten=$row4['ten'];
                        $cmt=$row4['cmt'];
                        echo "<tr>
                                <td>";
                                if(!empty($row4['image'])){echo '<img src="photo/'.$row4['image'].'" alt=""  style="width: 50px; height: 50px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">';}
                                else{?><img src="image/avtjpg.jpg" alt=""  style="max-width: 100px; height: 100px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;"><?php 
                      }
                        echo "
                                
                                $ho $ten</td>
                              </tr>
                              <tr class='border-bottom'>
                              <td>
                              $cmt
                              </td>
                              </tr>
                              ";
                        
                      }
                      ?>
                      </table>
                  </div>
                  <div class="col-1"></div>
                </div>
        </div>
        <div class="col-2"></div>
            
            </div>
      <!-- footer -->
      <div class="footer">
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
      </div>
    </div>
</body>
</html>