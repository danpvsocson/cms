<section class="container">
    <h2>Thêm mới tài khoản</h2>
    <?php
    if(isset($_POST['btnluu'])){
        $hoten=$_POST['hoten'];
        $email=$_POST['email'];
        $gioitinh=$_POST['gioitinh'];
        $user=$_POST['username'];
        $pass=md5($_POST['password']);
        $sdt=intval($_POST['sdt']); 
        $diachi=$_POST['diachi'];
        $kichhoat=0;
        if(isset($_POST['kichhoat'])){
            $kichhoat=1;
        }
        $error=false;
        //kiểm tra xem username đã dùng chưa
        $sql ="SELECT * FROM tai_khoan WHERE username=:taikhoan";
        $a = $conn->prepare($sql);
        $data = array("taikhoan"=>$user);
        $a->execute($data);
        $checkadd = $a->fetch();

        if($checkadd){
            echo '<p class="alert alert-danger">Username đã có người dùng</p>';
            $error=true;

        }else{
            if($hoten=="" || $email=="" || $user=="" || $pass==""){
                echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
                $error=true;
            }else{
                if($gioitinh==0){
                    echo '<p class="alert alert-danger">Hãy chọn giới tính của bạn !</p>';
                    $error=true;
                }
            }
            if($gioitinh==1){
                $gioitinh="Nam";
            }
            if($gioitinh==2){
                $gioitinh="Nữ";
            }
            if($gioitinh==3){
                $gioitinh="Khác";
            }
        }

        if(!$error){
            //thêm dữ liệu
            $sql="INSERT INTO tai_khoan(hoten,gioitinh,sdt,username,password,email,diachi,trangthai) VALUES(:hoten,:gioitinh,:sdt,:username,:password,:email,:diachi,:trangthai)";
            $q=$conn->prepare($sql);
            $data=array(
            "hoten"=>$hoten,
            "gioitinh"=>$gioitinh,
            "sdt"=>$sdt,
            "username"=>$user,
            "password"=>$pass,
            "email"=>$email,
            "diachi"=>$diachi,
            "trangthai"=>$kichhoat,
            );
            $add=$q->execute($data);
            if($add){
                echo '<p class="alert alert-success">Thêm thành công</p>';
            }
        }
    }


    ?>
    <form class="row g-3" action="" method="post">
        <p class="mb-0">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="col-md-5">
            <label for="inputEmail4" class="form-label">Họ Và Tên <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="hoten" placeholder="Nhập đủ họ và tên">
            
        </div>
        <div class="col-md-5">
            <label for="inputEmail4" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="Ghi rõ cả '@****'" name="email">
        </div>
        <div class="col-md-2">
            <label for="inputEmail4" class="form-label">Giới tính <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="gioitinh">
                <option value="0">Chọn</option>
                <option value="1">Nam</option>
                <option value="2">Nữ</option>
                <option value="3">Khác</option>
            </select>
        </div>
        
        <div class="col-6">
            <label for="inputAddress2" class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="inputAddress2" name="username" placeholder="Nhập tên đăng nhập">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="inputCity" name="password" placeholder="Nhập mật khẩu đang nhập">
        </div>
        <div class="col-4">
            <label for="inputAddress" class="form-label" value="">Số điện thoại</label>
            <input type="number" class="form-control" id="inputAddress" name="sdt" placeholder="VD:03********">
        </div>
        <div class="col-md-8">
            <label for="inputState" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="inputCity" name="diachi" placeholder="Thôn(Làng)-Xã-Huyện-Thành Phố(Tỉnh)">
        </div>
        
        <div class="col-12">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" name="kichhoat">
            <label class="form-check-label" for="gridCheck">
                Kích hoạt
            </label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary me-2" name="btnluu">Lưu</button>
            <a href="?thumuc=<?=$_GET['thumuc']?>&file=index" type="button" class="btn btn-danger" name="btnluu">Hủy</a>
        </div>
    </form>
</section>