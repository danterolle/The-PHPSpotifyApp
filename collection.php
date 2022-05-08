<?php
    //avvio sessione
    session_start();
    if(!isset($_SESSION["Username"])){
        header("Location:login.php");
        exit;
    }
?>
<html>
    <head>
        <title>Collection</title>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2ycIDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="/static/css/style.css"/> 
        <script src="/static/js/collection.js" defer="true"></script>

 <body>
  <section ID="Research">
    <div ID="menubar">
    <h1><i class="fas fa-user"></i> Ciao <?php echo $_SESSION["Username"]?></h1>
        <ul style="list-style-type:none;">
            <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="search.php"><i class="fas fa-search"></i> Ricerca</a></li>
            <li><a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
</div>
    <div ID="visualizzaContenuti"></div>
</section>

</body>
</html>