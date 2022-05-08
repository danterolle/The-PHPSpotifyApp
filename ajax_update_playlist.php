<?php
//avvio sessione
    session_start();

    if(isset($_GET["IDPlaylist"]) &&
    isset($_GET["url"]) &&
    isset($_SESSION["Username"])){

        $conn = mysqli_connect("localhost","root","","Homework1") or die("Errore: ".mysqli_connect_error());
        mysqli_query($conn,'SET CHARACTER SET utf8');
        $ID = mysqli_real_escape_string($conn,$_GET["IDPlaylist"]);
        $user = mysqli_real_escape_string($conn,$_SESSION["Username"]);
        $image= mysqli_real_escape_string($conn,$_GET["url"]);
        $insert = "UPDATE Playlist SET Url_immagine = '$image' where ID = '$ID' and User = '$user' "; 
        $res_insert =  mysqli_query($conn,$insert) or die("Errore: ".mysqli_error($conn));
        mysqli_free_result($res_insert);
        mysqli_close($conn);
        
    }
?>