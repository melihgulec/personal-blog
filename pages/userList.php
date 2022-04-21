<?php 

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
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/panel.css">
    <link rel="stylesheet" href="../styles/userList.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                echo '
                <div class="userContainer">
                    <div class="baseContainer">
                        <img src="../assets/user/images/'.$user['image'].'" alt="" srcset="">
                        <div class="userInfo">
                        <label for="" class="title">'.$fullName.'</label>
                        <label for="" class="description">'.$user['Email'].'</label>
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
