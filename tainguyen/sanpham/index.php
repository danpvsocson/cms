<?php
    if (empty($_GET['page'])) {
        $_GET['page'] = 1;
    }
    $ban_ghi = 10;
    include('tainguyen/sanpham/xoa.php');
    //Lấy dữ liệu từ database 
    $sql = ("SELECT san_pham.*,
                b_modul.tieude as tieudemodul
            FROM san_pham 
                left outer join b_modul on b_modul.ma=san_pham.modul 
                limit " . (($_GET['page'] - 1) * $ban_ghi) . "," . $ban_ghi);
    $q = $conn->prepare($sql);
    $q->execute();
    $view_all = $q->fetchAll();
?>
<section>
    <div class="container-fluid">
        <h2 class="float-start fs-4">Danh Sách Sản Phẩm</h2>
        <a href="?thumuc=<?= $_GET['thumuc'] ?>&file=themmoi" class="float-end mt-2 mb-3 me-3 text-decoration-none btn btn-primary"><i class="bi bi-plus-lg"></i> Thêm Sản Phẩm</a>
        <div class="clearfix "></div>
        <hr class="mt-0">
        <table class="table border table table-hover table-bordered bg-white">
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Modul</th>
                <th>Link ảnh</th>
                <th>Mô tả</th>
                <th>Giá mới</th>
                <th>Giá gốc</th>
                <th>Giảm giá (<span class="text-danger">%</span>)</th>
                <th>Hiển thị</th>
                <th class="text-center">Sửa</th>
                <th class="text-center">Xóa</th>
            </tr>
            <style>
                td img {
                    width: 100%;
                    height: 200px;
                    object-fit: cover;
                }
            </style>
            <tbody>
                <?php
                $i = 1;
                $giam_gia = 0;
                foreach ($view_all as $key => $info) {
                    echo '<tr>
                            <td>' . ($i++) . '</td>
                            <td>' . $info['ten_san_pham'] . '</td>
                            <td>' . $info['tieudemodul'] . '</td>
                            <td><img class".img" src="' . $info['anh_san_pham'] . '"  alt=""></td>
                            <td>' . $info['mota'] . '</td>';
                    if ($info['gia_moi'] == 0) {
                        echo '<td><p>Giá không đổi !</p></td>';
                    } else {
                        echo '<td><p class="text-success">' . $info['gia_moi'] . '</p></td>';
                    }

                    echo '<td>' . $info['gia_cu'] . '</td>';
                    if ($info['giam_gia'] == 0) {
                        echo '<td><p>Không giảm giá</p></td>';
                    } else {
                        echo '<td>' . $info['giam_gia'] . '</td>';
                    }
                    if ($info['hien_thi'] == 1) {
                        echo '<td><p class="text-success">Hiển Thị</p></td>';
                    } else {
                        echo '<td><p class="text-danger">Ẩn</p></td>';
                    }
                    echo '<td class="text-center"><a href="?thumuc=' . $_GET['thumuc'] . '&file=sua&id=' . $info['id'] . '" class="btn btn-primary btn-sm">Sửa</a></td>
                            <td class="text-center"><button class="btn btn-danger btn-sm" onclick="xoa(' . $info['id'] . ')">Xóa</button></td>
                        </tr>';
                }

                ?>
            </tbody>
        </table>
        <section>
            <form action="" method="post" id="IDdel">
                <input type="hidden" id="delete" name="iddelete" value="">
            </form>
        </section>
        <script type="text/javascript">
            function xoa(id) {

                if (confirm("Bạn có chắc chắn muốn xóa hay không ?")) {
                    var del = document.getElementById("delete");
                    del.value = id;
                    console.log(del);
                    var autodel = document.getElementById("IDdel");
                    autodel.submit();
                }
            }
        </script>
        <nav aria-label="Page navigation example" style="margin-left: 49%;">
            <ul class="pagination m-0">

                <?php
                $q = $conn->prepare("SELECT * from san_pham order by id ASC");
                $q->execute();
                $rc = $q->rowCount();
                $tong_page = 0;
                if ($rc % $ban_ghi == 0) {
                    $tong_page = floor($rc / $ban_ghi);
                } else {
                    $tong_page = floor($rc / $ban_ghi) + 1;
                }
                if ($_GET['page'] > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?thumuc=sanpham&file=index&page=' . ($_GET['page'] - 1) . '">Trước</a></li>';
                }
                for ($i = $_GET['page'] - 2; $i <= $_GET['page'] + 2; $i++) {

                    if ($i == $_GET['page'] && $i <= $tong_page) {
                        echo '<li class="page-item active"><a class="page-link" href="?thumuc=sanpham&file=index&page=' . $i . '">' . $i . '</a></li>';
                    } else {
                        if ($i > 0 && $i <= $tong_page) {
                            echo '<li class="page-item"><a class="page-link" href="?thumuc=sanpham&file=index&page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }
                if ($_GET['page'] < $tong_page) {
                    echo '<li class="page-item"><a class="page-link" href="?thumuc=sanpham&file=index&page=' . ($_GET['page'] + 1) . '">Sau</a></li>';
                }
                ?>

            </ul>


        </nav>
        <div class="text-center" style="font-size: 13px;"><p class="" style="margin-left: 100%;"><?php echo '<p>Trang ' . $_GET['page'] . '/' . $tong_page . '</p>'; ?></p></div>
    </div>
</section>