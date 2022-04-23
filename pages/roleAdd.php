<?php
session_start();
include("../scripts/panelAdminCheck.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/categoryEdit.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function addRole() {
            var roleName = document.getElementById("roleName").value;

            $.post("../scripts/panelRoleActions.php", {roleName: roleName, actionId: 0},
                function(data) {
                    $('#results').html(data);
            });
        }
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <h3>Rol Ekle</h3>
        <label for="roleName" class="inputLabel">Rol Adı</label>
        <input type="text" name="roleName" id="roleName">
        <button class="editButton" onclick="addRole()">Ekle</button>
    </div>
    <div id="results"></div>
</body>
</html>
