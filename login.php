<?php
    //avvio sessione
    session_start();
    if(isset($_SESSION["Username"])){
        header("Location: home.php");
        exit;
    }

    if(isset($_POST["Username"])  && isset($_POST["pasw"])){
        $username = $_POST["Username"];
        $password = $_POST["pasw"];
        $conn = mysqli_connect("localhost","root","","Homework1") or die("Errore: ".mysqli_connect_error());
        mysqli_query($conn,'SET CHARACTER SET utf8');
        $query = "select nome from Utente where Username = '$username' and password = '$password'";
        $res = mysqli_query($conn,$query) or die("Errore: ".mysqli_error($conn));
        $row = mysqli_fetch_row($res);
        if($row != null){
            $_SESSION["Username"] = $username;
            header("Location:home.php");
            exit;
        }
        else {
            $errore = true;
        }
    }
?>


<html>
   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1">
        <title>Homework 1</title>
 
    </head>
    <body id="body-log">
        
        <section id="log">
            <form name="login" method='post'>
                <div>
                    <label class="label">Username <input type="text" name="Username"placeholder="Inserisci l'username" required></label>
                </div>
                <div>
                    <label class="label">Password <input type="password" name="pasw" placeholder="Inserisci una password" required></label>
                </div>
                <div>

                    <button onclick="window.location.href='signup.php'">Registrati</button>
                    <button type = "submit"> Accedi </button>
                </div>
            </form>
            <?php
            if(isset($errore)){
                echo "<h1 class='red'>";
                echo "Credenziali Errate. Ritenta.";
                echo "</h1>";
            }
            ?>
        </section> 
    </body>
</html>
