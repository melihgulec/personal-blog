<?php 

include('../scripts/connection.php');

$userId = $_GET['userId'];

$getUserData = $connection->query("SELECT * FROM user WHERE id = '".$userId."'");
$user = $getUserData->fetch_assoc();

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
    <link rel="stylesheet" href="../styles/userEdit.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function editUser() {
            var userName = document.getElementById("userName").value;
            var userSurname = document.getElementById("userSurname").value;
            var dateOfBirth = document.getElementById("dateOfBirth").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var roleid = document.getElementById("roleId").value;
            var photoPath = document.getElementById("photoPath").value;

            $.post("../scripts/panelUserActions.php", {
                userId: <?php echo $user['id'] ?>, 
                userName: userName, 
                userSurname: userSurname, 
                dateOfBirth: dateOfBirth, 
                email: email, 
                password: password,
                roleid: roleid, 
                photoPath: photoPath, 
                actionId: 1,}
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
        <h3>Kullanıcı Düzenle</h3>
        <label for="userId" class="inputLabel">Kullanıcı ID</label>
        <input type="text" name="userId" id="userId" value="<?php echo $user['id']; ?>" readonly>
        <label for="userName" class="inputLabel">Kullanıcı Adı</label>
        <input type="text" name="userName" id="userName" value="<?php echo $user['Name']; ?>">
        <label for="userSurname" class="inputLabel">Kullanıcı Soyadı</label>
        <input type="text" name="userSurname" id="userSurname" value="<?php echo $user['Surname']; ?>">
        <label for="dateOfBirth" class="inputLabel">Kullanıcı Doğum Tarihi</label>
        <input type="text" name="dateOfBirth" id="dateOfBirth" value="<?php echo $user['DateOfBirth']; ?>">
        <label for="email" class="inputLabel">Kullanıcı E-Mail</label>
        <input type="text" name="email" id="email" value="<?php echo $user['Email']; ?>">
        <label for="userpass" class="inputLabel">Kullanıcı Parolası</label>
        <input type="password" name="password" id="password" value="<?php echo $user['Password']; ?>">
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
        <label for="photoPath" class="inputLabel">Kullanıcı Fotoğrafı</label>
        <input type="text" name="photoPath" id="photoPath" value="<?php echo $user['image']; ?>">
        <button class="editButton" onclick="editUser()">Düzenle</button>
    </div>
    <div id="results"></div>
</body>
</html>
