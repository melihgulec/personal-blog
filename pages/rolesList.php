<?php 
include('../scripts/connection.php');
$roles_query = $connection->query("SELECT * FROM role");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/categoriesList.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteCategory(roleId) {
            $.post("../scripts/panelRoleActions.php", {roleId: roleId, actionId: 2},
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
            <h3>Rol Listesi.</h3>
            <button onclick="location.href = 'roleAdd.php'">Rol Ekle</button>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Rol Adı</th>
                <th>İşlem</th>
            </tr>
            <?php 
                while($row = $roles_query->fetch_assoc()){
                    echo '
                        <tr>
                            <td>
                                '.$row['id'].'
                            </td>
                            <td width="90%">
                                '.$row['Name'].'
                            </td>
                            <td>
                                <div class="iconGroup">
                                    <i class="fa-solid fa-pen-to-square" onclick="location.href = \'roleEdit.php?roleId='.$row['id'].'\'"></i>
                                    <i class="fa-solid fa-trash" onclick="deleteCategory('.$row['id'].')"></i>
                                </div>
                            </td>
                        </tr>
                    ';
                }
            ?>
        </table>
    </div>
    <div id="results"></div>
</body>
</html>
