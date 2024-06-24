<?php
session_start();
if($_SESSION['email'] == null ){
    header("location: home.php");
}
require "connect_sql.php";
$mail =  $_SESSION['email'] ;
//lấy thông tin người đang nhập
$query1 =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail' AND level='1'");
$row1 = mysqli_fetch_array($query1);
$a = $row1['ten'];
$get=mysqli_query($conn,"SELECT * FROM list");
//lấy thông tin người đang nhập
// $query =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail' AND level='1'");
// $row=mysqli_fetch_assoc($query);
//id người đang nhập
$id=$row1['id'];
//ví online
$wallet=$row1['wallet'];
//địa chỉ giao hàng
$address=$row1['address'];
$checkgh=mysqli_query($conn,"SELECT * FROM giohang WHERE id_khachhang='$id'");
$num=mysqli_num_rows($checkgh);
//lấy id sp
if(isset($_GET['idsp'])){
    $idsp=$_GET['idsp'];
    $query2 =mysqli_query($conn,"SELECT * FROM `list` WHERE id = '$idsp'");
    $row2=mysqli_fetch_assoc($query2);

       //lấy dữ liệu các bài đánh giá
  $query4=mysqli_query($conn,"SELECT dangki.ho,dangki.ten,dangki.image,comment.cmt FROM comment INNER JOIN dangki ON comment.id_khachhang=dangki.id WHERE comment.id_sp='$idsp'"); 
 
  }
// mua hàng
if(isset($_GET['iddh'])){
$iddh=$_GET['iddh'];
// $query3 =mysqli_query($conn,"SELECT * FROM `list` WHERE id = '$iddh'");
//   //khi thêm sẽ trừ đi số lượng sản phẩm
//   while($row3=mysqli_fetch_array($query3)){
//     $slsau=$row3['soluong'];
//     $price=$row3['gia'];
//     if($slsau > 0){
//       $slsau -=1;
//       $wallet -= $price;
//       $addgh="INSERT INTO donhang (`id_sp`,`id_khachhang`,`address`) VALUES ('$iddh','$id','$address')";
//       $updatesp=mysqli_query($conn,"UPDATE list SET soluong='$slsau' WHERE id='$iddh'");
//       $updateus=mysqli_query($conn,"UPDATE dangki SET wallet='$wallet' WHERE id='$id'");
//         $deletegh=mysqli_query($conn,"DELETE FROM giohang WHERE id_sp='$iddh' AND id_khachhang='$id'");
//         // if($conn->query($deletegh)===true){
//         //     echo "xóa xong";
//         // }else{
//         //     echo "không xóa dc";
//         // }
      
//       if($conn->query($addgh)===true){
//         header("location: shop.php");
//     }
//     }elseif($slsau <= 0){
//         header("location: shop.php");
//     }
// }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>ĐẶT HÀNG</title>
</head>
<style>
   li{
    list-style-type: none;
  }
  a{
    text-decoration: none;
  }
body{
    background-color: azure;
    width: 100%;
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
table,th,td{
    padding: 8px;
}
</style>
<body>
    <div class="container-fluid">
    <!-- menu -->
    <div class="header sticky-top shadow pb-1 mb-2" >
      <div class="row " >
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
                  <form class="d-flex" role="search">
                    <input class="form-control me-2" style="min-width: 500px;" type="search" placeholder="Search . . ." aria-label="Search">
                    <button class="btn btn-outline-success " type="submit">Search</button>
                    
                    <a href="giohang.php?idus=<?php echo $id?>" class="shop"><img src="image/snapedit_1693557303745.png" style="width: 50px; padding: 0;border-radius: 5px; border-color:aquamarine; margin-left: 10px;"></a>
                    <p style="z-index: 1; color: red;"><?php echo $num?></p>
                    
                          <!-- <button style="width: 200px; border-radius: 5px; border-color: aquamarine; margin-left: 10px;"><a href="login.php" style="text-decoration: none;color: aliceblue;">Đăng Nhập</a></button> -->
                  <div class="dropdown">
                      <span><?php if(!empty($row1['image'])){echo '<img src="photo/'.$row1['image'].'" alt=""  style="width: 50px; height: 50px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">';}
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
<!-- content -->
    <div class="row mt-5">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="row" style="max-height: 500px;"></div>
            <div class="row shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="col-5 ps-5">
                <!-- ảnh sản phẩm -->
                <?php
                        if(!empty($row2['image'])){echo '<img src="photo/'.$row2['image'].'" alt=""  style="max-width: 500px; height: 400px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">';}
                        else{?><img src="image/avtjpg.jpg" alt=""  style="max-width: 500px; height: 400px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">
        
                <?php }?>
                </div>
                <div class="col-7 p-5">
                <table >
                            <?php
                            if($row2){

                                $id=$row2['id'];
                                $name=$row2['name'];
                                $infor=$row2['infor'];
                                $mota=$row2['mota'];
                                $gia=$row2['gia'];
                                $image=$row2['image'];
                                
                                echo "
                                <tr>
                                <th>Mã sản phẩm: </th>
                                <td><h4> $id</h4></td>
                                </tr>
                                <tr>
                                <th>Tên sản phẩm: </th>
                                <td><h4> $name</h4></td>
                                </tr>
                                <th>Giá: </th>
                                <td><h4> $gia vnđ</h4></td>
                                </tr>
                                <tr>
                                <th>Thông tin: </th>
                                <td><h4> $infor</h4></td>
                                </tr>
                                <tr>
                                <th>Mô tả: </th>
                                <td><h4> $mota</h4></td>
                                </tr>
                                <tr>
                                <tr>
                                <th>Giao đến: </th>
                                <td><h4> $address</h4></td>
                                </tr>
                                <tr>";?>
                                <td><a style='text-decoration: none; color: black;' href="buy.php?idsp=<?php echo $id ?>"><button type="submit" name="mua" class="btn btn-info">Mua</button></a></td>
                                <td><a href="buy.php?idsp=<?php echo $id ?>"><img src='image/giỏ hàng.jpg' style="width: auto; height: 50px;"></a></td>
                                <?php echo "</tr>
                                ";
                                }?>
                             
                            </table>
                </div>
            </div>
            <div class="row shadow p-3 mb-5 bg-body-tertiary rounded">
            <h3 class="border-bottom border-info">Các đánh giá</h3>
                <div class="row">
                  <div class="col-10">
                    <table>
                    <?php
                      while($row4=mysqli_fetch_array($query4)){
                        $ho=$row4['ho'];
                        $ten=$row4['ten'];
                        $cmt=$row4['cmt'];
                        echo "<tr>
                                <td>";
                                if(!empty($row4['image'])){echo '<img src="photo/'.$row4['image'].'" alt=""  style="width: 50px; height: 50px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">';}
                                else{?><img src="image/avtjpg.jpg" alt=""  style="max-width: 100px; height: 100px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;"><?php }
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
                  <div class="col-2"></div>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
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