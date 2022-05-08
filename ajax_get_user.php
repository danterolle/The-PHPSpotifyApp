<?php
    $conn = mysqli_connect("localhost","root","","Homework1") or die("Errore: ".mysqli_connect_error());
    mysqli_query($conn,'SET CHARACTER SET utf8');
    $array = array();
    $query = "select Username from Utente";
    $res = mysqli_query($conn,$query) or die("Errore: ".mysqli_error($conn));
    while($row = mysqli_fetch_assoc($res)){
        $array[] = $row;
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($array);
?>