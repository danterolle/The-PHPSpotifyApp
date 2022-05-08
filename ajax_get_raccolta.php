<?php
    session_start();

    if( isset($_SESSION["Username"])){

        $conn = mysqli_connect("localhost","root","","Homework1") or die("Errore: ".mysqli_connect_error());
        mysqli_query($conn,'SET CHARACTER SET utf8');
        $array = array();
        $user = mysqli_real_escape_string($conn,$_SESSION["Username"]);
        $query = "select * from Playlist where User = '$user'"; //seleziono tutte le collezioni dell'utente attivo
        $res = mysqli_query($conn,$query) or die("Errore: ".mysqli_error($conn));
        while($row = mysqli_fetch_assoc($res)){
            $array[] = $row;
        }
        mysqli_free_result($res);
        echo json_encode($array);
    }
?>