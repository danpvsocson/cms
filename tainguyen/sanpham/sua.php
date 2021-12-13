<section class="container">
    <h2 class="fs-4">Sửa Sản Phẩm</h2>
    <?php
    $id = intval($_GET['id']);
    $flagcheck = true;
    if ($flagcheck) {
        if (isset($_POST['btnluu'])) {
            $modul = $_POST['s_modul'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $anh_san_pham = $_POST['anh_san_pham'];
            $gia_cu = intval($_POST['gia_cu']);
            $gia_moi = intval($_POST['gia_moi']);
            $giam_gia = intval($_POST['giam_gia']);
            $mota = $_POST['mota'];
            $chi_tiet = $_POST['chi_tiet'];
            $ghi_chu = $_POST['ghi_chu'];
            $hien_thi = 0;
            if (isset($_POST['s_hienthi'])) {
                $hien_thi = 1;
            }
            $error = false;
            //Kiểm tra xem sản phẩm đã có chưa
            // $sql = "SELECT id FROM san_pham where ten_san_pham=:ten_san_pham and id<>:id";
            // $a = $conn->prepare($sql);
            // $data = array("ten_san_pham" => $ten_san_pham, "id" => $id);
            // $a->execute($data);
            // $checksua = $a->fetch();
            // if ($checksua) {
            //     echo '<p class="alert alert-danger">Modul đã tồn tại !</p>';
            //     $error = true;
            // } else {
                if ($ten_san_pham == "" || $hien_thi == "") {
                    echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
                    $error = true;
                }
            // }
            if (!$error) {
                //Sửa dữ liệu san phẩm theo ID
                $sql = "UPDATE san_pham SET modul=:modul,ten_san_pham=:ten_san_pham,anh_san_pham=:anh_san_pham,gia_cu=:gia_cu,gia_moi=:gia_moi,giam_gia=:giam_gia,mota=:mota,chi_tiet=:chi_tiet,ghi_chu=:ghi_chu,hien_thi=:hien_thi where id=:id";
                $q = $conn->prepare($sql);
                $data = array(
                    "modul" => $modul,
                    "ten_san_pham" => $ten_san_pham,
                    "anh_san_pham" => $anh_san_pham,
                    "mota" => $mota,
                    "chi_tiet" => $chi_tiet,
                    "ghi_chu" => $ghi_chu,
                    "gia_cu" => $gia_cu,
                    "gia_moi" => $gia_moi,
                    "giam_gia" => $giam_gia,
                    "hien_thi" => $hien_thi,
                    "id" => $id,
                );
                $sua = $q->execute($data);
                if ($sua) {
                    echo '<p class="alert alert-success">Cập nhật thành công</p>';
                }
            }
        }
    }
    //Lấy dữ liệu sản phẩm theo ID
    $sql = "SELECT * FROM san_pham WHERE id=:id";
    $q = $conn->prepare($sql);
    $data = array("id" => $id);
    $q->execute($data);
    $view = $q->fetch();
    if (!$view) {
        echo '<p class="alert alert-danger">Lỗi không lấy được bản ghi !</p>';
        $flagcheck = false;
    }
    ?>
    <!--  -->
    <form class="row g-3" action="" method="post">
        <p class="mb-0">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập tên sản phẩm" value="<?= $view['ten_san_pham'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Modul <span class="text-danger">*</span></label>
                    <select class="form-select" aria-label="Default select example" name="s_modul">
                        <?php
                        //Liên kết bảng <=> modul
                        $sql = "SELECT * FROM b_modul";
                        $a = $conn->prepare($sql);
                        $a->execute();
                        $view1 = $a->fetchAll();
                        foreach ($view1 as $key => $value) {
                            if ($view['modul'] == $value['ma']) {
                                echo '<option value="' . $value['ma'] . '" selected>' . $value['tieude'] . '</option>';
                            } else {
                                echo '<option value="' . $value['ma'] . '">' . $value['tieude'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-8">
                    <label for="inputEmail4" class="form-label">Ảnh</label>
                    <div class="col-md-6 input-group">
                        <input type="text" class="form-control" id="link_anh" name="anh_san_pham" value="<?= $view['anh_san_pham'] ?>" placeholder="Chọn ảnh sản phẩm">
                        <span class="input-group-text" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-images"></i></span>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Quản lý File</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe width="100%" height="550" frameborder="0" src="plugin/filemanager/filemanager/dialog.php?type=0&field_id=link_anh&akey=<?= md5(123) ?>"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">Giảm giá (<span class="text-danger">%</span>)</label>
                    <input type="number" onkeyup="tinh()" class="form-control" name="giam_gia" placeholder="1->100" value="<?= $view['giam_gia'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Giá mới</label>
                    <input type="number" class="form-control" name="gia_moi" placeholder="Giá đã giảm giá" value="<?= $view['gia_moi'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Giá gốc</label>
                    <input type="number" onkeyup="tinh()" class="form-control" name="gia_cu" placeholder="Nhập giá bán" value="<?= $view['gia_cu'] ?>">
                </div>
                <script>
                    function tinh() {
                        var a = parseInt($("#giamgia").val());
                        var b = parseInt($("#giagoc").val());
                        var kq = $("#giamoi");
                        if(a != 0 && b != 0){
                            var tinh = b - (b * a / 100);
                            $(kq).val(tinh);
                        }
                        if (a != 0 && b == 0) {
                            $(kq).val(1);
                        }
                    };
                    // function tinh1() {
                    //     var b = parseInt($("#giagoc").val());
                    //     var c = parseInt($("#giamoi").val());
                    //     var kq2 = $("#giamgia")
                    //     if(a != 0 && c != 0){
                    //         var phantram =(b - c) / b * 100;
                    //         $(kq2).val(phamtram); 
                    //     }
                    // }
                </script>
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Ghi chú</label>
                <input type="text" class="form-control" id="inputAddress2" name="ghi_chu" placeholder="Nhập ghi chú" value="<?= $view['ghi_chu'] ?>">
            </div>
            <div class="col-12 my-2">
                <div class="form-check">
                    <?php
                    if ($view['hien_thi'] == 0) {
                        echo '<input class="form-check-input" type="checkbox" id="gridCheck" name="s_hienthi">';
                    } else {
                        echo '<input class="form-check-input" type="checkbox" id="gridCheck" name="s_hienthi" checked>';
                    }
                    ?>
                    <label class="form-check-label" for="gridCheck">
                        Hiển thị
                    </label>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary me-2" name="btnluu">Lưu</button>
                <a href="?thumuc=<?= $_GET['thumuc'] ?>&file=index" type="button" class="btn btn-danger" name="btnluu">Hủy</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="col-12">
                <label for="motasanpham" class="form-label">Mô tả</label>
                <textarea type="text" rows="3" class="form-control" id="" name="mota" placeholder="Nhập mô tả sản phẩm"><?= $view['mota'] ?></textarea>
            </div>
            <div class="col-12">
                <label for="motasanpham" class="form-label">Chi tiết </label>
                <textarea type="text" rows="5" class="form-control" id="motasanpham" name="chi_tiet" placeholder="Nhập chi tiết sản phẩm"><?= $view['chi_tiet'] ?></textarea>
            </div>
        </div>
        <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
        <script type="text/javascript" src="js/tinymce.js"></script>
    </form>
</section>