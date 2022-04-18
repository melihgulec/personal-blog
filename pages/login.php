<?php
include("../components/header.php");
include('../scripts/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/login.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php includeHeader($pageIndexes['loginPage']); ?>
    <div class="content">
        <div class="mainContainer">
            <div class="loginContainer">
                <label class="headLabel">GİRİŞ</label>
                <div class="inputGroup">
                    <label class="inputLabel">E-Mail Address</label>
                    <input type="text" name="username" id="username">
                </div>
                <div class="inputGroup">
                    <label class="inputLabel">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="bottomGroup">
                    <div class="rememberMeGroup">
                        <input type="checkbox" name="rememberme" id="rememberme">
                        <label class="inputLabel">Beni Hatırla</label>
                    </div>
                    <label for="" class="inputLabel boldFont">Şifremi Unuttum</label>
                </div>
                <div class="buttonContainer">
                    <button class="loginButton">LOGIN</button>
                </div>
                <div class="loginFooter">
                    <label for="" class="inputLabel">Hesabın yok mu? <b>Kayıt ol.</b></label>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>2022 Tüm hakları saklıdır. Melih GÜLEÇ tarafından oluşturulmuştur.</p>
        <div class="social-media-container">
            <div class="social-media-btn-container"><i class="fa-brands fa-facebook"></i></div>
            <div class="social-media-btn-container"><i class="fa-brands fa-youtube"></i></div>
            <div class="social-media-btn-container"><i class="fa-brands fa-pinterest"></i></div>
            <div class="social-media-btn-container"><i class="fa-brands fa-twitter"></i></div>
        </div>
    </div>
</body>
</html>