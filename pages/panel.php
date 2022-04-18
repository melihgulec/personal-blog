<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/panel.css">
    <link rel="stylesheet" href="../styles/panelHome.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <a href="">
            <div class="card">
                <div class="iconContainer">
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="labelGroup">
                    <label for="" class="cardName">Yazı Ekle</label>
                    <label for="" class="cardDescription">Siteye yazı girişi yapın.</label>
                </div>
            </div>
        </a>
        <a href ="../pages/postList.php">
            <div class="card">
                <div class="iconContainer">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="labelGroup">
                    <label for="" class="cardName">Yazı Listesi</label>
                    <label for="" class="cardDescription">Sitedeki yazıların listesini görün.</label>
                </div>
            </div>
        </a>
        <a href ="../pages/userList.php">
            <div class="card">
                <div class="iconContainer">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="labelGroup">
                    <label for="" class="cardName">Kullanıcı listesi</label>
                    <label for="" class="cardDescription">Kullanıcıların listesini görün.</label>
                </div>
            </div>
        </a>
        <a href="../pages/categoriesList.php">
            <div class="card">
                <div class="iconContainer">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div class="labelGroup">
                    <label for="" class="cardName">Kategoriler</label>
                    <label for="" class="cardDescription">Kategorileri düzenleyin.</label>
                </div>
            </div>
        </a>
        <a href="">
            <div class="card">
                <div class="iconContainer">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <div class="labelGroup">
                    <label for="" class="cardName">Ayarlar</label>
                    <label for="" class="cardDescription">Sitedeki temel ayarlamaları yapın.</label>
                </div>
            </div>
        </a>
    </div>
</body>
</html>