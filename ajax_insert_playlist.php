<?php
//avvio sessione
session_start();


if(isset($_GET["Titolo"]) && isset($_SESSION["Username"])){

    $conn = mysqli_connect("localhost","root","","Homework1") or die("Errore: ".mysqli_connect_error());
    mysqli_query($conn,'SET CHARACTER SET utf8');
    $playlist = mysqli_real_escape_string($conn,$_GET["Titolo"]);
    $user = mysqli_real_escape_string($conn,$_SESSION["Username"]);
    $image= mysqli_real_escape_string($conn,"http://localhost/Homework1/image.png");
    $insert = "insert into Playlist(Titolo,User,Url_immagine)  values ('$playlist','$user','$image')"; 
    $res_insert =  mysqli_query($conn,$insert) or die("Errore: ".mysqli_error($conn));
    mysqli_free_result($res_insert);
    mysqli_close($conn);
    
}
?>