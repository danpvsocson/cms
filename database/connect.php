<?php
    try{
        $conn = new PDO("mysql:host=localhost;dbname=ketthucmon;charset=utf8mb4", 'root', '');
        // $conn = new PDO("mysql:host=localhost;dbname=id17630258_cnttcoit;charset=utf8mb4",'id17630258_cnttcoitk14','CNTTabc123@123');
        // $conn = new PDO("mysql:host=localhost;dbname=id18088157_tuhocict;charset=utf8mb4",'id18088157_tuhocict2','Cntt@$123456');
    } catch(PDOException $e){
        echo $e->getMessage();
    }
    
   

?>
