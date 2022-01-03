<section class="container">
    <h2 class="fs-4">Thêm Nhóm Bài Viết</h2>
    <?php
    if (isset($_POST['btnluu'])) {
        $tieude = $_POST['txt_tieude'];
        $ma = $_POST['txt_ma'];
        //Thêm dữ liệu => database
        $sql = "INSERT INTO nhom_content(tieu_de,ma) VALUES(:tieude,:ma)";
        $q = $conn->prepare($sql);
        $data = array(
            "tieude" => $tieude,
            "ma" => $ma,
        );
        $add = $q->execute($data);
        if ($add) {
            echo '<p class="alert alert-success">Thêm thành công</p>';
        }
    }
    ?>
    <form class="row g-3" action="" method="post">
        <p class="mb-2">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="txt_tieude" placeholder="Nhập tên nhóm bài viết">
                </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label my-2">Mã<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="txt_ma" placeholder="Nhập mã">
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary me-2" name="btnluu">Lưu</button>
                    <a href="?thumuc=<?= $_GET['thumuc'] ?>&file=group" type="button" class="btn btn-danger" name="btnluu">Hủy</a>
                </div>
            </div>
        </div>
    </form>
</section>