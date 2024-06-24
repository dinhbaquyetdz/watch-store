<?php
require "connect_sql.php";
if(isset($_GET['idsp'])){
  $idsp=$_GET['idsp'];
  $query2 =mysqli_query($conn,"SELECT * FROM `list` WHERE id = '$idsp'");
  $row2=mysqli_fetch_assoc($query2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script> -->
    <link rel="stylesheet" href="flickity.css">
    <script src="flickity.js"></script>
</head>
<style>
   li{
    list-style-type: none;
  }
  a{
    text-decoration: none;
  }
  body{
    width: 100%;
  }
  /* .col-6.col-sm-4.col-lg-2{
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
    color: black;
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
  } */

  .n_bestSale {
    max-width: 1320px;
    margin: auto;
    /* margin: 0 57px; */
    padding: 25px 60px 15px;
    position: relative;
    right: -40px;
    transition: .85s ease;
}

.betSale_fadeRight {
    right: 30px !important;
}

.betSale_fadeLeft {
    right: 0 !important;
}

.products{
    display: flex;
    justify-content: space-between;
}
.n_bestSale .card{
    /* width: 23%;
    border: none; */
    height: 410px !important;
    overflow: hidden;
    border: 1px solid #d6d3d3;
}
.n_bestSale .flickity-viewport {
    height: 410px !important;
}
/* .n_bestSale .card:hover{
    border: 1px solid #d6d3d3;
} */
.n_bestSale .card a{
    overflow: hidden;
}
.n_bestSale img.card-img-top {
    transition: all 0.5s;
    transform: scale(1.18);
}
.n_bestSale .card:hover img{
    transform: scale(1.1);
    overflow: hidden;
    /* border: 1px solid #370f0f; */
    transition: filter .6s, opacity .6s, transform .6s, box-shadow .3s;
}
.n_bestSale .btn-primary {
    color: #ffffff;
    background-color: #ae7752;
}
.overlay {
    position: absolute;
    bottom: 80px;
    left: 0;
    right: 0;
    background-color: #ae7752;
    overflow: hidden;
    width: 100%;
    height: 0;
    transition: .4s ease;
    display: flex;
    justify-content: center;
  }
  .overlay .n_cart_product {
   background: url(https://theme.hstatic.net/1000135089/1000741859/14/icon-cart-option2.png?v=1) no-repeat left center;
   text-decoration: none;
    margin: 0 0 0 70px;
  }
  .n_bestSale .card:hover .overlay{
    opacity: 1;
    height: 10%;
    background: #ae775285; /* Black see-through */
}

.overlay .fas {
    font-size: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    text-align: center;
  }
  .overlay_right {
    position: absolute;
    left: 275px;
    top: 4%;
    width: 20px;
    background-color: #ba4b2370;
    overflow: hidden;
    border-radius: 80px;
    height: 8%;
    /* color: red; */
    transition: .4s ease;
    text-align: center;
  }
  /* .overlay_right .info_product {
    background: url(https://theme.hstatic.net/1000135089/1000741859/14/icon-cart-option2.png?v=1) no-repeat left center;
    
   } */
  .n_bestSale .card:hover .overlay_right{
    opacity: 1;
    width: 30%;
    left: 70%;
    transition-delay: 0.3s;
    text-decoration: none;
}
.overlay_right p{
    color: white
}
/* .overlay_right a:hover p {
    color: white;
    text-decoration: none;
    background-color: red;
} */
.overlay_right a:hover p {
    color: red;
}
.n_bestSale .card-body {
    flex: 1 1 auto;
    padding: 24px 10px 0px;
    text-align: center;
}
.title span {
    background: #fff;
    padding: 0 20px;
    z-index: 2;
    position: relative;
    display: inline-block;
    max-width: 545px;
    top: -15px;
    font-weight: 700;
    text-transform: uppercase;
    color: #492e21;
    font-weight: bold;
}
.n_bestSale .card-title {
    margin-bottom: 0;
    font-size: 18px;
    color: #3a3a3a;
    font-weight: bold;
}

.n_bestSale p.card-text {
    font-size: 15px;
    margin-bottom: 10px;
    color: #ae7752;
    font-weight: 600;
}
.n_bestSale .btn {
    display: inline-block;
    font-weight: bold;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: 5px 20px;
    font-size: 16px;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
    color: #55392a;
    background-color: #a9592426;
    border-color: #55392a;
}
.btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show>.btn-primary.dropdown-toggle:focus {
    box-shadow: none;
}
.btn-primary.focus, .btn-primary:focus {
    box-shadow: none;
}
/* external css: flickity.css */



.b_carousel .carousel_bestsale {
  background: #FAFAFA;
}

.carousel_bestsale .b_carousel-cell {
  width: 23%;
  height: 340px !important;
  margin-right: 10px;
  /* background: rgb(237, 145, 145); */
}

.carousel_bestsale .carousel-cell-image {
  display: block;
  max-height: 100%;
  margin: 0 auto;
  max-width: 100%;
  opacity: 0;
  -webkit-transition: opacity 0.4s;
          transition: opacity 0.4s;
}

/* fade in lazy loaded image */
.carousel_bestsale .carousel-cell-image.flickity-lazyloaded,
.carousel-cell-image.flickity-lazyerror {
  opacity: 1;
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
      <body >
        <div class="container-fluid">
<!-- menu -->
<div class="header sticky-top shadow pb-1 mb-2">
  <div class="row" >
          <div class="col-12 px-0" >
   <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark" >
    <div class="container-fluid" >
      <a class="navbar-brand" href="login.php">CỬA HÀNG ĐỒNG HỒ</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">Hotline: 18001008</a>
          </li>
          <div class="dropdown btn btn-tertiary">
                      <span style="color: #f9f9f9;">Danh mục sản phẩm</span>
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
                            <a href="login.php"><li><?= $getth ?></li></a>
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
                            <a href="login.php"><li><?= $getxx ?></li></a>
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
                            if($rowdt['doituong']==1){
                              $getdt="trẻ em";
                            }elseif($rowdt['doituong']==2){
                              $getdt="nữ";
                            }elseif($rowdt['doituong']==3){
                              $getdt="nam";
                            }
                            ?>
                            <a href="login.php"><li><?= $getdt ?></li></a>
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
                            <a href="login.php"><li><?= $getbm ?></li></a>
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
          <input class="form-control me-2" type="search" name="boxsearch" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success " type="submit" name="search">Search</button>
          <a href="login.php" class="shop"><img src="image/snapedit_1693557303745.png" style="width: 40px; padding: 0;border-radius: 5px; border-color:aquamarine; margin-left: 10px;"></a>
         <button style="width: 200px; border-radius: 5px; border-color: aquamarine; margin-left: 10px;"><a href="login.php" style=" text-decoration: none;color: aliceblue;">Đăng Nhập</a></button>
        </form>
      </div>
    </div>
  </nav>
  </div>
      </div>
      </div>  
  
      <!-- slide -->
  
  <div class="row">
      <div class="col-2"></div>
      <div class="col-6" style="padding: 0;">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" >
            <div class="carousel-item active" data-bs-interval="5000">
              <img src="image/slide13.jpg" class="d-block w-100 h-75" alt="...">
            </div>
            <div class="carousel-item" >
              <img src="image/slide14.jpg" class="d-block w-100 h-75" alt="...">
            </div>
            <div class="carousel-item">
              <img src="image/slide15.jpg" class="d-block w-100 h-75" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
  </div>
  <div class="col-2" style="padding: 0;">
   <img src="image/qc1.png" class="w-100 h-50">
   <img src="image/qc2.jpg" class="w-100 h-50" alt="">
  </div>
  <div class="col-2"></div>
      </div>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
        <!-- <h2 class="shadow-sm p-3 mb-5 bg-body-light rounded">Sản phẩm bán chạy</h2> -->
        </div>
        <div class="col-7"></div>
      </div>
      <!-- content -->
        
      <div class="row" style="height: auto;">
      <!-- <div class='col-12 col-sm-12 col-lg-2'>
        </div> -->
      
      <?php
      $get="";
      
      if(isset($_GET['search'])){
        $search=$_GET['boxsearch'];
        $get=mysqli_query($conn,"SELECT * FROM list WHERE name LIKE '%$search%' OR infor LIKE '%$search%' OR gia LIKE '%$search%' LIMIT 10");
    // if($_POST['search1'] != 0){
    //     $search1=$_POST['search1'];
    //     $get=mysqli_query($conn,"SELECT * FROM list WHERE name LIKE '%$search1%' OR infor LIKE '%$search1%' OR gia LIKE '%$search1%'");
  
    // }
         }else{
          $get=mysqli_query($conn,"SELECT * FROM list LIMIT 8");
         }
         
         $dem=mysqli_num_rows($get);
        
         if($dem == 0){
            echo"<h1 style='color:red;' class='text-center'>Không có sản phẩm</h1>";
         }else{
          ?>
          <div class="n_bestSale" id="bestSale">
          <div class="wpb_text_column wpb_content_element ">
            <div class="wpb_wrapper">
            <h3 class="title a-center mt-4"><span><span >Sản phẩm nổi bật</span></span></h3>
            </div>
          </div>
            <div class="main__footer-list " data-flickity= '{"pageDots": false , "draggable": true, "wrapAround": true, "autoPlay": 3000, "pauseAutoPlayOnHover": true}'>
          
          <?php    
          $count=0;
          $i=0;
          while($row=mysqli_fetch_array($get)){
          $count=$count+1;
          $i +=1;
         $sl=$row['soluong'];
          $name=$row['name'];
          $infor=$row['infor'];
          $mota=$row['mota'];
          $gia=$row['gia'];
          $id=$row['id'];?>
          <!-- echo" --
          <div class='main__footer-product'>
          <div class='col-6 col-sm-4 col-lg-2'>
          
            <img src='photo/".$row['image']."' class='w-100 h-40 rounded' alt=''>";?>
            <a href="login.php"><?php 
            // echo substr("$name $infor",0,30)."...";?> còn: <?php
            //  echo $sl." chiếc" 
            ?></a>
            <?php
            //  echo "
            //  <div class='row'>
            //   <div class='col-12'>";?>
            //     <h4><a href="login.php"><?php
            //  echo"<b>Giá: $gia vnđ</b>";
             ?></a></h4>
            //   <?php 
            //   echo"</div>
            //  </div>";
             ?>
             <a style='text-decoration: none; color: black;' href="login.php"><button type='button' class='btn btn-light w-75'>Buy</button></a><a href="login.php>"><img src='image/giỏ hàng.jpg' class='w-25'></a>
         -->
            
         <div class="main__footer-product">
                            <div class="card">
                                <a href="login.php"><img src="photo/<?php echo $row['image'] ?>" style="height: 300px; width: 300px;" alt="..."></a>
                                <div class="card-body">
                                <div class="cart-icon">
                                    <a href="login.php">
                                        <i class="fas fa-shopping-bag"><span class="tooltiptext">Thêm giỏ hàng </span></i>
                                    </a>
                                </div>
                                <h6 class="card-title text-uppercase"><a href="login.php" class="text-decoration-none text-black"><?php echo $row['name'] ?></a></h6>
                                <p class="card-text"><?php echo number_format(floatval($row['gia']), 0, ".", ",");?><sup> đ</sup></p>
                                
                                <!-- <button type="button" class="margin-left btn-add btn ">Thêm vào giỏ</button> -->
                                </div>
                            </div>
                        </div>
         <?php
          // echo "</div>
          // ";
          // if($i==4){
          //   echo"
          //   </div>
          //   <div class='col-12 col-sm-12 col-lg-2'>
          //   </div>
          //   <div class='col-12 col-sm-12 col-lg-2'>
          //   </div>

          //   ";
          //   $i=0;
          // }
        }
        ?>
        </div>
          </div>
        
       
         <?php 
         }
        
        ?>
        <!-- </div>
         <div class='col-12 col-sm-12 col-lg-2'> -->
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
                <b style="color: brown;"> KẾT NỐI TỚI DBQ</b><br>
                <a href="https://www.facebook.com/profile.php?id=100016474742675"><img src="image/fb1.png" width="50px" class="rounded">Fanpage Facebook</a><br> 
                <a href="https://www.youtube.com/channel/UCf_c4fVqg5M9NumY5qysV3g"><img src="image/youtube.jpg" width="50px" class="rounded">Kênh Youtube</a><br>
                <a href="https://chat.zalo.me/?null"><img src="image/zl.png" width="50px" class="rounded">Zalo chat</a><br>
                <a href="http://online.gov.vn/Home/WebDetails/2912?AspxAutoDetectCookieSupport=1"><img src="image/dangki.png" width="100px" class="rounded" alt=""></a> 
              </div>
            </div>
          </div>
      </div>
        </div>
        </div>
      </body>
</html>