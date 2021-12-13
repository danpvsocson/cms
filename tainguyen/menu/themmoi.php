<section class="container">
    <h2 class="fs-4">Thêm mới Menu</h2>
    <?php
        if (isset($_POST['btnluu'])) {
            $id_cha = $_POST['id_cha'];
            $tieude = $_POST['txt_tieude'];
            $link = $_POST['txt_link'];
            $modul = $_POST['s_modul'];
            $nhom = $_POST['nhom'];
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
            if (!$error) {
                //Sủa dữ liệu
                $sql="INSERT INTO b_menu(id_cha,tieude,link,modul,nhom,ghichu,hienthi) VALUES(:id_cha,:tieude,:link,:modul,:nhom,:ghichu,:hienthi)";
                $q=$conn->prepare($sql);
                $data=array(
                    "id_cha"=> $id_cha,
                    "tieude"=>$tieude,
                    "link"=>$link,
                    "modul"=>$modul,
                    "nhom"=>$nhom,
                    "ghichu"=>$ghichu,
                    "hienthi"=>$hienthi,
                );
                $add=$q->execute($data);
                if ($add) {
                    echo '<p class="alert alert-success">Thêm thành công</p>';
                }else{
                    echo '<p class="alert alert-danger>Lỗi cú pháp</p>';
                }
            }
        }
    ?>
    <form class="row g-3" action="" method="post">
        <p class="mb-0">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="col-md-5">
            <label for="inputEmail4" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txt_tieude" placeholder="Nhập tiêu đề menu">

        </div>
        <div class="col-md-4">
            <label for="inputEmail4" class="form-label">Modul <span class="text-danger">*</span></label>
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
        <div class="col-md-3">
            <label for="inputEmail4" class="form-label">Menu Cha</label>
            <select class="form-select" aria-label="Default select example" name="id_cha">
                <option value="">---Chọn Menu Cha---</option>
                <?php
                    //Liên kết bảng menu <=> modul => menu cha
                    $sql = "SELECT b_menu.*,
                                b_modul.tieude as tieudemodul
                            FROM b_menu 
                                left outer join b_modul on b_modul.ma=b_menu.modul
                            where IFNULL(id_cha, 0)=0";
                    $q = $conn->prepare($sql);
                    $q->execute();
                    $show = $q->fetchAll();
                    foreach ($show as $key => $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['tieude'] . ' của ' . $value['tieudemodul'] . '</option>';
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Link</label>
            <input type="text" class="form-control" name="txt_link" placeholder="Đường dẫn">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Nhóm <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="nhom">
                <option value="">Chọn Modul</option>
                <?php
                    //Liên kết bảng <=> modul
                    $sql = "SELECT * FROM nhom";
                    $a = $conn->prepare($sql);
                    $a->execute();
                    $view1 = $a->fetchAll();
                    foreach ($view1 as $key => $info) {
                        echo '<option value="' . $info['tieude'] . '">' . $info['tieude'] . '</option>';
                    }
                ?>
            </select>
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Ghi chú</label>
            <textarea type="text" class="form-control" id="inputAddress2" name="txt_ghichu" rows="3" placeholder="Nhập ghi chú"></textarea>
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