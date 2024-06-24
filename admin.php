<?php
session_start();
require "connect_sql.php"; 
$mail=$_SESSION['email'];
$query =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail'");
$row = mysqli_fetch_array($query);
$name=$row['ten'];
 if(isset($_POST['add'])){
    $name=$_POST['name'];
    $infor=$_POST['infor'];
    $gia=$_POST['gia'];
    $mota=$_POST['mota'];
    // thêm ảnh
    if(!empty($name) && !empty($infor) && !empty($gia) && !empty($mota)){
        $check="SELECT * FROM list WHERE `name`='$name' and `infor`='$infor' and `gia`='$gia'";
        if($conn->query($check)===true){
            echo "<script>aleart('Sản phẩm đã có!!!')</script>";
        }else{
            $add=mysqli_query($conn,"INSERT INTO list(`name`,`infor`,`gia`,`mota`) VALUE ('$name','$infor','$gia','$mota')");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Quyết đca</title>
</head>
<style>
    /* .form{
        min-height: 80vh;
        border: 1px solid black;
    } */
    .form_element{
        padding: 15px 0;
    }
    .content{
        margin-top: 20px;
    }
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #99ff99;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #EEEEEE;
    }
    .search{
        float: right;
    }
</style>
<body style="background-color: aliceblue;">
    <div class="container-fluid " >
        <div class="row sticky-top">
        <nav class="navbar navbar-dark bg-dark sticky-top position-relative">
  <div class="container-fluid">
    <a class="navbar-brand " href="btvn1.php">
        <!-- <img src="img/Home.png" alt="" width="30" height="24" class="d-inline-block align-text-top"> -->
        HOME
    </a>
    <!-- <a class="navbar-brand" href="#">LIST LAPTOP</a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><?php echo $name?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <form class="d-flex mt-3" role="search" method="post">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="boxsearch">
          <button class="btn btn-success" type="submit" name="search">Search</button>
        </form>
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 mt-2">
          <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="btvn1.php">Home</a>
          </li> -->
          <li class="nav-item">
          <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Thêm sản phẩm
                </button>
                <div class="dropdown-menu dropdown-menu-dark">
                <!-- form add dữ liệu -->
                   
                <div class="form  rounded border-3 shadow p-3 mb-0 bg-body-tertiary rounded" style="text-align: center;">
                <h2 style="text-align: center; color: black;">Thêm sản phẩm</h2> 
                <form action="" method="post">
                    <div class="form_element">
                    <input type="text" class="w-75 rounded border-success-subtle" name="name" id="" placeholder="Nhập tên sản phẩm" required>
                    </div>
                <div class="form_element">
                    <input type="text" class="w-75 rounded border-success-subtle" name="gia" id="" placeholder="Giá sản phẩm" required>
                </div>
                <div class="form_element">
                    <input type="text" class="w-75 rounded border-success-subtle" name="infor" id="" placeholder="Thông tin sản phẩm" required>
                </div>
                <div class="form_element">
                    <input type="text" class="w-75 rounded border-success-subtle" name="mota" id="" placeholder="Mô tả sản phẩm" required>
                </div>
                <div class="form_element">
                <input type="hidden" name="size" value="1000000">
                    <input type="file" class="w-75 rounded border-success-subtle" name="file" id="" placeholder="Thông tin sản phẩm" >
                </div>
                    <input type="submit" class="w-50 mb-2 border border-3 rounded border-success-subtle" name="add" id="" value="Add"> 
                </form>
                </div>
                </div>
                
                </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
        </div>
        <div class="row " >
            
            <div class="col-12 ">
                <h1 class="position-relative text-center ">Danh sách Đồng hồ</h1>
                <!-- Hiển thị -->
            <div class="content">
                <table border="1px blue" style="width: 100%;">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Thông tin sản phẩm</th>
                    <th>Giá</th>
                    <th colspan="2">Thao tác</th>
                </tr>
                <?php
                if(isset($_POST['search'])){
                    $search=$_POST['boxsearch'];
                    $query="SELECT * FROM list WHERE name LIKE '%$search%' OR infor LIKE '%$search%' OR gia LIKE '%$search%'";
                }else{
                    $query="SELECT * FROM list";
                }
                $result=mysqli_query($conn,$query);
                // $data=array();
                $stt = 0;
                while($row = mysqli_fetch_array($result)){
                    $stt += 1;
                    $name = $row['name'];
                    $infor = $row['infor'];
                    $gia = $row['gia'];
                    $id = $row['id'];
                    /**
                     * Sử dụng nháy kép có thể dọc được biến
                     */
                    echo "<tr>
                    <td>$stt</td>
                    <td>$name</td>
                    <td>$infor</td>
                    <td>$gia</td>
                    <td><a href='updatesp.php?id=$id'><button type='button' class='btn btn-info'>Sửa</button></a></td>
                    <td><a href='deletesp.php?id=$id'><button type='button' class='btn btn-danger'>Xóa</button></a></td>
                    </tr>";
                }
                $conn->close();
                ?>
            
                </table>
            </div>
        </div>
</div>
</body>
</html>