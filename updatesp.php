<?php
require "connect_sql.php";
if(isset($_REQUEST['id']) && $_REQUEST['id'] != null){
    $id = $_GET['id'];
    $sql="SELECT * FROM list WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Update</title>
</head>
<style>
     .form{
        /* min-height: 80vh; */
        border: 1px solid black;
    }
    .form_element{
        padding: 15px 0;
    }
</style>
<body>
<div class="container-fluid">
        <div class="row">
        
        </div>
        <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="form_add">
                <!-- form add dữ liệu -->
                   
                <div class="form  w-100 mt-5 h-50 rounded border-3 shadow p-3 mb-5 bg-body-tertiary rounded border-success-subtle" style="text-align: center;">
                <h2 style="text-align: center; color: black;">Update thông tin</h2> 
                <form action="" method="post">
                <?php
                    while($row=mysqli_fetch_assoc($result)){
                ?>
                <div class="form_element">
                    <label for="" style="position: relative; left: 3px;">Tên sản phẩm </label>
                <input type="text" name="name" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập tên sản phẩm" value="<?php echo $row['name'] ?>" required>
                </div>
                <div class="form_element">
                    <label for="" style="position: relative; margin-right:  70px;">Giá </label>
                <input type="text" name="gia" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập giá sản phẩm" value="<?php echo $row['gia'] ?>" required>
                </div>
                <div class="form_element">
                    <label for="" style="position: relative; margin-right:25px;"> Thông tin</label>
                <input type="text" name="infor" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập thông tin sản phẩm" value="<?php echo $row['infor'] ?>" required>
                </div>
                <?php
                }
                ?>
                    <input type="submit" class="w-50 mb-2 border border-3 rounded border-success-subtle" name="update" id="" value="Cập nhật"> 
                </form>
                </div>
            </div>
        </div>
        <div class="col-4"></div>
        </div>
</div>
</body>
</html>
<?php
if(isset($_POST['update'])){
    $name=$_POST['name'];
    $infor=$_POST['infor'];
    $gia=$_POST['gia'];
    $upate="UPDATE list SET name='$name' , infor='$infor' , gia='$gia' WHERE id='$id'";
    if($conn->query($upate)===true){
        header("location: adminhome.php?idhome=sp");
    }else{
        echo "Cập nhật thất bại";
    }
}
?>