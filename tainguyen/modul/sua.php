<section class="container">
    <h2 class="fs-4">Sửa Modul</h2>
    <?php
    $id = intval($_GET['id']);
    $flagcheck = true;



    if ($flagcheck) {
        if (isset($_POST['btnluu'])) {
            $ma = $_POST['txt_ma'];
            $tieude = $_POST['txt_tieude'];
            $ghichu = $_POST['txt_ghichu'];
            $hienthi = 0;
            if (isset($_POST['s_hienthi'])) {
                $hienthi = 1;
            }
            $error = false;
            //Kiểm tra xem modul có trùng với modul nào không
            $sql = "SELECT id FROM b_modul where ma=:ma and tieude=:tieude and id<>:id";
            $a = $conn->prepare($sql);
            $data = array("ma" => $ma, "tieude" => $tieude, "id" => $id);
            $a->execute($data);
            $checksua = $a->fetch();

            if ($checksua) {
                echo '<p class="alert alert-danger">Modul đã tồn tại !</p>';
                $error = true;
            } else {
                if ($ma == "" || $tieude == "") {
                    echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
                    $error = true;
                }
            }

            if (!$error) {
                //Sửa dữ liệu
                $sql = "UPDATE b_modul SET ma=:ma,tieude=:tieude,ghichu=:ghichu,hienthi=:hienthi where id=:id";
                $q = $conn->prepare($sql);
                $data = array(
                    "ma" => $ma,
                    "tieude" => $tieude,
                    "ghichu" => $ghichu,
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
    //Lấy dữ liệu bản ghi cần sửa
    $sql = "SELECT * FROM b_modul WHERE id=:id";
    $a = $conn->prepare($sql);
    $data = array("id" => $id);
    $a->execute($data);
    $view = $a->fetch();
    if (!$view) {
        echo '<p class="alert alert-danger">Lỗi không lấy được bản ghi !</p>';
        $flagcheck = false;
    }

    ?>
    <form class="row g-3" action="" method="post">
        <p class="mb-0">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="col-md-3">
            <label for="inputEmail4" class="form-label">Mã <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txt_ma" value="<?= $view['ma'] ?>">
        </div>
        <div class="col-md-9">
            <label for="inputEmail4" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txt_tieude" value="<?= $view['tieude'] ?>">

        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Ghi chú</label>
            <textarea class="form-control" type="text" name="txt_ghichu" id="inputAddress2" rows="4"><?= $view['ghichu'] ?></textarea>
        </div>
        <div class="col-12">
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
        <div class="col-12">
            <button type="submit" class="btn btn-primary me-2" name="btnluu">Lưu</button>
            <a href="?thumuc=<?= $_GET['thumuc'] ?>&file=index" type="button" class="btn btn-danger" name="btnluu">Hủy</a>
        </div>
    </form>
</section>