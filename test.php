<?php 
require "connect_sql.php";
session_start();
$mail=$_SESSION['email'];
$query =mysqli_query($conn,"SELECT * FROM `dangki` WHERE email = '$mail' AND level='1'");
$row=mysqli_fetch_assoc($query);
$id=$row['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        
        <div class="row" style="height: 100px;">
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 shadow p-3 mb-5 bg-body-tertiary rounded">
            <a href='shop.php' style='text-decoration:none; color: black;'>X</a>
            <h1 style="text-align: center;">Thông tin sản phẩm</h1>
                <div class="row">
                    <div class="col-3">
                    <?php
                        if(!empty($row['image'])){echo '<img src="photo/'.$row['image'].'" alt=""  style="width: 150px; height: 150px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">';}
                            else{?><img src="image/avata1.jpg" alt=""  style="max-width: 150px; height: 150px; border-radius: 100%; border-color: aquamarine; margin: 0 15px;">
            
                            <?php }?>
                    </div>
                    <div class="col-8">
                       
                    <table >
                            <?php
                            if($row){
                                $id=$row['id'];
                                $name=$row['name'];
                                $infor=$row['infor'];
                                $mota=$row['mota'];
                                $gia=$row['gia'];
                                $image=$row['image'];
                                echo "
                                <tr>
                                <th>Mã sản phẩm: </th>
                                <td><h4> $id</h4></td>
                                </tr>
                                <tr>
                                <th>Tên sản phẩm: </th>
                                <td><h4> $name</h4></td>
                                </tr>
                                <tr>
                                <th>Thông tin: </th>
                                <td><h4> $infor</h4></td>
                                </tr>
                                <tr>
                                <th>Mô tả: </th>
                                <td><h4> $mota</h4></td>
                                </tr>
                                <tr>";?>
                                <td><button type='button' class='btn btn-light w-75'><a style='text-decoration: none; color: black;' href="test.php?id=<?php echo $id ?>">Buy</a></button></td>
                                <td><a href="test.php?id=<?php echo $id ?>"><img src='image/giỏ hàng.jpg' style="width: auto; height: 50px;"></a></td>
                                <?php echo "</tr>
                                ";
                                }?>
                               
                        </table>
                    </div>
                    <div class="col-1"> </div>
                </div>
            </div>
            <div class="col-4"></div>
       
        </div>
    </div>
</body>
</html>