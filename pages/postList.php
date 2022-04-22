<?php 

include('../scripts/connection.php');
$post_query = $connection->query("SELECT * FROM post");

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
    <link rel="stylesheet" href="../styles/postList.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function deletePost(postId) {
            $.post("../scripts/panelPostActions.php", {postId: postId, actionId: 2},
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
            <h3>Yazı Listesi.</h3>
            <button onclick="location.href = 'postAdd.php'">Yazı Ekle</button>
        </div>
        <table>
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
            <?php 
                while($post = $post_query->fetch_assoc()){

                    $description = $post['Description'];
                    $description = (strlen($description) > 180) ? substr($description,0,180).'...' : $description;

                    echo '
                        <tr>
                            <td>
                                '.$post['id'].'
                            </td>
                            <td>
                                '.$post['Title'].'
                            </td>
                            <td width="700px">
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
        </table>
    </div>
    <div id="results"></div>
</body>
</html>
