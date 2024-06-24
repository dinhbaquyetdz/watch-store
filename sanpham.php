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
//id người đang nhập
$id=$row1['id'];
//số lượng sản phẩm trong giỏ hàng
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
    <title>Sản phẩm</title>
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
  .col-6.col-sm-4.col-lg-4{
    background-color: white;
    border-radius: 5px;
    margin-top: 5px;
   font-size: 12px;
   font-family: Arial, Helvetica, sans-serif;
  }
  .col-6.col-sm-4.col-lg-4>a{
    text-decoration: none;
    font-size: 20px;
  }
  .col-6.col-sm-4.col-lg-4>.row>.col-12>h4{
    text-align: center;
    font-size: 20px;
  }
  .col-6.col-sm-4.col-lg-4>.row>.col-12>h4>a{
    text-decoration: none;
    color: red;
  }
  .col-6.col-sm-4.col-lg-4>.row>.col-12>h4>a:hover{
    color: blue;
  }
  .col-6.col-sm-4.col-lg-4:hover{
    position: relative;
    bottom:5px;
    left: 5px;
    border: 1px solid aquamarine;
    border-style: outset;
    /* box-shadow: 5px saddlebrown; */
  }
  .col-6.col-sm-4.col-lg-4>a:hover{
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
.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination a {
    display: inline-block;
    padding: 5px 10px;
    margin-right: 5px;
    background-color: #f1f1f1;
    text-decoration: none;
    color: #333;
    border-radius: 3px;
}

.pagination a:hover {
    background-color: #ddd;
}

.pagination .active {
  display: inline-block;
    padding: 5px 10px;
    margin-right: 5px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 3px;
}
</style>
<body >
    <div class="container-fluid w-100">
    <div class="row sticky-top " style="z-index: 2;">
      <div class="header  shadow pb-1 mb-2">
      <div class="row" >
          <div class="col-12 px-0" >
            <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark" >
              <!-- <div class="container-fluid" > -->
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
              
            </nav>
          </div>
      </div>
      </div>
      </div>
      <div class="row">
        <div class="col-1"></div>
        <div class="col-2 ">
          <div class="row sticky-top" style="z-index: 1; max-width: 150px;">
          <div class="row ">
               <a href="sanpham.php"><h5 style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: red; margin-bottom: 10px; border-bottom: 1px solid palevioletred">Sản phẩm</h5></a> 
            </div>
            <div class="row">
            <ul>
                
                <h5 style="font-weight: 500;border-bottom: 2px solid gainsboro; max-width: 130px;">Thương hiệu</h5>
                <?php
                $th=mysqli_query($conn,"SELECT DISTINCT `thuonghieu` FROM `list`");
                while($rowth=mysqli_fetch_array($th)){
                $getth=$rowth['thuonghieu'];
                ?>
                <a style="border-bottom: 2px solid gainsboro;max-width: 200px;" href="sanpham.php?TH=<?=$getth?>"><li><?= $getth ?></li></a>
                <?php
                }
                ?> 
                </ul>
               
                <ul>
                <h5 style="font-weight: 500;border-bottom: 2px solid gainsboro;max-width: 130px;">Xuất xứ</h5>
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
               
                <ul>
                <h5 style="font-weight: 500;border-bottom: 2px solid gainsboro;max-width: 130px;">Đối tượng</h5>
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
               
                <ul>
                <h5 style="font-weight: 500;border-bottom: 2px solid gainsboro;max-width: 130px;">Bộ máy</h5>
                <?php
                $bm=mysqli_query($conn,"SELECT DISTINCT `bomay` FROM `list`");
                while($rowbm=mysqli_fetch_array($bm)){
                $getbm=$rowbm['bomay'];
                ?>
                <a href="sanpham.php?BM=<?= $getbm?>"><li><?= $getbm ?></li></a>
                <?php
                }
                ?> 
                
                

            </div>
        </div>
          </div>
            
        <div class="col-8">
          <div class="row mt-5">
          <div class="row" style="height: auto;">
      <?php
      $getsl=mysqli_query($conn,"SELECT * FROM list");
      $demsp=mysqli_num_rows($getsl);
        // Số mục hiển thị trên mỗi trang
        $mucHienThi = 9;

        // Tổng số mục
        $tongMuc = $demsp;

        // Tính tổng số trang
        $tongTrang = ceil($tongMuc / $mucHienThi);

        // Xác định trang hiện tại
        $trangHienTai = isset($_GET['page']) ? $_GET['page'] : 1;

        // Xác định mục bắt đầu và kết thúc của trang hiện tại
        $mucBatDau = ($trangHienTai - 1) * $mucHienThi;
        $mucKetThuc = $mucBatDau + $mucHienThi;

       $get="";
       if(isset($_GET['search'])){
         $search=$_GET['boxsearch'];
         $get=mysqli_query($conn,"SELECT * FROM list WHERE name LIKE '%$search%' OR infor LIKE '%$search%' OR gia LIKE '%$search%' LIMIT $mucBatDau, $mucHienThi");

          }elseif(isset($_GET['TH'])){
             $TH=$_GET['TH'];
             $get=mysqli_query($conn,"SELECT * FROM list WHERE thuonghieu='$TH' LIMIT $mucBatDau, $mucHienThi");
           
          }elseif(isset($_GET['XX'])){
            $XX=$_GET['XX'];
            $get=mysqli_query($conn,"SELECT * FROM list WHERE xuatxu='$XX' LIMIT $mucBatDau, $mucHienThi");
          
          }elseif(isset($_GET['DT'])){
            $DT=$_GET['DT'];
            $get=mysqli_query($conn,"SELECT * FROM list WHERE doituong='$DT' LIMIT $mucBatDau, $mucHienThi");
            
          }elseif(isset($_GET['BM'])){
            $BM=$_GET['BM'];
            $get=mysqli_query($conn,"SELECT * FROM list WHERE bomay='$BM' LIMIT $mucBatDau, $mucHienThi");
          
          }else{
            $get=mysqli_query($conn,"SELECT * FROM list LIMIT $mucBatDau, $mucHienThi");
            }
          $dem=mysqli_num_rows($get);

          if($dem == 0){
             echo"<h1 style='color:red;' class='text-center'>Không có sản phẩm</h1>";
          }else{
           $count=0;
           $i=0;
           while($row=mysqli_fetch_array($get)){
           $count=$count+1;
          //  $i +=1;
          $sl=$row['soluong'];
           $name=$row['name'];
           $infor=$row['infor'];
           $mota=$row['mota'];
           $gia=$row['gia'];
           $id=$row['id'];
           echo"
          
           <div class='col-6 col-sm-4 col-lg-4'>
           <a href='CTsanpham.php?idsp=$id'><img src='photo/".$row['image']."' class='w-100 h-40 rounded' alt=''></a>";?>
             <a href="CTsanpham.php?idsp=<?php echo $id ?>"><?php echo substr("$name $infor",0,30)."...";?> còn: <?php echo $sl." chiếc" ?></a>
             <?php echo "
              <div class='row'>
               <div class='col-12'>";?>
                 <h4><a href="CTsanpham.php?idsp=<?php echo $id ?>"><?php echo"<b>Giá: $gia vnđ</b>";?></a></h4>
               <?php echo"</div>
              </div>";?>
              <a style='text-decoration: none; color: black;' href="buy.php?idsp=<?php echo $id ?>"><button type='button' class='btn btn-light w-75'>Buy</button></a><a href="CTsanpham.php?idsp=<?php echo $id ?> ?>"><img src='image/giỏ hàng.jpg' class='w-25'></a>
           <?php echo "</div>
           ";
          //  if($i==4){
          //    echo"
          //    <div class='col-12 col-sm-12 col-lg-4'>
          //    </div>
          //    <div class='col-12 col-sm-12 col-lg-4'>
          //    </div>
          //    ";
          //    $i=0;
          //  }
         }
          }
         
         ?>
        
          </div>
          <div class="row">
            <div class="col-5"></div>
            <div class="col-2">
            <!-- phân trang -->
            <div class="pagination">
                    <?php
                    // Hiển thị các liên kết phân trang
                    if ($tongTrang > 1) {
                        if ($trangHienTai > 1) {
                            echo "<a href='?page=1'>&laquo;</a>"; // Liên kết đến trang đầu tiên
                            echo "<a href='?page=" . ($trangHienTai - 1) . "'>&lsaquo;</a>"; // Liên kết đến trang trước đó
                        }

                        for ($i = max(1, $trangHienTai - 2); $i <= min($trangHienTai + 2, $tongTrang); $i++) {
                            if ($i == $trangHienTai) {
                                echo "<span class='active'>$i</span>"; // Trang hiện tại
                            } else {
                                echo "<a href='?page=$i'>$i</a>"; // Các trang khác
                            }
                        }

                        if ($trangHienTai < $tongTrang) {
                            echo "<a href='?page=" . ($trangHienTai + 1) . "'>&rsaquo;</a>"; // Liên kết đến trang kế tiếp
                            echo "<a href='?page=$tongTrang'>&raquo;</a>"; // Liên kết đến trang cuối cùng
                        }
                    }
                    ?>
              </div>

            </div>
            <div class="col-5"></div>
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