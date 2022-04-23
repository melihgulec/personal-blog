<?php 
session_start();
include("../scripts/panelAdminCheck.php");

include('../scripts/connection.php');
$users_query = $connection->query("SELECT * FROM user");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/userList.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteUser(userId) {
            $.post("../scripts/panelUserActions.php", {userId: userId, actionId: 2},
                function(data) {
                    $('#results').html(data);
            });
        }
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <div class="contentHead">
            <h3>Kullanıcı Listesi.</h3>
            <button onclick="location.href = 'userAdd.php'">Kullanıcı Ekle</button>
        </div>
        <?php 
            while($user = $users_query->fetch_assoc()){
                $fullName = $user['Name']." ".$user['Surname'];

                $roleQuery = $connection->query("SELECT * FROM role WHERE id ='".$user['RoleID']."'");
                $roleData = $roleQuery->fetch_assoc();

                echo '
                <div class="userContainer">
                    <div class="baseContainer">
                        <img src="../assets/user/images/'.$user['image'].'" alt="" srcset="">
                        <div class="userInfo">
                        <label for="" class="title">'.$fullName.'</label>
                        <label for="" class="description">'.$roleData['Name'].', '.$user['Email'].'</label>
                        </div>
                    </div>
                    <div class="iconGroup">
                        <i class="fa-solid fa-pen-to-square" onclick="location.href = \'userEdit.php?userId='.$user['id'].'\'"></i>
                        <i class="fa-solid fa-trash" onclick="deleteUser('.$user['id'].')"></i>
                    </div>
                </div>
                ';
            }
        ?>
        
    </div>
    <div id="results"></div>
</body>
</html>
