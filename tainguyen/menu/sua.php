<section class="container">
    <h2 class="fs-4">Sửa Menu</h2>
    <?php
        $id = intval($_GET['id']);
        $flagcheck = true;
        if ($flagcheck) {
            if (isset($_POST['btnluu'])) {
                $id_cha = $_POST['id_cha'];
                $tieude = $_POST['txt_tieude'];
                $link = $_POST['txt_link'];
                $modul = $_POST['s_modul'];
                $nhom = $_POST['nhom'];
                $ghichu = $_POST['txt_ghichu'];
                $hienthi = 0;
                if (isset($_POST['s_hienthi'])) {
                    $hienthi = 1;
                }
                $error = false;
                if ($tieude == "" || $hienthi == "") {
                    echo '<p class="alert alert-danger">Hãy nhập đầy đủ thông tin mục có chứa (<span class="text-danger">*</span>)</p>';
                    $error = true;
                }
                if (!$error) {
                    //Sửa dữ liệu
                    $sql = "UPDATE b_menu SET id_cha=:id_cha,tieude=:tieude,link=:link,modul=:modul,nhom=:nhom,ghichu=:ghichu,hienthi=:hienthi where id=:id";
                    $q = $conn->prepare($sql);
                    $data = array(
                        "id_cha" => $id_cha,
                        "tieude" => $tieude,
                        "link" => $link,
                        "modul" => $modul,
                        "nhom"=>$nhom,
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
        //Kiểm tra và lấy ra bản ghi theo ID
        $sql ="SELECT * FROM b_menu WHERE id=:id";
        $q = $conn->prepare($sql);
        $data = array("id"=>$id);
        $q->execute($data);
        $view = $q->fetch();
        if (!$view) {
            echo '<p class="alert alert-danger">Lỗi không lấy được bản ghi !</p>';
            $flagcheck = false;
        }
    ?>
    <form class="row g-3" action="" method="post">
        <p class="mb-0">Hãy điền đủ mục (<span class="text-danger">*</span>)</p>
        <div class="col-md-5">
            <label for="inputEmail4" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txt_tieude" placeholder="Nhập tiêu đề menu" value="<?=$view['tieude']?>">

        </div>
        <div class="col-md-4">
            <label for="inputEmail4" class="form-label">Modul <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="s_modul">
                <?php
                    //Dữ liệu bảng modul
                    $sql ="SELECT * FROM b_modul";
                    $a = $conn->prepare($sql);
                    $a->execute();
                    $view1 = $a->fetchAll();
                    foreach($view1 as $key => $value) {
                        if($view['modul']==$value['ma']){
                            echo '<option value="'.$value['ma'].'" selected>'.$value['tieude'].'</option>';
                        }else{
                            echo '<option value="'.$value['ma'].'">'.$value['tieude'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="inputEmail4" class="form-label">Menu Cha</label>
            <select class="form-select" aria-label="Default select example" name="id_cha">
                <option value="">--- Lựa chọn menu(Không chọn) ---</option>
                <?php
                    //Liên kết bảng menu <=> modul
                    $sql="SELECT b_menu.*,
                            b_modul.tieude as tieudemodul
                        FROM b_menu 
                            left outer join b_modul on b_modul.ma=b_menu.modul
                        where IFNULL(id_cha, 0)=0";
                    $q=$conn->prepare($sql);
                    $q->execute();
                    $show = $q->fetchAll();
                    foreach ($show as $key => $value) {
                        if($value['id']==$view['id_cha']){
                            echo '<option value="'.$value['id'].'" selected>'.$value['tieude'].' của '.$value['tieudemodul'].'</option>';
                        }
                        else{
                            echo '<option value="'.$value['id'].'">'.$value['tieude'].' của '.$value['tieudemodul'].'</option>';
                        } 
                    }
                ?>
            </select>
        </div>
        
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Link</label>
            <input type="text" class="form-control" name="txt_link" placeholder="Nhập đường dẫn" value="<?= $view['link']?>">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Nhóm <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="nhom">
                <option value="">Chọn Modul</option>
                <?php
                    //lien ket bang nhom
                    $sql ="SELECT * FROM nhom";
                    $a = $conn->prepare($sql);
                    $a->execute();
                    $view1 = $a->fetchAll();
                    foreach($view1 as $key => $value) {
                        if($view['nhom']==$value['tieude']){
                            echo '<option value="'.$value['tieude'].'" selected>'.$value['tieude'].'</option>';
                        }else{
                            echo '<option value="'.$value['tieude'].'">'.$value['tieude'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Ghi chú</label>
            <textarea type="text" class="form-control" id="inputAddress2" name="txt_ghichu" rows="3" placeholder="Nhập ghi chú"><?= $view['ghichu'] ?></textarea>
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