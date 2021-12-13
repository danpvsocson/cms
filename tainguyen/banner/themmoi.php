<section class="container">
    <h2 class="fs-4">Thêm mới Banner</h2>
    <?php
    if (isset($_POST['btnluu'])) {
        $tieude = $_POST['txt_tieude'];
        $mo_ta = $_POST['txt_mo_ta'];
        $chi_tiet = $_POST['txt_chi_tiet'];
        $link = $_POST['txt_link'];
        $modul = $_POST['s_modul'];
        $ghichu = $_POST['txt_ghichu'];
        $hienthi = 0;
        if (isset($_POST['c_hienthi'])) {
            $hienthi = 1;
        }
        $error = false;

        if ($tieude == "") {
            echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
            $error = true;
        } else {
            if ($modul == "") {
                echo '<p class="alert alert-danger">Hãy chọn Modul !</p>';
                $error = true;
            }
        }
        //kiểm tra dữ liệu
        $sql = "SELECT * FROM b_banner WHERE tieude=:tieude and modul=:modul";
        $q = $conn->prepare($sql);
        $data = array("tieude" => $tieude, "modul" => $modul);
        $q->execute($data);
        $checkadd = $q->fetch();
        if ($checkadd) {
            echo '<p class="alert alert-danger">Tiêu đề đã có !</p>';
            $error = true;
        }
        if (!$error) {
            //Thêm dữ liệu
            $sql = "INSERT INTO b_banner(tieude,mo_ta,chi_tiet,img_path,modul,ghichu,hienthi) VALUES(:tieude,:mo_ta,:chi_tiet,:link,:modul,:ghichu,:hienthi)";
            $q = $conn->prepare($sql);
            $data = array(
                "tieude" => $tieude,
                "mo_ta" => $mo_ta,
                "chi_tiet" => $chi_tiet,
                "link" => $link,
                "modul" => $modul,
                "ghichu" => $ghichu,
                "hienthi" => $hienthi,
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
        <div class="col-4">
            <div class="row">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label mb-2">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="txt_tieude" placeholder="Nhập tiêu đề">
                </div>
                <label for="inputEmail4" class="form-label my-2">Ảnh</label>
                <div class="col-md-12 input-group">
                    <input type="text" class="form-control" id="link_anh" name="txt_link" placeholder="Chọn ảnh">
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
                                    <iframe width="100%" height="550" frameborder="0" src="plugin/filemanager/filemanager/dialog.php?type=0&field_id=link_anh&akey=<?=md5(123)?>"></iframe>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label my-2">Ghi chú</label>
                    <textarea type="text" class="form-control" id="inputAddress2" name="txt_ghichu" rows="3" placeholder="Nhập ghi chú"></textarea>
                    
                </div>
                <div class="col-md-8 mt-6">
                    <label for="inputEmail4" class="form-label my-2">Modul <span class="text-danger">*</span></label>
                    <select class="form-select" aria-label="Default select example" name="s_modul">
                        <option value="">Chọn Modul</option>
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
                <div class="col-md-12 mt-4">
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
        </div>
        <div class="col-8">
            <div class="row">
                <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
                <script type="text/javascript" src="js/tinymce.js"></script>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Mô tả</label>
                    <input type="text" class="form-control" id="inputAddress2" name="txt_mo_ta" placeholder="Nhập mô tả">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label my-2">Chi tiết</label>
                    <textarea name="txt_chi_tiet" id="chitiet" rows="6"></textarea>
                </div>
            </div>
        </div>
    </form>
</section>