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
            $sql1 = "DELETE FROM b_banner where id=:id";
            $a = $conn->prepare($sql1);
            $data1 = array("id" => $id);
            $a->execute($data1);
            $xoa = $a;
            if($xoa){
                echo '<p class="alert alert-success text-center">Đã Xóa</p>';
            }else{
                echo '<p class="alert alert-danger text-center">Lỗi cú pháp !</p>';
            }
        }
    }
?>
