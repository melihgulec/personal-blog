<?php
session_start();
include("../scripts/panelAdminCheck.php");

include("../scripts/connection.php");

$success = isset($_GET["success"]) == false ? -1 : $_GET['success'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Ekle</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/postEdit.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(()=>{
            <?php
                if($success != -1){
                    if($success){
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarılı.",
                                text: "Kayıt oluşturuldu",
                                icon: "success"
                            });
                        ';
                    }else{
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarısız.",
                                text: "Kayıt oluşturulamadı",
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
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <h3>Kullanıcı Ekle</h3>
        <form action="../scripts/panelUserActions.php" method="POST" enctype="multipart/form-data">
            <label for="userName" class="inputLabel">Kullanıcı Adı</label>
            <br>
            <input type="text" name="userName" id="userName">
            <br>
            <br>
            <label for="userSurname" class="inputLabel">Kullanıcı Soyadı</label>
            <br>
            <input type="text" name="userSurname" id="userSurname">
            <br>
            <br>
            <label for="dateOfBirth" class="inputLabel">Kullanıcı Doğum Tarihi</label>
            <br>
            <input type="date" name="dateOfBirth" id="dateOfBirth">
            <br>
            <br>
            <label for="email" class="inputLabel">Kullanıcı E-Mail</label>
            <br>
            <input type="text" name="email" id="email">
            <br>
            <br>
            <label for="userpass" class="inputLabel">Kullanıcı Parolası</label>
            <input type="password" name="password" id="password">
            <br>
            <br>
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
            <br>
            <br>

            <label for="photoPath" class="inputLabel">Kullanıcı Fotoğrafı</label>
            <br>
            <input type="file" name="photo" id="photo">
            <br>

            <button type="submit" name="actionId" value="0" class="editButton">Gönder</button>
        </form>
    </div>
    <div id="results"></div>
</body>
</html>
