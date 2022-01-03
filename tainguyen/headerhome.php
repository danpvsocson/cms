<?php
    session_start();
    // var_dump($_SESSION['loginSuccess']);
    if(!$_SESSION['loginSuccess']){
      header("location:login.php");
      die("Quay ra đăng nhập đi bạn êi !");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="icon/png" href="img/logo.png">
    <title>Admin Manager</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" href="css/ionicons.min.css">
</head>
<body>
<section class="menu_fix">
        <div class="container-fluid p-0 ">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid ">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-house-fill"></i> CMS</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-file-person"></i> Thành Viên </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="?thumuc=taikhoan&file=index">Quản Lý Tài Khoản</a></li>
                                    <li><a class="dropdown-item" href="?thumuc=taikhoan&file=history">Lịch Sử Đăng Nhập</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-newspaper"></i> Bài Viết </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="?thumuc=content&file=index">Cập Nhật Bài Viết</a></li>
                                    <li><a class="dropdown-item" href="?thumuc=content&file=group">Nhóm Bài Viết</a></li>
                                    <li><a class="dropdown-item" href="?thumuc=taikhoan&file=comingsoon">Coming Soon</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-shop"></i> Sản Phẩm </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="?thumuc=sanpham&file=index">Cập Nhật Sản Phẩm</a></li>
                                    <li><a class="dropdown-item" href="?thumuc=sanpham&file=group">Nhóm Sản Phẩm</a></li>
                                    <li><a class="dropdown-item" href="?thumuc=sanpham&file=comingsoon">Coming Soon</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-gear"></i> Giao Diện </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="?thumuc=menu&file=index">Quản Lý Menu</a></li>
                                    <li><a class="dropdown-item" href="?thumuc=modul&file=index">Quản Lý Modul</a></li>
                                    <li><a class="dropdown-item" href="?thumuc=banner&file=index">Quản Lý Banner</a></li>
                                    <li><a class="dropdown-item" href="?thumuc=nhom&file=index">Quản Lý Nhóm</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-envelope"></i> Phản Hồi </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="?thumuc=mail&file=index">Coming Soon</a></li>
                                    
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-bug"></i> Tiện Ích </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="?thumuc=tienich&file=index">Coming Soon</a></li>
                                    
                                </ul>
                            </li>
                            
                        </ul>
                        
                    </div>
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">

                            <div class="d-flex"  id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- <i class="bi bi-person-circle fs-3"></i> -->
                                
                                <a class="nav-link dropdown-toggle text-dark" href="#"><img src="img/admin.png" alt="admin" style="width: 35px; border-radius: 100% 100% 0% 0%;">  Admin</a>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?thumuc=&file=doimkadmin">Đổi mật khẩu</a></li>
                                <li><a class="dropdown-item" href="?thumuc=&file=thoat">Thoát</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
              </nav>
        </div>
</section>