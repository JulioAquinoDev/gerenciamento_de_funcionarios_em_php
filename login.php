<?php
    if(isset($_POST['usuario']) AND isset($_POST['senha'])){
        $conn = new PDO("mysql:host=localhost;".
            "dbname=gerenc_empresa","root","");
        $stmt=$conn->prepare("select * from usuarios where ".
            "login=:u and senha=:s");
        $stmt->bindValue(":u",$_POST['usuario']);
        $stmt->bindValue(":s",$_POST['senha']);
        $stmt->execute();

        if($stmt->rowCount()==1){
            session_start();
            $_SESSION['user']=$_POST['usuario'];
            header("Location:home.php");
        }else{
            echo "<p>Usuário ou senha inválido!</p>";
            echo "<p><a href='index.php'>".
                "Tente novamente.</a></p>";
        }
    }else{
        echo "<p>Usuário ou senha inválido!</p>";
        echo "<p><a href='index.php'>".
            "Tente novamente.</a></p>";
    }