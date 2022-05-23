<?php
include("../components/header.php");
include('../scripts/connection.php');
include('../scripts/routing.php');

if(isset($_SESSION['loggedIn'])){
    if($_SESSION['loggedIn'] === true){
        go("../pages/index.php");
    }
    exit();
}

$success = isset($_GET["success"]) == false ? -1 : $_GET['success'];

$cookieResult = "";

if(isset($_COOKIE["userEmail"]) && isset($_COOKIE["rememberMe"])){
    if($_COOKIE["rememberMe"] == 1){
        $cookieResult = $_COOKIE["userEmail"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/global.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/login.css">
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
    <?php includeHeader($pageIndexes['loginPage']); ?>
    <div class="content">
        <div class="mainContainer">
            <form action="../scripts/loginCheck.php" method="post">
                <div class="loginContainer">
                    <label class="headLabel">GİRİŞ</label>
                    <div class="inputGroup">
                        <label class="inputLabel">E-Mail Address</label>
                        <input type="text" name="email" id="email" value="<?php echo $cookieResult ?>">
                    </div>
                    <div class="inputGroup">
                        <label class="inputLabel">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="bottomGroup">
                        <div class="rememberMeGroup">
                            <input type="checkbox" name="rememberMe" id="rememberMe">
                            <label class="inputLabel">Beni Hatırla</label>
                        </div>
                        <label for="" class="inputLabel boldFont">Şifremi Unuttum</label>
                    </div>
                    <div class="buttonContainer">
                        <input type="submit" class="loginButton" value="LOGIN" />
                    </div>
                    <div class="loginFooter">
                        <a href="register.php">
                            <label for="" class="inputLabel">Hesabın yok mu? <b>Kayıt ol.</b></label>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="results"></div>
    <?php include("../components/footer.php") ?>
</body>
</html>