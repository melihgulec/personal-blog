<?php 
include("../scripts/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/postEdit.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function addUser() {
            var userName = document.getElementById("userName").value;
            var userSurname = document.getElementById("userSurname").value;
            var dateOfBirth = document.getElementById("dateOfBirth").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var roleid = document.getElementById("roleId").value;
            var photoPath = document.getElementById("photoPath").value;

            $.post("../scripts/panelUserActions.php", {
                userName: userName, 
                userSurname: userSurname, 
                dateOfBirth: dateOfBirth, 
                email: email, 
                password: password,
                roleid: roleid, 
                photoPath: photoPath, 
                actionId: 0,}
                ,
                function(data) {
                    $('#results').html(data);
            });
        }
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <h3>Kullanıcı Ekle</h3>
        <label for="userName" class="inputLabel">Kullanıcı Adı</label>
        <input type="text" name="userName" id="userName">
        <label for="userSurname" class="inputLabel">Kullanıcı Soyadı</label>
        <input type="text" name="userSurname" id="userSurname">
        <label for="dateOfBirth" class="inputLabel">Kullanıcı Doğum Tarihi</label>
        <input type="text" name="dateOfBirth" id="dateOfBirth">
        <label for="email" class="inputLabel">Kullanıcı E-Mail</label>
        <input type="text" name="email" id="email">
        <label for="userpass" class="inputLabel">Kullanıcı Parolası</label>
        <input type="password" name="password" id="password">
        <label for="roleId" class="inputLabel">Rol</label>
        <select name="roleId" id="roleId">
            <?php 
                $rolesFetchQuery = $connection->query("SELECT * FROM role");

                while($row = $rolesFetchQuery->fetch_assoc()){
                    echo '
                        <option value="'.$row['id'].'">
                            '.$row['Name'].'
                        </option>
                    ';
                }
            ?>
        </select>
        <label for="photoPath" class="inputLabel">Kullanıcı Fotoğrafı</label>
        <input type="text" name="photoPath" id="photoPath">
        <button class="editButton" onclick="addUser()">Ekle</button>
    </div>
    <div id="results"></div>
</body>
</html>
