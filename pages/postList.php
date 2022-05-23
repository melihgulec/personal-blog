<?php 
session_start();
include("../scripts/panelAdminCheck.php");

include('../scripts/connection.php');
$post_query = $connection->query("SELECT * FROM post");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazılar</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/postList.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <script>
        function deletePost(postId) {
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
                    $.post("../scripts/panelPostActions.php", {postId: postId, actionId: 2},
                    function(data) {
                        $('#results').html(data);
                    });
                }
            })
        }
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <div class="contentHead">
            <h3>Yazı Listesi.</h3>
            <button onclick="location.href = 'postAdd.php'">Yazı Ekle</button>
        </div>
        <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Başlık</th>
                        <th>İçerik</th>
                        <th>Tarih</th>
                        <th>Fotoğraf</th>
                        <th>Kullanıcı ID</th>
                        <th>Kategori ID</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while($post = $post_query->fetch_assoc()){

                    $description = $post['Description'];
                    $description = (strlen($description) > 75) ? substr($description,0,75).'...' : $description;

                    echo '
                        <tr>
                            <td>
                                '.$post['id'].'
                            </td>
                            <td>
                                '.$post['Title'].'
                            </td>
                            <td>
                                '.$description.'
                            </td>
                            <td>
                                '.$post['Date'].'
                            </td>
                            <td>
                                '.$post['image'].'
                            </td>
                            <td>
                                '.$post['user_id'].'
                            </td>
                            <td>
                                '.$post['categorie_id'].'
                            </td>
                            <td>
                                <div class="iconGroup">
                                    <i class="fa-solid fa-pen-to-square" onclick="location.href = \'postEdit.php?postId='.$post['id'].'\'"></i>
                                    <i class="fa-solid fa-trash" onclick="deletePost('.$post['id'].')"></i>
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
