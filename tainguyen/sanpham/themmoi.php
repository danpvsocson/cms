<section class="container">
    <h2 class="fs-4">Thêm mới Sản Phẩm</h2>
    <?php
    if (isset($_POST['btnluu'])) {
        $modul = $_POST['s_modul'];
        $ten_san_pham = $_POST['ten_san_pham'];
        $anh_san_pham = $_POST['anh_san_pham'];
        $mota = $_POST['mota'];
        $chi_tiet = $_POST['chi_tiet'];
        $ghi_chu = $_POST['ghi_chu'];
        $gia_cu = intval($_POST['gia_cu']);
        $gia_moi = intval($_POST['gia_moi']);
        $giam_gia = intval($_POST['giam_gia']);
        $hien_thi = 0;
        if (isset($_POST['c_hienthi'])) {
            $hien_thi = 1;
        }
        $error = false;
        if ($ten_san_pham == "") {
            echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
            $error = true;
        } else {
            if ($modul == "") {
                echo '<p class="alert alert-danger">Hãy chọn Modul !</p>';
                $error = true;
            }
        }
        if (!$error) {
            //Thêm dữ liệu vào database
            $sql = "INSERT INTO san_pham(modul,ten_san_pham,anh_san_pham,mota,chi_tiet,ghi_chu,gia_moi,gia_cu,giam_gia,hien_thi) 
                            VALUES(:modul,:ten_san_pham,:anh_san_pham,:mota,:chi_tiet,:ghi_chu,:gia_moi,:gia_cu,:giam_gia,:hien_thi)";
            $q = $conn->prepare($sql);
            $data = array(
                "modul" => $modul,
                "ten_san_pham" => $ten_san_pham,
                "anh_san_pham" => $anh_san_pham,
                "mota" => $mota,
                "chi_tiet" => $chi_tiet,
                "ghi_chu" => $ghi_chu,
                "gia_moi" => $gia_moi,
                "gia_cu" => $gia_cu,
                "giam_gia" => $giam_gia,
                "hien_thi" => $hien_thi,
            );
            $add = $q->execute($data);
            if ($add) {
                echo '<p class="alert alert-success">Thêm thành công</p>';
            }
        }
    }
    ?>
    <form class="row g-3" action="" method="post">
        <p class="mb-0">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Modul <span class="text-danger">*</span></label>
                    <select class="form-select" aria-label="Default select example" name="s_modul">
                        <option value="">---Chọn Modul---</option>
                        <?php
                        //Liên kết bảng <=> modul
                        $sql = "SELECT * FROM b_modul";
                        $a = $conn->prepare($sql);
                        $a->execute();
                        $view1 = $a->fetchAll();
                        foreach ($view1 as $key => $info) {
                            echo '<option value="' . $info['ma'] . '">' . $info['tieude'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-8">
                    <label for="inputEmail4" class="form-label">Ảnh</label>
                    <div class="col-md-6 input-group">
                        <input type="text" class="form-control" id="link_anh" name="anh_san_pham" placeholder="Chọn ảnh sản phẩm">
                        <span class="input-group-text" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-images"></i></span>
                        <!-- Model -->
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
                    <input type="number" id="giamgia" onkeyup="tinh()" class="form-control" name="giam_gia" placeholder="1->100">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Giá mới</label>
                    <input type="text" id="giamoi" class="form-control" name="gia_moi" placeholder="Giá đã giảm giá" value="">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Giá gốc</label>
                    <input type="number" id="giagoc" onkeyup="tinh()" class="form-control" name="gia_cu" placeholder="Nhập giá bán">
                </div>
                <script>
                    function tinh() {
                        var a = parseInt($("#giamgia").val());
                        var b = parseInt($("#giagoc").val());
                        var kq = $("#giamoi");
                        if (a != 0 && b != 0) {
                            var tinh = b - (b * a / 100);
                            $(kq).val(tinh);
                        }
                        if ((a != 0 || a == "") && b == 0) {
                            $(kq).val(a);
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
                <input type="text" class="form-control" id="inputAddress2" name="ghi_chu" placeholder="Nhập ghi chú">
            </div>
            <div class="col-12 my-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="c_hienthi">
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
                <textarea type="text" rows="3" class="form-control" id="" name="mota" placeholder="Nhập mô tả sản phẩm"></textarea>
            </div>
            <div class="col-12">
                <label for="motasanpham" class="form-label">Chi tiết </label>
                <textarea type="text" rows="5" class="form-control" id="motasanpham" name="chi_tiet" placeholder="Nhập chi tiết sản phẩm"></textarea>
            </div>
        </div>
        <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
        <script type="text/javascript" src="js/tinymce.js"></script>
    </form>
</section>