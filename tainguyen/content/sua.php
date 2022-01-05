<section class="container">
    <h2 class="fs-4">Sửa Bài Viết</h2>
    <?php
    $id = intval($_GET['id']);
    $flagcheck = true;
    if ($flagcheck) {
        if (isset($_POST['btnluu'])) {
            $tieude = $_POST['txt_tieude'];
            $mota = $_POST['txt_mota'];
            $chitiet = $_POST['txt_chitiet'];
            $anh_bai_viet = $_POST['anh_bai_viet'];
            $modul = $_POST['s_modul'];
            $nhom = $_POST['nhom'];
            $_POST['txt_date'] = str_replace("/", "-", $_POST['txt_date']);
            $ngaytao = date('Y-m-d H:i:s', strtotime($_POST['txt_date']));
            $hienthi = 0;
            if (isset($_POST['s_hienthi'])) {
                $hienthi = 1;
            }
            $error = false;
            //Kiểm tra xem bài viết đã có chưa
            // $sql = "SELECT id FROM b_content where tieude=:tieude and modul=:modul and id<>:id";
            // $a = $conn->prepare($sql);
            // $data = array("tieude" => $tieude, "modul" => $modul, "id" => $id);
            // $a->execute($data);
            // $checksua = $a->fetch();
            // if ($checksua) {
            //     echo '<p class="alert alert-danger">Bài viết đã tồn tại !</p>';
            //     $error = true;
            // } else {
            if ($tieude == "" || $hienthi == "") {
                echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
                $error = true;
            }
            // }
            if (!$error) {
                //Sửa và cập nhập dữ liệu thoe ID
                $sql = "UPDATE b_content SET tieude=:tieude,mota=:mota,chitiet=:chitiet,img_path=:link,modul=:modul,nhom=:nhom,ngaytao=:ngaytao,hienthi=:hienthi where id=:id";
                $q = $conn->prepare($sql);
                $data = array(
                    "tieude" => $tieude,
                    "mota" => $mota,
                    "chitiet" => $chitiet,
                    "link" => $anh_bai_viet,
                    "modul" => $modul,
                    "nhom" => $nhom,
                    "ngaytao" => $ngaytao,
                    "hienthi" => $hienthi,
                    "id" => $id,
                );
                $sua = $q->execute($data);
                if ($sua) {
                    echo '<p class="alert alert-success">Cập nhật thành công</p>';
                }
            }
        }
    }
    //Kiểm tra và lấy dữ liệu bản ghi theo ID
    $sql = "SELECT * FROM b_content WHERE id=:id";
    $q = $conn->prepare($sql);
    $data = array("id" => $id);
    $q->execute($data);
    $view = $q->fetch();
    if (!$view) {
        echo '<p class="alert alert-danger">Lỗi không lấy được bản ghi !</p>';
        $flagcheck = false;
    }

    ?>
    <!--Phần form dữ liệu  -->
    <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript" src="js/tinymce.js"></script>
    <form class="row g-3" action="" method="post">
        <p class="mb-2">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="txt_tieude" placeholder="Nhập tiêu đề bài viết" value="<?= $view['tieude'] ?>">
                </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Ảnh</label>
                    <div class="col-md-6 input-group">
                        <input type="text" class="form-control" id="link_anh" name="anh_bai_viet" value="<?= $view['img_path'] ?>" placeholder="Chọn ảnh mô tả bài viết">
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
                    <!-- <input type="text" class="form-control" name="txt_link" placeholder="Chọn đường dẫn bài viết" value="<?= $view['img_path'] ?>"> -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Modul <span class="text-danger">*</span></label>
                        <select class="form-select" aria-label="Default select example" name="s_modul">
                            <?php
                            //Liên kết bảng content <=> modul
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
                    <div class="col-6">
                        <label for="basic-url" class="form-label">Ngày tạo</label>
                        <div class="col-md-6 input-group">
                            <input type="text" class="form-control" id="txt_date" name="txt_date" value="<?= date("d/m/Y", strtotime($view['ngaytao'])) ?>">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Nhóm <span class="text-danger">*</span></label>
                        <select class="form-select" aria-label="Default select example" name="nhom">
                            <option value="">Chọn Modul</option>
                            <?php
                            //lien ket bang nhom
                            $sql = "SELECT * FROM nhom_content";
                            $a = $conn->prepare($sql);
                            $a->execute();
                            $view1 = $a->fetchAll();
                            foreach ($view1 as $key => $value) {
                                if ($view['nhom'] == $value['tieu_de']) {
                                    echo '<option value="' . $value['ma'] . '" selected>' . $value['tieu_de'] . '</option>';
                                } else {
                                    echo '<option value="' . $value['ma'] . '">' . $value['tieu_de'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 my-2 mt-3">
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
            <div class="col-md-8">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Mô tả</label>
                    <textarea id="inputEmail4" class="form-control" rows="3" name="txt_mota" placeholder="Nhập mổ tả bài viết"><?= $view['mota'] ?></textarea>
                </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Chi tiết</label>
                    <textarea id="chitiet" class="form-control" rows="12" name="txt_chitiet" placeholder="Nhập chi tiết bài viết"><?= $view['chitiet'] ?></textarea>
                </div>
            </div>
        </div>
    </form>


</section>