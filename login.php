<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="icon/png" href="img/adminlogin_logo_title.png">
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
    <?php
    if (isset($_POST['btnlogin'])) {
        $username = $_POST['txtusername'];
        $password = $_POST['txtpassword'];
        $check_login = true;
        $_SESSION['loginSuccess'] = false;
        if (empty($_SESSION['demdangnhap'] = "")) {
            $_SESSION['demdangnhap'] = 0;
        }
        if ($username == "" || $password == "") {
            echo '<p class="alert alert-danger">Hãy nhập đủ thông tin tài khoản và mật khẩu !</p>';
            $check_login = false;
            $_SESSION['loginSuccess'] = false;
        }
        if ($_SESSION['demdangnhap'] >= 5) {
            $check_login = false;
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
    <main class="container p-4 p-md-0 position-absolute top-50 start-50 translate-middle">
        <div class="row justify-content-center ">
            <div class="p-0 col-md-8 bg-white rounded-3">
                <form action="" method="post">
                    <div class="card-group justify-content-center">
                        <div class="card pt-5 pb-4 px-4 mx-auto form_login mb-0">
                            <h1>Login</h1>
                            <span class="mb-2">Đăng nhập trang danh cho quản trị web</span>
                            <div class="">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person"></i></span>
                                    <input name="txtusername" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                                </div>
                                <div class="input-group flex-nowrap my-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-lock"></i></i></span>
                                    <input type="password" name="txtpassword" class="form-control" placeholder="Password" aria-label="password" aria-describedby="addon-wrapping">
                                </div>
                                <button type="submit" name="btnlogin" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                                <a href="" type="button" class="btn btn-success"><i class="bi bi-globe"></i> Web</a>
                            </div>
                        </div>
                        <div class="d-none d-lg-block p-3 mx-auto align-content-center img_admin">
                            <img class="" src="img/login_admin.png" alt="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>