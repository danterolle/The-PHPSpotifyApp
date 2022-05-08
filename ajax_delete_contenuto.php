<?php

    if(isset($_GET["ID"]) &&
    isset($_GET["IDBrano"])) {
    

        $conn = mysqli_connect("localhost","root","","Homework1") or die("Errore: ".mysqli_connect_error());
        mysqli_query($conn,'SET CHARACTER SET utf8');
        $raccolta = mysqli_real_escape_string($conn,$_GET["ID"]);
        $ID = mysqli_real_escape_string($conn,$_GET["IDBrano"]);
        $insert = "delete from Contenuto where IDPlaylist ='$raccolta' and IDBrano ='$ID'"; 
        $res_insert =  mysqli_query($conn,$insert) or die("Errore: ".mysqli_error($conn));
        mysqli_free_result($res_insert);
        mysqli_close($conn);
        
    }
?>