<?php

    include('tainguyen/headerhome.php');
    include('database/connect.php');
    if(isset($_GET['thumuc'])){
        $thumuc=$_GET['thumuc'];
        
        if(isset($_GET['file'])){
            $file=$_GET['file'];
            if(isset($_GET['thumuc'])){
                if(file_exists('tainguyen/'.$thumuc.'.php')){
                    include('tainguyen/'.$thumuc.'.php');
                }
                // else{
                //     include('tainguyen/error.php');
                // }
            }  
            if(file_exists('tainguyen/'.$thumuc.'/'.$file.'.php')){
                include('tainguyen/'.$thumuc.'/'.$file.'.php');
            }else{
                include('tainguyen/error.php');
            }
        }
        
    }else{
        include('tainguyen/home.php');
    }
  
  include('tainguyen/footerhome.php');
?>

    