<section class="container">
    <h2 class="fs-4">Sửa Nhóm Bài Viết</h2>
    <?php
    $id = intval($_GET['id']);
    $flagcheck = true;
    if ($flagcheck) {
        if (isset($_POST['btnluu'])) {
            $tieude = $_POST['txt_tieude'];
            $mota = $_POST['txt_ma'];
            //Sửa và cập nhập dữ liệu thoe ID
            $sql = "UPDATE nhom_content SET tieu_de=:tieude,ma=:ma where id=:id";
            $q = $conn->prepare($sql);
            $data = array(
                "tieude" => $tieude,
                "ma" => $ma,
                "id" => $id,
            );
            $sua = $q->execute($data);
            if ($sua) {
                echo '<p class="alert alert-success">Cập nhật thành công</p>';
            }
        }
    }
    //Kiểm tra và lấy dữ liệu bản ghi theo ID
    $sql = "SELECT * FROM nhom_content WHERE id=:id";
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
            <div class="col-md-4 mx-auto">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="txt_tieude" placeholder="Nhập tên nhóm bài viết" value="<?= $view['tieu_de'] ?>">
                </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label my-2">Mã <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="txt_ma" placeholder="Nhập mã bài viết" value="<?= $view['ma'] ?>">
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary me-2" name="btnluu">Lưu</button>
                    <a href="?thumuc=<?= $_GET['thumuc'] ?>&file=group" type="button" class="btn btn-danger" name="btnluu">Hủy</a>
                </div>
            </div>
            
        </div>
    </form>


</section>