<?php
    include('database/connect.php');
    $sql ="UPDATE admin SET password = :matkhau;";
    $a = $conn->prepare($sql);
    $data = array("matkhau"=>$passwordnew2);
    $a->execute($data);
    $update = $a->fetch();
    
?>