<?php
require "connect_sql.php";
if(isset($_POST['add'])){
    $name=$_POST['name'];
    $infor=$_POST['infor'];
    $mota=$_POST['mota'];
    $gia=$_POST['gia'];
    $soluong=$_POST['sl'];
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
        $sql=mysqli_query($conn,"INSERT INTO list(name,infor,mota,gia,image,soluong) VALUES ('$name','$infor','$mota','$gia','$image','$soluong')");
        
    }else{
        echo "thong tin con thieu";
    }
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo '<script language="javascript">alert("Đã upload thành công!");</script>';
        }else{
        echo '<script language="javascript">alert("Đã upload thất bại!");</script>';
        }
} 
$get=mysqli_query($conn,"SELECT * FROM list");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <a href="test1.php">Danh sách khách hàng</a>
    <h1>ADD_SP</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">name: </label>
        <input type="text" name="name">
        <label for="">Thông tin: </label>
        <input type="text" name="infor">
        <label for="">Mô tả: </label>
        <input type="text" name="mota">
        <label for="">Giá: </label>
        <input type="text" name="gia">
        <label for="">Số lượng: </label>
        <input type="text" name="sl">
        <input type="hidden" name="size" value="1000000"> 
        <input type="file" name="image"> 
        <input type="submit" name="add" value="add">
    </form>
    <table border="1">
        <tr>
            <th>STT</th>
            <th>MA_SP</th>
            <th>tên SP</th>
            <th>thông tin</th>
            <th>mô tả</th>
            <!-- <th>ảnh</th> -->
            <th>giá</th>
            <th>số lượng</th>
            <th>thêm ảnh</th>
            <th colspan="2">Thao tác</th>
        </tr>
        <?php
        $count=0;
        while($row=mysqli_fetch_array($get)){
        $count=$count+1;
        $name=$row['name'];
        $infor=$row['infor'];
        $mota=$row['mota'];
        $gia=$row['gia'];
        $soluong=$row['soluong'];
        $id=$row['id'];
        echo "
        <tr>
            <th>$count</th>
            <th> $id</th>
            <th>$name</th>
            <th>$infor</th>
            <th>$mota</th>
            <th>$gia</th>
            <th>$soluong</th>
            <th><img src='photo/".$row['image']."' ></th>
            <th><a href='updatesp.php?id=$id'>sửa</a></th>
            <th><a href='deletesp.php?id=$id'>xóa</a></th>
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