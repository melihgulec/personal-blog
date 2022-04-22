<?php 

include('../scripts/connection.php');

$roleId = $_GET['roleId'];

$getRoleData = $connection->query("SELECT * FROM role WHERE id = '".$roleId."'");
$role = $getRoleData->fetch_assoc();

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
    <link rel="stylesheet" href="../styles/categoryEdit.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function editRole() {
            var roleName = document.getElementById("roleName").value;

            $.post("../scripts/panelRoleActions.php", {roleId: <?php echo $role['id'] ?>, roleName: roleName, actionId: 1},
                function(data) {
                    $('#results').html(data);
            });
        }
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <h3>Rol Düzenle</h3>
        <label for="roleId" class="inputLabel">Rol ID</label>
        <input type="text" name="roleId" id="roleId" value="<?php echo $role['id']; ?>" readonly>
        <label for="roleName" class="inputLabel">Rol Adı</label>
        <input type="text" name="roleName" id="roleName" value="<?php echo $role['Name']; ?>">
        <button class="editButton" onclick="editRole()">Düzenle</button>
    </div>
    <div id="results"></div>
</body>
</html>
