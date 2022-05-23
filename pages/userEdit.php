<?php 
session_start();
include("../scripts/panelAdminCheck.php");

include('../scripts/connection.php');

$userId = $_GET['userId'];

$getUserData = $connection->query("SELECT * FROM user WHERE id = '".$userId."'");
$user = $getUserData->fetch_assoc();

$success = isset($_GET["success"]) == false ? -1 : $_GET['success'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Düzenle</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/userEdit.css">
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
                                text: "Kayıt düzenlendi",
                                icon: "success"
                            });
                        ';
                    }else{
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarısız.",
                                text: "Kayıt düzenlenemedi.",
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
        <h3>Kullanıcı Düzenle</h3>
        <form action="../scripts/panelUserActions.php" method="POST" enctype="multipart/form-data">
            <label for="userId" class="inputLabel">Kullanıcı ID</label>
            <br>
            <input type="text" name="userId" id="userId" value="<?php echo $user['id']; ?>" readonly>
            <br>
            <br>
            <label for="userName" class="inputLabel">Kullanıcı Adı</label>
            <br>
            <input type="text" name="userName" id="userName" value="<?php echo $user['Name']; ?>">
            <br>
            <br>
            <label for="userSurname" class="inputLabel">Kullanıcı Soyadı</label>
            <br>
            <input type="text" name="userSurname" id="userSurname" value="<?php echo $user['Surname']; ?>">
            <br>
            <br>
            <label for="dateOfBirth" class="inputLabel">Kullanıcı Doğum Tarihi</label>
            <br>
            <input type="date" name="dateOfBirth" id="dateOfBirth" value="<?php echo $user['DateOfBirth']; ?>">
            <br>
            <br>
            <label for="email" class="inputLabel">Kullanıcı E-Mail</label>
            <br>
            <input type="text" name="email" id="email" value="<?php echo $user['Email']; ?>">
            <br>
            <br>
            <label for="userpass" class="inputLabel">Kullanıcı Parolası</label>
            <br>
            <input type="password" name="password" id="password" value="<?php echo $user['Password']; ?>">
            <br>
            <br>
            <label for="roleId" class="inputLabel">Rolü</label>
            <select name="roleId" id="roleId">
                <?php 
                    $rolesFetchQuery = $connection->query("SELECT * FROM role");

                    while($row = $rolesFetchQuery->fetch_assoc()){

                        $selectExpression = $row['id'] === $user['RoleID'] ? 'selected' : '';

                        echo '
                            <option value="'.$row['id'].'" '.$selectExpression.'>
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
            <button type="submit" name="actionId" value="1" class="editButton">Gönder</button>
        </form>
    </div>
    <div id="results"></div>
</body>
</html>
