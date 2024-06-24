<?php
session_start();
require "connect_sql.php";
if($_SESSION['email1'] == null){
    header("location: loginadmin.php");
}
$mail=$_SESSION['email1'];
$name=mysqli_query($conn,"SELECT * FROM dangki Where email1='$mail'");
$row = mysqli_fetch_array($name);
$a = $row['ten'];
$id=$row['id'];
$getkh=mysqli_query($conn,"SELECT * FROM dangki WHERE level='1'");
$getsp=mysqli_query($conn,"SELECT * FROM list");
$getdh=mysqli_query($conn,"SELECT * FROM donhang");
$getsl=mysqli_query($conn,"SELECT `soluong` FROM list");
$rowkh=mysqli_num_rows($getkh);
// $rowsp=mysqli_num_rows($getsp);
$rowsp=0;
while($row1=mysqli_fetch_array($getsl)){
    $rowsp +=$row1['soluong'];
}
$rowdh=mysqli_num_rows($getdh);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script> -->
    <title>Document</title>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="row sticky-top"  >
                <nav class="navbar bg-dark border-bottom border-body bg-opacity-75 sticky-top" data-bs-theme="dark">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-1 h1">Watch Store</span>
                    </div>
                </nav>
                </div>
                <div class="row sticky-to position-fixed" style="height: 690px; width:256px;">
                <nav class="nav flex-column bg-dark bg-gradient m-0 p-0  ">
                <form method="post">
                    <input type="search" name="boxsearch" placeholder="Search..." class="m-0 w-75 bg-dark bg-gradient p-1 rounded text-white">
                    <input type="submit" value="Search" name="search" class="btn btn-outline-dark text-white m-0 px-1">
                    <select name="search1" id="" class="m-0 w-75 bg-dark bg-gradient p-1 rounded text-white">
                        <option value="0">Lọc danh sách sản phẩm</option>
                        <option value="rolex">rolex</option>
                        <option value="Omega">Omega</option>
                        <option value="Cartier">Cartier</option>
                        <option value="Longines">Longines</option>
                    </select>
                </form>
                <div class="bg-dark bg-opacity-50 mt-2 text-center" style="color: beige;">
                
                    MAIN NAVIGATION
                </div>
                <a class="nav-link " href="adminhome.php">Số liệu tổng quan</a>
                <a class="nav-link " href="adminhome.php?idhome=<?php echo "kh"?>">Danh sách khách hàng</a>
                <a class="nav-link " href="adminhome.php?idhome=<?php echo "sp"?>">Danh sách sản phẩm</a>
                <!-- <a class="nav-link " href="adminhome.php?idhome=<?php echo "add"?>">Thêm đơn hàng</a> -->
                <a class="nav-link " href="adminhome.php?idhome=<?php echo "addsp"?>">Thêm sản phẩm</a>
                <a class="nav-link " href="logoutadmin.php?id=<?php echo $id?>">Đăng xuất</a>
                </nav>
                </div>
            
            </div>
            <div class="col-10">
                <div class="row sticky-top" >
                <nav class="navbar navbar-dark bg-secondary pb-1">
                <div class="container-fluid">
                    <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation"> -->
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <a class="navbar-brand" href="updateus.php?id=<?= $id ?>">
                    <?php 
                     if(!empty($row['image'])){echo '<img src="photo/'.$row['image'].'" alt=""  style="min-width: 30px; height: 30px; border-radius: 100%; border-color: aquamarine;padding: 0;margin: 0;">';}
                     else{?><img src="image/avtjpg.jpg" alt=""  style="min-width: 30px; height: 30px; border-radius: 100%; border-color: aquamarine; padding: 0; margin: 0;">
                     
                     <?php }
                    echo "$a"?></a>
                    <!-- </button> -->
                </div>
                </nav>
                </div>
                <div class="row " style="height: 300px; position: relative; top: 30px;">
                <div class="col-3 bg-primary-subtle mx-4 text-center shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 350px;">
                <h3 class="fw-normal">Tổng số khách hàng</h3>
                    <img src="image/logouser.png" class="w-25 h-25" alt="">
                    <h3 class="fw-normal pt-5"><?php echo $rowkh; ?></h3>
                </div>
                <div class="col-3 bg-dark-subtle mx-4 text-center shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 350px;">
                <h3 class="fw-normal">Tổng số sản phẩm</h3>
                    <img src="image/logosp.png" class="w-25 h-25" alt="">
                    <h3 class="fw-normal pt-5"><?php echo $rowsp; ?></h3>
                </div>
                <div class="col-3 bg-warning-subtle mx-4 text-center shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 350px;">
                <h3 class="fw-normal">Tổng số đơn hàng</h3>
                    <img src="image/logodonhang.png" class="w-25 h-25" alt="">
                    <h3 class="fw-normal pt-5"><?php echo $rowdh; ?></h3>
                </div>
                </div>
                <div class="row border-bottom ms-1">
                
                    <?php
                    if(isset($_GET['idhome']) && $_GET['idhome'] == "kh"){
                        echo '
                        <h3 class="fw-normal">Danh sách khách hàng</h3>
                            <table class="table table-striped table-bordered table-hover">
                        <tr>
                        <th>STT</th>
                        <th>MA_khachhang</th>
                        <th>Ảnh</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        
                        <th colspan="2">Thao tác</th>
                        </tr>
                    ';
                    if(isset($_POST['search'])){
                        $search=$_POST['boxsearch'];
                        $getkh=mysqli_query($conn,"SELECT * FROM dangki WHERE (email LIKE '%$search%' OR id LIKE '%$search%' OR email1 LIKE '%$search%') AND level='1'");
                    }
                    $count=0;
                    while($row=mysqli_fetch_array($getkh)){
                    $count=$count+1;
                    $name=$row['email'];
                    $id=$row['id'];
                    $phone=$row['phone'];
                    $image=$row['image'];
                    echo "
                    <tr>
                        <th>$count</th>
                        <th> $id</th>
                        ";?>
                        <th>
                        <?php
                        if(!empty($row['image'])){echo '<img src="photo/'.$row['image'].'" alt=""  style="width: 30px; max-height: 30px; border-radius: 100%; border-color: aquamarine;padding: 0; ">';}
                        else{?><img src="image/avtjpg.jpg" alt=""  style="width: 30px; max-height: 30px; border-radius: 100%; border-color: aquamarine; padding: 0;"><?php } ?>
                        </th>
                        <?php
                        echo "<th>$name</th>
                        <th>$phone</th>
                        <th><a href='adminhome.php?id=$id'><button type='button' class='btn btn-info'>Xem đơn hàng</button></a></th>
                        <th><a href='delete.php?id=$id'><button type='button' class='btn btn-danger'>Xóa</button></a></th>
                    </tr>
                    ";
                    }
                    
                    echo "</table>";
                        //Hiển thị thông tin sản phẩm
                    }elseif(isset($_GET['idhome']) && $_GET['idhome'] == "sp"){
                        echo'
                        <h3 class="fw-normal">Danh sách sản phẩm</h3>
                        <table class="table table-striped table-bordered table-hover w-100">
                            <tr>
                                <th>STT</th>
                                <th>MA_SP</th>
                                <th>ảnh</th>
                                <th>tên SP</th>
                                <th>thông tin</th>
                                <th>mô tả</th>
                             <!-- <th>ảnh</th> -->
                                <th>số lượng</th>
                                <th>giá</th>
                                
                                <th>Đánh giá</th>
                                <th colspan="2">Thao tác</th>
                            </tr>';
                            //lấy dữ liệu theo tìm kiếm
                            if(isset($_POST['search'])){
                                $search=$_POST['boxsearch'];
                                $getsp=mysqli_query($conn,"SELECT * FROM list WHERE id LIKE '%$search%' OR name LIKE '%$search%' OR infor LIKE '%$search%' OR gia LIKE '%$search%'");
                            if($_POST['search1'] != 0){
                                $search1=$_POST['search1'];
                                $getsp=mysqli_query($conn,"SELECT * FROM list WHERE id LIKE '%$search1%' OR name LIKE '%$search1%' OR infor LIKE '%$search1%' OR gia LIKE '%$search1%'");
                          
                            }
                                 }
                            $count=0;
                            while($row=mysqli_fetch_array($getsp)){
                            $count=$count+1;
                            $name=$row['name'];
                            $infor=$row['infor'];
                            $mota=$row['mota'];
                            $gia=$row['gia'];
                            $id=$row['id'];
                            $sl=$row['soluong'];
                            echo "
                            <tr>
                                <th>$count</th>
                                <th> $id</th>
                                <th><img style='max-width:50px;' src='photo/".$row['image']."' ></th>
                                <th>$name</th>
                                <th>$infor</th>
                                <th>$mota</th>
                                <th>$sl</th>
                                <th>$gia</th>
                                
                                <th><a href='adminhome.php?idsp=$id''><button type='button' class='btn btn-info'>Comment</button></a></th>
                                <th><a href='updatesp.php?id=$id'><button type='button' class='btn btn-primary'>Sửa</button></a></th>
                                <th><a href='deletesp.php?id=$id'><button type='button' class='btn btn-danger'>Xóa</button></a></th>
                            </tr>
                            ";
                            }
                           
                        echo "</table>";
                        
                    // }elseif(isset($_GET['idhome']) && $_GET['idhome'] == "add"){
                    //     echo '
                    //     <h3 class="fw-normal">Thêm đơn hàng</h3>
                    //         <form action="" method="post">
                    //         <label for="">Ma_khachhang: </label>
                    //         <input type="text" name="makh" placeholder="Nhập mã khách hàng">
                    //         <label for="">Ma_sanpham: </label>
                    //         <input type="text" name="masp" placeholder="Nhập mã sản phẩm">
                    //         <input type="submit" name="add" value="add">
                    //         </form>   
                    //     ';
                    //     if(isset($_POST['add'])){
                    //         $kh=$_POST['makh'];
                    //         $sp=$_POST['masp'];
                    //         $sql="INSERT INTO donhang(`id_sp`,`id_khachhang`) VALUE ('$sp','$kh')";
                    //         if($conn->query($sql)===true){
                    //             echo "<p style='color:blue;'>them thanh cong<p>";
                    //         }else{
                    //             echo "<p style='color:red;'>that bai<p>";
                    //         }
                    //     }
                    }
                    //phần cmt khi click và tên sp
                    elseif(isset($_GET['idsp'])){
                        echo'
                        <h3 class="fw-normal">Đánh giá</h3>
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Email</th>
                                <th>Đánh giá</th>
                                <th>Thao tác</th>
                            </tr>';
                        $idsp=$_GET['idsp'];
                        $dem=0;
                        //lấy dữ liệu đánh giá
                            $getcmt=mysqli_query($conn,"SELECT dangki.image,dangki.email,comment.cmt,comment.id FROM comment INNER JOIN list ON comment.id_sp=list.id INNER JOIN dangki ON comment.id_khachhang=dangki.id WHERE comment.id_sp='$idsp'");
                            while($rowcmt=mysqli_fetch_array($getcmt)){
                                $dem +=1;
                                $idcmt=$rowcmt['id'];
                                $tensp=$rowcmt['image'];
                                $tenus=$rowcmt['email'];
                                $cmt=$rowcmt['cmt'];
                               
                                echo"
                                <tr>
                                <th>$dem</th>"?>
                                <th>
                                <?php
                                if(!empty($rowcmt['image'])){echo '<img src="photo/'.$rowcmt['image'].'" alt=""  style="width: 30px; max-height: 30px; border-radius: 100%; border-color: aquamarine;padding: 0; ">';}
                                else{?><img src="image/avtjpg.jpg" alt=""  style="width: 30px; max-height: 30px; border-radius: 100%; border-color: aquamarine; padding: 0;"><?php } ?>
                                </th>
                                <?php
                                echo "<th>$tenus</th>
                                <th>$cmt</th>
                                <th><a href='deletecmt.php?id=$idcmt'><button type='button' class='btn btn-danger'>Xóa</button></a></th>
                            </tr>
                                ";
                            }
                    }
                    elseif(isset($_GET['idhome']) && $_GET['idhome'] == "addsp"){
                        echo '';?>
                        
                        <h3 class="fw-normal text-center">Thêm sản phẩm</h3>
                        <table class="table-striped rounded p-5 " style="position: relative;left:400px;">
                        <form action="" method="post" enctype="multipart/form-data">
                        <tr>
                        <th><label for="">Name: </label></th>
                        <td><input type="text" name="name" placeholder="Nhập tên sản phẩm"></td>
                        </tr>
                        <tr>
                        <th><label for="">Thông tin: </label></th>
                        <td> <input type="text" name="infor" placeholder="Nhập thông tin sản phẩm" max="30"></td>
                        </tr>    
                        <tr>
                        <th><label for="">Mô tả: </label></th>
                        <td><input type="text" name="mota" placeholder="Mô tả sản phẩm"></td>
                        </tr>
                        <tr>
                        <th><label for="">Giá: </label></th>
                        <td><input type="text" name="gia" placeholder="Nhập giá sản phẩm"></td>
                        </tr>
                        <tr>
                        <th><label for="">Số lượng: </label></th>
                        <td> <input type="number" name="soluong" value="1"></td>
                        </tr>
                        <tr>
                        <th><label for="">Thương hiệu: </label></th>
                        <td> <input type="text" name="thuonghieu" placeholder="Nhập thương hiệu"></td>
                        </tr>
                        <tr>
                        <th><label for="">Xuất xứ: </label></th>
                        <td> <input type="text" name="xuatxu" placeholder="Nhập xuất xứ"></td>
                        </tr>
                        <tr>
                        <th><label for="">Năm sản xuất: </label></th>
                        <td> <input type="text" name="namsx" placeholder="Nhập năm sản xuất"></td>
                        </tr>
                        <tr>
                        <th><label for="">Chất liệu: </label></th>
                        <td> <input type="text" name="chatlieu" placeholder="Nhập chất liệu"></td>
                        </tr>
                        <tr>
                        <th><label for="">Đường kính: </label></th>
                        <td> <input type="text" name="duongkinh" placeholder="Nhập đường kính(mm)"></td>
                        </tr>
                        <tr>
                        <th><label for="">Đối tượng: </label></th>
                        <td> <select name="doituong" id="">
                            <option value="1">trẻ em</option>
                            <option value="1">nam</option>
                            <option value="1">nữ</option>
                        </select></td>
                        </tr>
                        <tr>
                        <th><label for="">Hình ảnh: </label></th>
                        <td><input type="hidden" name="size" value="1000000">
                            <input type="file" name="image"> 
                        </td>
                        </tr>   
                        <tr><td colspan="2"><button type="submit" name="add" value="add" class="btn btn-info">ADD</button></td></tr>
                        </form>
                        </table>
                        <?php 
                        if(isset($_POST['add'])){
                            $name=$_POST['name'];
                            $infor=$_POST['infor'];
                            $mota=$_POST['mota'];
                            $gia=$_POST['gia'];
                            $sl=$_POST['soluong'];
                            $file_name = $_FILES['image']['name'];
                            $file_size = $_FILES['image']['size'];
                            $file_tmp = $_FILES['image']['tmp_name'];
                            $file_type = $_FILES['image']['type'];
                            $file_parts =explode('.',$_FILES['image']['name']);
                            $file_ext=strtolower(end($file_parts));
                            $expensions= array("jpeg","jpg","png");
                            if(in_array($file_ext,$expensions)=== false){
                            $errors[]="Chỉ hỗ trợ upload file JPEG hoặc PNG.";
                            }
                            if($file_size > 2097152) {
                            $errors[]='Kích thước file không được lớn hơn 2MB';
                            }
                            $image = $_FILES['image']['name'];
                            $target = "image/".basename($image);
                            if(!empty($name) && !empty($infor) && !empty($mota) && !empty($gia)){
                                $sql=mysqli_query($conn,"INSERT INTO list(name,infor,mota,gia,image,soluong) VALUES ('$name','$infor','$mota','$gia','$image','$sl')");
                                
                            }else{
                                echo "thong tin con thieu";
                            }
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                                echo '<script language="javascript">alert("Đã upload thành công!");</script>';
                                }else{
                                echo '<script language="javascript">alert("Đã upload thất bại!");</script>';
                                }
                        }
                    }elseif(isset($_GET['id']) && $_GET['id'] != null){
                        $id=$_GET['id'];
                        $sql=mysqli_query($conn,"SELECT donhang.thanhtoan,donhang.thoigian,list.name,list.mota,donhang.id,donhang.address,list.gia,donhang.soluong,donhang.trangthai FROM `donhang` INNER JOIN dangki ON donhang.id_khachhang=dangki.id INNER JOIN list ON donhang.id_sp=list.id WHERE dangki.id='$id' ORDER BY donhang.id DESC;");
                        if(isset($_POST['search'])){
                            $search=$_POST['boxsearch'];
                            $sql=mysqli_query($conn,"SELECT donhang.thanhtoan,donhang.thoigian,list.name,list.mota,donhang.id,donhang.address,list.gia,donhang.soluong,donhang.trangthai FROM `donhang` INNER JOIN dangki ON donhang.id_khachhang=dangki.id INNER JOIN list ON donhang.id_sp=list.id WHERE  list.name LIKE '%$search%' OR list.mota LIKE '%$search%' AND dangki.id='$id';");
                        if($_POST['search1'] != 0){
                            $search1=$_POST['search1'];
                            $sql=mysqli_query($conn,"SELECT donhang.thanhtoan,donhang.thoigian,list.name,list.mota,donhang.id,donhang.address,list.gia,donhang.soluong,donhang.trangthai FROM `donhang` INNER JOIN dangki ON donhang.id_khachhang=dangki.id INNER JOIN list ON donhang.id_sp=list.id WHERE  list.name LIKE '%$search1%' OR list.mota LIKE '%$search1%'  AND dangki.id='$id';");
                      
                        }
                             }
                        echo '
                        <h3 class="fw-normal">Danh sách đơn hàng</h3>
                        <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tên đơn hàng</th>
                            <th>Thanh toán</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Giao đến</th>
                            <th>Trạng thái</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Thao tác</th>
                        </tr>';
                        $count=0;
                        while($row=mysqli_fetch_array($sql)){
                            $count=$count+1;
                            $a=$row['id'];
                            $name=$row['name'];
                            $tt=$row['thanhtoan'];
                            $gia=$row['gia'];
                            $sl=$row['soluong'];
                            $address=$row['address'];
                            $time=$row['thoigian'];
                            $thanhtoan="";
                            if($row['thanhtoan'] == 1){
                                $thanhtoan="trả tiền mặt";
                            }elseif($row['thanhtoan'] == 2){
                                $thanhtoan="trả qua tài khoản";
                            }
                            $tt="";
                            if($row['trangthai'] == 0){
                                $tt="Chờ xác nhận";
                            }elseif($row['trangthai'] == 1){
                                $tt="Đã xác nhận";
                            }elseif($row['trangthai'] == 2){
                                $tt="Đang giao hàng";
                            }elseif($row['trangthai'] == 3){
                                $tt="Đã nhận hàng";
                            }
                            echo "
                            <tr>
                            <td>$count</td>
                            <td>$a</td>
                            <td>$name</td>
                            <td>$thanhtoan</td>
                            <td>$sl</td>
                            <td>".$sl*$gia."</td>
                            <td>$address</td>
                            <td><a href='adminhome.php?iddh=$a'>$tt</a></td>
                            <td>$time</td>
                            <td><a href='deletedonhang.php?id=$a'><button type='button' class='btn btn-danger'>Xóa</button></a></td>
                            </tr>
                            ";
                        }
                        
                    echo "</table>";
                    }elseif(isset($_GET['iddh'])){
                        $iddh=$_GET['iddh'];
                        ?>
                        <form action="" method="post" class="text-center mt-5">
                           
                            <select name="tt" id="">
                                <option value="0">Chờ xác nhận</option>
                                <option value="1">Đã xác nhận</option>
                                <option value="2">Đang giao hàng</option>
                                <option value="3">Đã nhận</option>
                            </select>
                            <br>
                            <button type="submit"  name="xn" class="btn btn-outline-success mt-3">Xác nhận</button>
                        </form>
                    <?php
                    if(isset($_POST['xn'])){
                        $tt=$_POST['tt'];
                        $udtt="UPDATE donhang set trangthai='$tt' WHERE id=$iddh";
                        if($conn->query($udtt)===true){
                            echo "<p class='text-center' style='color:blue;'>Xác nhận thành công</p>";
                        }else{
                            echo "<p class='text-center' style='color:blue;'>Xác nhận thất bại</p>";
                        }
                    }
                    
                    }
                    ?>
                
                <?php
                $conn->close();
                ?>
                </div>
            </div>
        
        </div>
       
   
    </div>
</body>
</html>