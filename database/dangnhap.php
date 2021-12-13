<?php
    include('database/connect.php');
    $sql ="SELECT * FROM admin WHERE username=:taikhoan and password=:matkhau" ;
    $a = $conn->prepare($sql);
    $data = array("taikhoan"=>$username, "matkhau"=>$password);
    $a->execute($data);
    $login = $a->fetch();
?>
  