<?php
include("../components/header.php");
include('../scripts/connection.php');
$success = isset($_GET["success"]) == false ? -1 : $_GET['success'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/register.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(()=>{
            <?php
                if($success != -1){
                    if($success == 1){
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarılı.",
                                text: "Kayıt oluşturuldu",
                                icon: "success"
                            });
                        ';
                    }else if($success == 2 )
                    {
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarısız.",
                                text: "Boş alanlar doldurulmalıdır.",
                                icon: "error"
                            });
                        ';
                    }else if($success == 3 ){
                        echo '
                        Swal.fire({
                            heightAuto: false,
                            title: "Başarısız.",
                            text: "Böyle bir maile sahip kullanıcı bulunmaktadır.",
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
    <?php includeHeader($pageIndexes['registerPage']); ?>
    <div class="content">
        <div class="mainContainer">
            <label for="" class="headLabel">KAYIT OL.</label>
            <form action="../scripts/userRegister.php" method="post" enctype="multipart/form-data">
                <label for="userName" class="inputLabel">Adınız</label>
                <input type="text" name="userName" id="userName">
                <label for="userSurname" class="inputLabel">Soyadınız</label>
                <input type="text" name="userSurname" id="userSurname">
                <label for="userMail" class="inputLabel">E-Posta</label>
                <input type="text" name="userMail" id="userMail">
                <label for="userPassword" class="inputLabel">Parola</label>
                <input type="password" name="userPassword" id="userPassword">
                <label for="dateOfBirth" class="inputLabel">Doğum Tarihi</label>
                <input type="date" name="dateOfBirth" id="dateOfBirth">
                <input type="file" name="photo" id="photo">
                <input type="submit" value="KAYIT OL">
            </form>
        </div>
    </div>
    <div id="results"></div>
    <?php include("../components/footer.php") ?>
</body>
</html>