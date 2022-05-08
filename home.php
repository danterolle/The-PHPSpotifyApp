<?php
    //avvio sessione
    session_start();
    if(!isset($_SESSION["Username"])){
        header("Location: login.php");
        exit;
    }
?>


<html>
    <head>
        <title>Homework 1</title>
        <meta charset = "utf-8">
        <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1">
        <link rel="stylesheet" href="/static/css/style.css"/> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2ycIDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <script src="/static/js/home.js" defer="true"></script>
    </head>
  <body>
    <section id = "Research">
      <div id = "menubar">
        <h1><i class="fas fa-user"></i> Ciao <?php echo $_SESSION["Username"]?></h1>
        <ul style="list-style-type:none;">
            <li><a href="home.php"><i class="fas fa-home"></i> Home </a></li>
            <li><a href="search.php"><i class="fas fa-search"></i> Ricerca</a></li>
            <li><a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </div>
        <div id = "DivRaccolte">
           <form name = "create" id = "FormRicerca">
             <p><label id = "label"> Crea una nuova playlist: <input type="text" name="create"></label></p>
             <p><button type = "submit"> Invio </button></p>
            </form>
            <br>
            <div id = "visualizzaPlaylist"><h1 id = "title"> Le tue playlist: </h1></div>
        </div>
    </section> 
  </body>
</html>