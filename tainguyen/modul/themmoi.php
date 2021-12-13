<section class="container">
    <h2 class="fs-4">Thêm mới Modul</h2>
    <?php
    if (isset($_POST['btnluu'])) {
        $ma = $_POST['txt_ma'];
        $tieude = $_POST['txt_tieude'];
        $ghichu = $_POST['txt_ghichu'];
        $hienthi = 0;
        if (isset($_POST['c_hienthi'])) {
            $hienthi = 1;
        }
        $error = false;

        if ($tieude == "" || $ma == "") {
            echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
            $error = true;
        }
        //Check xem modul đã tồn tại chưa
        $sql = "SELECT * FROM b_modul WHERE tieude=:tieude";
        $q = $conn->prepare($sql);
        $data = array("tieude" => $tieude);
        $q->execute($data);
        $checkadd = $q->fetch();
        if ($checkadd) {
            echo '<p class="alert alert-danger">Tiêu đề đã có !</p>';
            $error = true;
        }
        if (!$error) {
            //Thêm dư liệu
            $sql="INSERT INTO b_modul(ma,tieude,ghichu,hienthi) VALUES(:ma,:tieude,:ghichu,:hienthi)";
                $q=$conn->prepare($sql);
                $data=array(
                    "ma"=> $ma,
                    "tieude"=>$tieude,
                    "ghichu"=>$ghichu,
                    "hienthi"=>$hienthi,
                );
                $add=$q->execute($data);
            if ($add) {
                echo '<p class="alert alert-success">Thêm thành công</p>';
            }
        }
    }
    ?>
    <form class="row g-3" action="" method="post">
        <p class="mb-0">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="col-md-3">
            <label for="inputEmail4" class="form-label">Mã <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txt_ma">
        </div>
        <div class="col-md-9">
            <label for="inputEmail4" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txt_tieude">

        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Ghi chú</label>
            <textarea class="form-control" type="text" name="txt_ghichu" id="inputAddress2" rows="4"></textarea>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" name="c_hienthi">
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