<section class="container">
    <h2>Sửa tài khoản</h2>
    <?php
    $id = intval($_GET['id']);
    $flagcheck = true;

    if ($flagcheck) {
        if (isset($_POST['btnluu'])) {
            $hoten = $_POST['hoten'];
            $email = $_POST['email'];
            $gioitinh = $_POST['gioitinh'];
            $user = $_POST['username'];
            $pass = $_POST['password'];
            //md5() ma hoa pass
            $sdt = $_POST['sdt'];
            $diachi = $_POST['diachi'];
            $kichhoat = 0;
            if (isset($_POST['kichhoat'])) {
                $kichhoat = 1;
            }
            $error = false;
            //kiểm tra username đã dùng chưa
            $sql = "SELECT id FROM tai_khoan WHERE username=:taikhoan and id<>:id";
            $a = $conn->prepare($sql);
            $data = array("taikhoan" => $user, "id" => $id);
            $a->execute($data);
            $checkadd = $a->fetch();
            if ($checkadd) {
                echo '<p class="alert alert-danger">Username đã tồn tại !</p>';
                $error = true;
            } else {
                if ($hoten == "" || $email == "" || $user == "" || $pass == "") {
                    echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
                    $error = true;
                }
                if ($gioitinh == 0) {
                    $gioitinh = "Nam";
                }
                if ($gioitinh == 1) {
                    $gioitinh = "Nữ";
                }
                if ($gioitinh == 2) {
                    $gioitinh = "Khác";
                }
            }

            if (!$error) {
                //sửa dữ liệu
                $sql="UPDATE tai_khoan SET hoten=:hoten,gioitinh=:gioitinh,sdt=:sdt,username=:username,password=:password,email=:email,diachi=:diachi,trangthai=:trangthai where id=:id";
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
                    "id"=>$id,
                );
                $q->execute($data);
                $sua = $q;
                if ($sua) {
                    echo '<p class="alert alert-success">Cập nhật thành công</p>';
                }
            }
        }
    }
    //lấy dữ liệu đưa vào form
    $sql ="SELECT * FROM tai_khoan WHERE id=:id" ;
    $a = $conn->prepare($sql);
    $data = array("id"=>$id);
    $a->execute($data);
    $checkadd = $a->fetch();

    if (!$checkadd) {
        echo '<p class="alert alert-danger">Lỗi không lấy được bản ghi !</p>';
        $flagcheck = false;
    }

    ?>
    <form class="row g-3" action="" method="post">
        <p class="mb-0">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="col-md-5">
            <label for="inputEmail4" class="form-label">Họ Và Tên <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="hoten" value="<?= $checkadd['hoten'] ?>" placeholder="Nhập đủ cả họ và tên">

        </div>
        <div class="col-md-5">
            <label for="inputEmail4" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="Ghi rõ cả '@****'" name="email" value="<?= $checkadd['email'] ?>">
        </div>
        <div class="col-md-2">
            <label for="inputEmail4" class="form-label">Giới tính <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="gioitinh">
                <?php
                if ($checkadd['gioitinh'] == "Nam") {
                    echo '<option value="0">Nam</option>';
                }
                if ($checkadd['gioitinh'] == "Nữ") {
                    echo '<option value="1">Nữ</option>';
                }
                if ($checkadd['gioitinh'] == "Khác") {
                    echo '<option value="2">Khác</option>';
                }
                ?>
                <option value="0">Nam</option>
                <option value="1">Nữ</option>
                <option value="2">Khác</option>
            </select>
        </div>

        <div class="col-6">
            <label for="inputAddress2" class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="inputAddress2" name="username" value="<?= $checkadd['username'] ?>" placeholder="Nhập tên đăng nhập">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="inputCity" name="password" placeholder="Nhập mật khâu đăng nhập" value="<?= $checkadd['password'] ?>">
        </div>
        <div class="col-4">
            <label for="inputAddress" class="form-label" value="">Số điện thoại</label>
            <input type="number" class="form-control" id="inputAddress" name="sdt" value="<?= $checkadd['sdt'] ?>" placeholder="VD:03*******">
        </div>
        <div class="col-md-8">
            <label for="inputState" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="inputCity" name="diachi" placeholder="Thôn(Làng)-Xã-Huyện-Thành Phố(Tỉnh)" value="<?= $checkadd['diachi'] ?>">
        </div>

        <div class="col-12">
            <div class="form-check">
                <?php
                if ($checkadd['trangthai'] == 0) {
                    echo '<input class="form-check-input" type="checkbox" id="gridCheck" name="kichhoat">';
                } else {
                    echo '<input class="form-check-input" type="checkbox" id="gridCheck" name="kichhoat" checked>';
                }
                ?>

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