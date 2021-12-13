<section class="container">
    <h2 class="fs-4">Sửa Banner</h2>
    <?php
    $id = intval($_GET['id']);
    $flagcheck = true;
    if ($flagcheck) {
        if (isset($_POST['btnluu'])) {
            $tieude = $_POST['txt_tieude'];
            $mo_ta = $_POST['txt_mota'];
            $chi_tiet = $_POST['txt_chitiet'];
            $link = $_POST['txt_link'];
            $modul = $_POST['s_modul'];
            $ghichu = $_POST['txt_ghichu'];
            $hienthi = 0;
            if (isset($_POST['s_hienthi'])) {
                $hienthi = 1;
            }
            $error = false;
            //Kiểm tra xem banner có chưa
            $sql = "SELECT id FROM b_banner where tieude=:tieude and modul=:modul and id<>:id";
            $a = $conn->prepare($sql);
            $data = array("tieude" => $tieude, "modul" => $modul, "id" => $id);
            $a->execute($data);
            $checksua = $a->fetch();
            if ($checksua) {
                echo '<p class="alert alert-danger">Banner đã tồn tại !</p>';
                $error = true;
            } else {
                if ($tieude == "" || $hienthi == "") {
                    echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
                    $error = true;
                }
            }
            if (!$error) {
                //Sủa dữ liệu
                $sql1 = "UPDATE b_banner SET tieude=:tieude,mo_ta=:mo_ta,chi_tiet=:chi_tiet,img_path=:link,modul=:modul,ghichu=:ghichu,hienthi=:hienthi where id=:id";
                $q = $conn->prepare($sql1);
                $data1 = array(
                    "tieude" => $tieude,
                    "mo_ta" => $mo_ta,
                    "chi_tiet" => $chi_tiet,
                    "link" => $link,
                    "modul" => $modul,
                    "ghichu" => $ghichu,
                    "hienthi" => $hienthi,
                    "id" => $id,
                );
                $sua = $q->execute($data1);
                if ($sua) {
                    echo '<p class="alert alert-success">Cập nhật thành công</p>';
                }
            }
        }
    }
    //Lấy dữ liệu theo ID
    $sql = "SELECT * FROM b_banner WHERE id=:id";
    $q = $conn->prepare($sql);
    $data = array("id" => $id);
    $q->execute($data);
    $view = $q->fetch();
    if (!$view) {
        echo '<p class="alert alert-danger">Lỗi không lấy được bản ghi !</p>';
        $flagcheck = false;
    }

    ?>
    <form class="row g-3" action="" method="post">
        <p class="mb-0">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="col-4">
            <div class="row">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label mb-2">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="txt_tieude" value="<?= $view['tieude'] ?>" placeholder="Nhập tiêu đề">
                </div>
                <label for="inputEmail4" class="form-label my-2">Ảnh</label>
                <div class="col-md-12 input-group">
                    <input type="text" class="form-control" id="link_anh" name="txt_link" value="<?= $view['img_path'] ?>">
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
                <div class="col-12">
                    <label for="inputAddress2" class="form-label my-2">Ghi chú</label>
                    <textarea type="text" class="form-control" id="inputAddress2" name="txt_ghichu" rows="3"><?= $view['ghichu'] ?></textarea>

                </div>
                <div class="col-md-8 mt-6">
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
                <div class="col-md-12 mt-4">
                    <div class="form-check">
                        <?php
                        if ($view['hienthi'] == 0) {
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
        </div>
        <div class="col-8">
            <div class="row">
                <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
                <script type="text/javascript" src="js/tinymce.js"></script>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Mô tả</label>
                    <input type="text" class="form-control" id="inputAddress2" name="txt_mota" placeholder="Nhập mô tả" value="<?=$view['mo_ta'] ?>">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label my-2">Chi tiết</label>
                    <textarea name="txt_chitiet" class="form-control" id="chitiet" rows="6"><?=$view['chi_tiet'] ?></textarea>
                </div>
            </div>
        </div>
    </form>


    
</section>