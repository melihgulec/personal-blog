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
    <link rel="stylesheet" href="../styles/register.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function SubmitFormData() {
            var userName = $("#userName").val();
            var userSurname = $("#userSurname").val();
            var userMail = $("#userMail").val();
            var userPassword = $("#userPassword").val();
            var dateOfBirth = $("#dateOfBirth").val();
            $.post("../scripts/userRegister.php", { userName: userName, userSurname: userSurname, userMail: userMail, userPassword: userPassword, dateOfBirth: dateOfBirth},
                function(data) {
                    $('#results').html(data);
            });
        }
    </script>
</head>
<body>
    <?php includeHeader($pageIndexes['registerPage']); ?>
    <div class="content">
        <div class="mainContainer">
            <label for="" class="headLabel">KAYIT OL.</label>
            <form action="../scripts/userRegister.php" method="post">
                <label for="userName" class="inputLabel">Adınız</label>
                <input type="text" name="userName" id="userName">
                <label for="userSurname" class="inputLabel">Soyadınız</label>
                <input type="text" name="userSurname" id="userSurname">
                <label for="userMail" class="inputLabel">E-Posta</label>
                <input type="text" name="userMail" id="userMail">
                <label for="userPassword" class="inputLabel">Parola</label>
                <input type="userPassword" name="userPassword" id="userPassword">
                <label for="dateOfBirth" class="inputLabel">Doğum Tarihi</label>
                <input type="text" name="dateOfBirth" id="dateOfBirth">
                <input type="button" value="KAYIT OL" onclick="SubmitFormData()">
            </form>
        </div>
    </div>
    <div id="results"></div>
    <?php include("../components/footer.php") ?>
</body>
</html>