<?php
    if(isset($_POST['iddelete'])){
        $id=intval($_POST['iddelete']);
        $checked=false;
        if($id==0){
            echo '<p class="alert alert-danger">Không tìm thấy ID cần xóa</p>';
            $checked=true;
        }
        if(!$checked){
           //Xóa dữ liệu
            $sql = "DELETE FROM b_modul where id=:id";
            $a = $conn->prepare($sql);
            $data = array("id" => $id);
            $a->execute($data);
            $xoa = $a;
            if($xoa){
                echo '<p class="alert alert-success text-center">Đã Xóa</p>';
            }else{
                echo '<p class="alert alert-danger text-center">Lỗi cú pháp !</p>';
            }
        }
    }
?>
