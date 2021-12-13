<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="icon/png" href="img/logo.png">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" href="css/ionicons.min.css">
</head>
<body>
    <div id="particles-js"></div>
    <script type="text/javascript" src="js/particles.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <section class="bg-white p-4 position-absolute top-50 start-50 translate-middle">
        <h2 class="fs-5">THÔNG TIN ĐĂNG NHẬP</h2>
        <hr>
        <?php
            if(isset($_POST['btnlogin'])){
                $username=$_POST['txtusername'];
                $password=$_POST['txtpassword'];
                $check_login=true;
                $_SESSION['loginSuccess']=false;
                if(empty($_SESSION['demdangnhap']="")){
                    $_SESSION['demdangnhap']=0; 
                }
                if($username=="" || $password==""){
                    echo '<p class="alert alert-danger">Hãy nhập đủ thông tin tài khoản và mật khẩu !</p>';
                    $check_login=false;
                    $_SESSION['loginSuccess']=false;
                }
                if($_SESSION['demdangnhap']>=5){
                    $check_login=false;
                    echo '<p class="alert alert-danger">Bạn đã đăng nhập sai quá số lần cho phép !</p>';
                }
                if ($check_login) {
                    include('database/dangnhap.php');
                // var_dump($login);
                    if ($login) {
                        echo '<script>window.location="index.php"</script>';
                        // header("location:index.php");
                        $_SESSION['loginSuccess'] = true;
                        $_SESSION['demdangnhap'] = 0;
                    } else {
                        echo '<p class="alert alert-danger">Tài khoản hoặc mật khẩu sai !</p>';
                        $_SESSION['loginSuccess'] = false;
                        $_SESSION['demdangnhap']++;
                    }
                }
            }

        ?>
        
        <form action="" method="post">
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tài khoản</label>
            <input type="text" class="form-control" name="txtusername">
            </div>
            <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="txtpassword">
            </div>
            <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="cluu">
            <label class="form-check-label" for="exampleCheck1" >Nhớ thông tin đăng nhập</label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="btnlogin">Đăng nhập</button>
            </div>
        </form>
    </section>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>