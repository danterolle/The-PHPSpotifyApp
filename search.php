<?php
    session_start();
    if(!isset($_SESSION["Username"])){
        header("Location:login.php");
        exit;
    }
?>


<html>
    <head>
        <title> Homework 1 </title>
        <meta charset = "utf-8">
        <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1">
        <link rel="stylesheet" href="/static/css/style.css"/> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2ycIDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <script src="/static/js/search.js" defer="true"></script>
    </head>
    <body ID = "body">
    <section>
    <div ID = "MenuRicerca">
        <h1><i class="fas fa-user"></i> Ciao <?php echo $_SESSION["Username"]?></h1>
        <ul style="list-style-type:none;"> 
            <li><a href="home.php"><i class="fas fa-home"></i> Home </a></li>
            <li><a href="search.php"><i class="fas fa-search"></i> Ricerca </a></li>
            <li><a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout </a></li>
        </ul>
    </div>

    <div ID = "contenuti">
        <form name="search" ID="FormRicerca">
            <p>
                <label> Cerca un brano <input type="text" name="cerca"></label>
            </p>
            <p>
                <br>
                 <button type = "submit"> Invio </button>
            </p>
        </form>
        <form name="selectR" ID = "selezionaRaccolta" class ="hIDden">
        <p ID=afterSelect class = "hIDden">Inserire il nome della playlist in cui vuoi aggiungere il brano selezionato</p>

            <p>
                <label><input type="text" name="raccolta"></label>
            </p>
            <p>
                 <button type = "submit"> Invio </button>
            </p>
        </form>
</div>
</section>
    </body>
</html>