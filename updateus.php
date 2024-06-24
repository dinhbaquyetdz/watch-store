<?php
session_start();
if($_SESSION['email1'] == null ){
    header("location: adminhome.php");
}
require "connect_sql.php";
if(isset($_REQUEST['id']) && $_REQUEST['id'] != null){
    $id = $_GET['id'];
    $sql="SELECT * FROM dangki WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <sc src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
        <div class="col-4"></div>
        <div class="col-4">
            <div class="form_add">
                <!-- form add dữ liệu -->
                   
                <div class="form  w-100 mt-5 h-50 rounded border-3 shadow p-3 mb-5 bg-body-tertiary rounded border-success-subtle" style="text-align: center;">
                <a href="javascript: history.go(-1)">trở lại</a>
                <h2 style="text-align: center; color: black;">Update thông tin</h2> 
                <form action="" method="post" enctype="multipart/form-data">
                <?php
                    while($row=mysqli_fetch_assoc($result)){
                ?>
                <div class="form_element">
                    <label for="" style="position: relative; left: 3px;">Họ user: </label>
                <input type="text" name="ho" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập họ user" value="<?php echo $row['ho'] ?>" required>
                </div>
                <div class="form_element">
                    <label for="" style="position: relative; left:3px;">Tên user: </label>
                <input type="text" name="ten" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập tên user" value="<?php echo $row['ten'] ?>" required>
                </div>
                <div class="form_element">
                <select name="gt" id="gender">
                                <option value="1">nam</option>
                                <option value="2">nữ</option>
                            </select>  
                </div>
                <div class="form_element">
                    <label for="" style="position: relative; left: 3px; margin-right: 15px;">Gmail: </label>
                    <input type="text" name="gmail" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập email hoặc số điện thoại" value="<?php echo $row['email1'] ?>" required>
                </div>
                <!-- <div class="form_element">
                    <label for="" style="position: relative; left: 3px; margin-right: 15px;">Phone: </label>
                    <input type="text" name="phone" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập số điện thoại" value="<?php echo $row['phone'] ?>" required>
                </div>
                <div class="form_element">
                    <label for="" style="position: relative; left: 3px;">Address: </label>
                    <input type="text" name="address" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập địa chỉ" value="<?php echo $row['address'] ?>" required>
                </div> -->
                <div class="form_element">
                    <label for="" style="position: relative; left: 4px; margin-right: 25px; ">Pass: </label>
                <input type="text" name="pass" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập password">
                </div>
                <div class="form_element">
                    <label for="" style="position: relative; left: 0px; margin-right: 8px; ">Repass: </label>
                    <input type="text" name="repass" class="w-75 rounded border-success-subtle" id="" placeholder="Nhập password">
                </div>
                <div class="form_element">
                    <input type="hidden" name="size" value="1000000"> 
                    <input type="file" name="image"> 
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
<?php
if(isset($_POST['update'])){
    $ho=$_POST['ho'];
    $ten=$_POST['ten'];
    $gt=$_POST['gt'];
    $gmail=$_POST['gmail'];
    // $phone=$_POST['phone'];
    // $address=$_POST['address'];
    $pass=$_POST['pass'];
    $repass=$_POST['repass'];
   
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

    // khong update anh va pass
    if(!empty($ho) && !empty($ten) && $gt!=0 && !empty($gmail) && empty($pass) && empty($image)){
        $upate="UPDATE dangki SET ho='$ho' , ten='$ten' , gt='$gt' , email1='$gmail', level='2' WHERE id='$id'";
        if($conn->query($upate)===true){
            echo '<script language="javascript">alert("Chỉnh sửa thành công!");</script>';
            // header("location: shop.php");
            // echo "khong update anh va pass";
        }else{
            echo "Cập nhật thất bại";
        }
        // echo"khong update anh va pass";
    }
    //update ca anh va pass
    elseif(!empty($ho) && !empty($ten) && $gt!=0 && !empty($gmail) && !empty($pass) && !empty($image) ){
        $pass=md5($pass);
        $repass=md5($repass);
        if($pass != $repass ){
            echo '<script language="javascript">alert("Mật khẩu nhập lại không đúng!");</script>';
        }else{
            $upate="UPDATE dangki SET ho='$ho' , ten='$ten' , gt='$gt' , email1='$gmail', image='$image', level='2' , pass='$pass'  WHERE id='$id'";
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo '<script language="javascript">alert("Đã upload thành công!");</script>';
                }else{
                echo '<script language="javascript">alert("Đã upload thất bại!");</script>';
                }
            if($conn->query($upate)===true){
                echo '<script language="javascript">alert("Chỉnh sửa thành công!");</script>';
                // header('location: shop.php?check=infor_user');
                // echo "update ca anh va pass";
            }else{
                echo "Cập nhật thất bại";
            }
        }
        // echo "update ca anh va pass";
    
    }
    //update pass ko update anh
    elseif(!empty($ho) && !empty($ten) && $gt!=0 && !empty($gmail) && !empty($pass) && empty($image)){
        $pass=md5($pass);
        $repass=md5($repass);
        if($pass != $repass){
            echo '<script language="javascript">alert("Mật khẩu nhập lại không đúng!");</script>';
        }else{
            $upate="UPDATE dangki SET ho='$ho' , ten='$ten' , gt='$gt' , email1='$gmail', level='2' , pass='$pass' WHERE id='$id'";
            // if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            //     echo '<script language="javascript">alert("Đã upload thành công!");</script>';
            //     }else{
            //     echo '<script language="javascript">alert("Đã upload thất bại!");</script>';
            //     }
            if($conn->query($upate)===true){
                echo '<script language="javascript">alert("Chỉnh sửa thành công!");</script>';
                // header('location: shop.php?check=infor_user');
                // echo "update pass ko update anh";
            }else{
                echo "Cập nhật thất bại";
            }
        }
        // echo "update pass ko update anh";
    }
    //update anh ko update pass
    elseif(!empty($ho) && !empty($ten) && $gt!=0 && !empty($gmail) && empty($pass) && !empty($image)){
        if($pass != $repass ){
            echo "Mật khẩu nhập lại không đúng!!!";
        }else{
            $upate="UPDATE dangki SET ho='$ho' , ten='$ten' , gt='$gt' , email1='$gmail' , level='2', image='$image' WHERE id='$id'";
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo '<script language="javascript">alert("Đã upload thành công!");</script>';
                // header('location: shop.php?check=infor_user');
                }else{
                echo '<script language="javascript">alert("Đã upload thất bại!");</script>';
                }
            if($conn->query($upate)===true){
                echo '<script language="javascript">alert("Chỉnh sửa thành công!");</script>';
                // header("location: shop.php?check=infor_user");
                // echo "update anh ko update pass";
            }else{
                echo "Cập nhật thất bại";
            }
            // echo "update ảnh không update pass";
        }
    }else{
        echo '<script language="javascript">alert("Nhập chưa đầy đủ thông tin!");</script>';
    }  
    
    
}
?>
</html>
