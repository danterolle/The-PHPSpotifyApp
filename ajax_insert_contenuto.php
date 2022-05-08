<?php

    if(isset($_GET["IDPlaylist"]) &&
    isset($_GET["nome"]) && 
    isset($_GET["IDBrano"]) && 
    isset($_GET["artist"]) && 
    isset($_GET["album"]) &&
    isset($_GET["url"])){

        $conn = mysqli_connect("localhost","root","","Homework1") or die("Errore: ".mysqli_connect_error());
        mysqli_query($conn,'SET CHARACTER SET utf8');
        $raccolta = mysqli_real_escape_string($conn,$_GET["IDPlaylist"]);
        $nome = mysqli_real_escape_string($conn,$_GET["nome"]);
        $ID = mysqli_real_escape_string($conn,$_GET["IDBrano"]);
        $artista = mysqli_real_escape_string($conn,$_GET["artist"]);
        $album = mysqli_real_escape_string($conn,$_GET["album"]);
        $image= mysqli_real_escape_string($conn,$_GET["url"]);
        $insert = "insert into Contenuto values ('$ID','$raccolta','$nome','$artista','$album','$image')"; 
        $res_insert =  mysqli_query($conn,$insert) or die("Errore: ".mysqli_error($conn));
        mysqli_free_result($res_insert);
        mysqli_close($conn);
        
    }
?>