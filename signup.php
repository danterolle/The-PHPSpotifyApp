<?php
    //avvio sessione
    session_start();
    if(isset($_SESSION["utente"])){
        header("Location:home.php");
        exit;
    }

    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && 
    isset($_POST["email"]) && isset($_POST["pasw"]) && 
    isset($_POST["confirm"]) && isset($_POST["utente"])){
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $email = $_POST["email"];
        $password = $_POST["pasw"];
        $utente = $_POST["utente"];
        $conf_pasw = $_POST["confirm"];

        if($password == $conf_pasw){//controllo password
            $conn = mysqli_connect("localhost","root","","Homework1") or die("Errore: ".mysqli_connect_error());
            mysqli_query($conn,'SET CHARACTER SET utf8');
            $query = "select nome from Utente where Username = '$utente'";
            $res = mysqli_query($conn,$query) or die("Errore: ".mysqli_error($conn));
            $row = mysqli_fetch_row($res);
            if($row == null){//controllo utente
                echo "Username ok!";
                if(strpos($email,'@')){//controllo mail
                    $query_ins = "insert into Utente values ('$nome','$cognome','$email','$utente','$password')";
                    $res_ins = mysqli_query($conn,$query_ins) or die("Errore: ".mysqli_error($conn));
                    mysqli_free_result($res);
                    mysqli_close($conn);
                    //variabile sessione
                    $_SESSION["utente"] = $utente;
                    header("Location:home.php");
                    exit;
                }
                else{
                    $errore = true;
                }
            }
            else{
                $errore = true;
            }
        }
        else {
            $errore = true;
        }
    }
?>


<html>
   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Homework 1</title>
        <script src="/static/js/signup.js" defer="true"></script>
    </head>
    <body>
        <div id="title-signup">
        </div>
        <?php
            if(isset($errore)){
                echo "<h1 class='red'>";
                echo "Credenziali non valide.";
                echo "</h1>";
            }
        ?>
        <section>
            <form name="signup" method='post'>
                <div>
                    <label>Nome <input type="text" name="nome" placeholder="Inserisci il tuo nome" required ></label><span></span>
                </div>
                <div>
                    <label>Cognome <input type="text" name="cognome" placeholder="Inserisci il tuo cognome" required></label><span></span>
                </div>
                <div>
                    <label>E-mail <input type="text" name="email" placeholder="Inserisci la tua email" required></label><span id="mail"></span>
                </div>
                <div>
                    <label>Nome utente <input type="text" name="utente" placeholder="Inserisci l'username" required></label><span id="user"></span>
                </div>
                <div>
                    <label>Password <input type="password" name="pasw" placeholder="Inserisci una password" required></label><span></span>
                </div>
                <div>
                    <label>Conferma Password <input type="password" name="confirm" placeholder="Conferma password" required></label><span id='pass'></span> 
                </div>
                <div>
                    <br>
                    <button onclick="window.location.href='login.php'">Accedi</button>
                    <button type = "submit"> Registrati! </button>
                </div>                
            </form>
        </section>  
    </body>
</html>
