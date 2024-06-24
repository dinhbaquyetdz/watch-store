<?php
require "connect_sql.php";
$get=mysqli_query($conn,"SELECT * FROM dangki Where level='1'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>test</title>
</head>
<body>
    <div class="container-fluid">
        <!-- hang menu -->
        <div class="row">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="test1.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
            </nav>
        </div>
        <!-- hang t2 -->
        <!-- <div class="row">
            <div class="col-3">
                <img src="image/avata.png" class="w-100" alt="">
            </div>
            <div class="col-3">
                <img src="image/avata1.jpg" class="w-100" alt="">
            </div>
            <div class="col-3">
                <img src="image/bg1.jpg" class="w-100" alt="">
            </div>
            <div class="col-3">
                <img src="image/bg2.jpg" alt="">
            </div>
        </div>
    </div> -->
    <a href="test2.php">danh sách sản phẩm</a>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>STT</th>
            <th>MA_khachhang</th>
            <th>tên khách hàng</th>
            <th colspan="2" class="text-center">Thao tác</th>
        </tr>
        <?php
        $count=0;
        while($row=mysqli_fetch_array($get)){
        $count=$count+1;
        $name=$row['ten'];
        $id=$row['id'];
        echo "
        <tr>
            <th>$count</th>
            <th> $id</th>
            <th><a href='test4.php?id=$id'>$name</a></th>
            <th><a href='test3.php'>Thêm đơn hàng</a></th>
            <th><a href='delete.php?id=<?php echo $id?>'>Xóa</a></th>
        </tr>
        ";
        }
        ?>
    </table>
    <?php
    $conn->close();
    ?>
</body>
</html>