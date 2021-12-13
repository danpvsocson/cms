<?php
    if(isset($_POST['btnluu'])){
        $passwordold=$_POST['passwordold'];
        $passwordnew=$_POST['passwordnew'];
        $passwordnew2=$_POST['passwordnew2'];
       
        $check=true;
       
        
        if($passwordold=="" || $passwordnew=="" || $passwordnew2==""){
            echo '<p class="alert alert-danger text-center">Hãy nhập đủ thông tin !</p>';
            $check=false;
        }
        if($check){
            include('database/connect.php');
            $sql ="SELECT * FROM admin WHERE password=:matkhau" ;
            $a = $conn->prepare($sql);
            $data = array("matkhau"=>$passwordold);
            $a->execute($data);
            $login = $a->fetch();
            if(!$login){
                echo '<p class="alert alert-danger text-center">Mật khẩu cũ không đúng !</p>';
                $checkpass=false;
            }
            if($login){
                $checkpass=true;
                if($passwordnew!=$passwordnew2){
                    echo '<p class="alert alert-danger text-center">Mật khẩu mới không giống nhau !</p>';
                    $checkpass=false;
                }
                if($checkpass){
                    include('database/mkadmin.php');
                    echo '<p class="alert alert-success text-center">Thay đổi mật khẩu thành công !</p>';
                    // if($update){
                        
                    // }
                }
            }
        }
        
    }
    



?>

<section class="container text-center d-flex justify-content-center">
    <form class="w-25" action="" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mật khẩu cũ</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="passwordold">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="passwordnew">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Xác nhận mật khẩu mới</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="passwordnew2">
        </div>
        <button type="submit" class="btn btn-primary" name="btnluu">Lưu</button>
    </form>
</section>
