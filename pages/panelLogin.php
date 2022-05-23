<?php
include("../scripts/routing.php");
session_start();

if(isset($_SESSION['loggedIn']) && isset($_SESSION['isAdmin'])){
    if($_SESSION['loggedIn'] === true && $_SESSION['isAdmin'] === true){
        go("../pages/panel.php");
    }
}

$success = isset($_GET["success"]) == false ? -1 : $_GET['success'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel Girişi</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/panelLogin.css">
    <script>
        $(document).ready(()=>{
            <?php
        
                if($success != -1){
                    if($success == 2 )
                    {
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarısız.",
                                text: "Boş alanlar doldurulmalıdır.",
                                icon: "error"
                            });
                        ';
                    }else if($success == 0 ){
                        echo '
                        Swal.fire({
                            heightAuto: false,
                            title: "Başarısız.",
                            text: "Kullanıcı bulunamadı.",
                            icon: "error"
                        });
                    ';
                    }
                }
            ?> 
        });
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
                <input type="submit" value="GİRİŞ">
            </div>
        </form>
    </div>
</body>
</html>