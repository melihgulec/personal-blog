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
    <title>Kullanıcılar</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/userList.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteUser(userId) {
            Swal.fire({
                title: 'Emin misin?',
                text: "Bu durum geri alınamaz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("../scripts/panelUserActions.php", {userId: userId, actionId: 2},
                    function(data) {
                        $('#results').html(data);
                    });
                }
            })
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#table_id').DataTable(
                {
                    "order": [0, "desc"],
                },
            );
        } );
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <div class="contentHead">
            <h3>Kullanıcı Listesi.</h3>
            <button onclick="location.href = 'userAdd.php'">Kullanıcı Ekle</button>
        </div>
        <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fotoğraf</th>
                        <th>İsim</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    while($user = $users_query->fetch_assoc()){
                        $fullName = $user['Name']." ".$user['Surname'];
        
                        $roleQuery = $connection->query("SELECT * FROM role WHERE id ='".$user['RoleID']."'");
                        $roleData = $roleQuery->fetch_assoc();
        
                        echo '
                            <tr>
                                <td>
                                    '.$user['id'].'
                                </td>
                                <td>
                                    <img class="userPP" src="../assets/user/images/'.$user['image'].'" alt="" srcset="">
                                </td>
                                <td>
                                    '.$user['Name'].' '.$user['Surname'].'
                                </td>
                                <td>
                                    '.$user['Email'].'
                                </td>
                                <td>
                                    '.$roleData['Name'].'
                                </td>
                                <td>
                                    <div class="iconGroup">
                                        <i class="fa-solid fa-pen-to-square" onclick="location.href = \'userEdit.php?userId='.$user['id'].'\'"></i>
                                        <i class="fa-solid fa-trash" onclick="deleteUser('.$user['id'].')"></i>
                                    </div>
                                </td>
                            </tr>
                        ';
                    }
                ?>
                </tbody>
            </table>
    </div>
    <div id="results"></div>
</body>
</html>
