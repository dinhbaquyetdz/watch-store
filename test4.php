<?php
require "connect_sql.php";
if(isset($_REQUEST['id']) && $_REQUEST['id'] != null){
    $id=$_GET['id'];
    $sql=mysqli_query($conn,"SELECT list.name,list.mota,donhang.id FROM `donhang` INNER JOIN dangki ON donhang.id_khachhang=dangki.id INNER JOIN list ON donhang.id_sp=list.id WHERE dangki.id='$id';");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="test1.php">trở lại</a>
<table border="1">
    <tr>
        <th>STT</th>
        <th>Tên đơn hàng</th>
        <th>Mô tả đơn hàng</th>
        <th>Thao tác</th>
    </tr>
    <?php
    $count=0;
    while($row=mysqli_fetch_array($sql)){
        $count=$count+1;
        $a=$row['id'];
        $name=$row['name'];
        $mota=$row['mota'];
        echo "
        <tr>
        <td>$count</td>
        <td>$name</td>
        <td>$mota</td>
        <td><a href='deletedonhang.php?id=$a'>xóa đơn hàng</a></td>
        </tr>
        ";
    }
    ?>
</table>
</body>
</html>