<?php
include("../scripts/routing.php");
session_start();

if(isset($_SESSION['loggedIn']) && isset($_SESSION['isAdmin'])){
    if($_SESSION['loggedIn'] === true && $_SESSION['isAdmin'] === true){
        go("../pages/panel.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/panelLogin.css">
    <script>
        function SubmitFormData() {
            var email = $("#email").val();
            var password = $("#password").val();
            $.post("../scripts/panelLoginCheck.php", { email: email, password: password},
                function(data) {
                    let result = JSON.parse(data);
                    
                    if(result.status === true){
                        $('#results').html(result.data);
                        const timeOut = setTimeout(() => {
                            location.href = "../pages/panel.php";
                        }, 3000);
                    }else{
                        $('#results').html(result.data);
                    }
            });
        }
    </script>
</head>
<body>
<div id="results"></div>
    <div class="container">
        <p>Blog Yönetimi Giriş Paneli</p>
        <form action="../scripts/panelLoginCheck.php" method="post">
            <div>
                <label>E-Mail</label>
                <input type="text" id="email" name="email">
            </div>
            <div>
                <label>Parola</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <input type="button" value="GİRİŞ" onclick="SubmitFormData();">
            </div>
        </form>
    </div>
</body>
</html>