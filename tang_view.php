<?php
    $tangluotxem=intval($view['luotxem']) +1;
    $sql = "UPDATE b_conten set luotxem=:luotxem where id=:id";
    $q = $conn->prepare($sql);
    $data=array("luotxem" => $tangluotxem, "id" => $id);
    $q->execute($data);
    //
?>