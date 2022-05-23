<?php
session_start();
include('../scripts/connection.php');

include("../scripts/panelAdminCheck.php");
$post_query = $connection->query("SELECT *, COUNT(user_likes.id) as count FROM user_likes INNER JOIN post ON post.id = user_likes.post_id WHERE type = 1 GROUP BY post_id ORDER BY count DESC LIMIT 5");
$post_viewQuery = $connection->query("SELECT * FROM post ORDER BY views DESC LIMIT 5");
$likeQuery = $connection->query("SELECT COUNT(*) as count FROM user_likes WHERE type = 1");
$dislikeQuery = $connection->query("SELECT COUNT(*) as count FROM user_likes WHERE type = 0");
$likeCount = $likeQuery->fetch_assoc();
$dislikeCount = $dislikeQuery->fetch_assoc();
$viewCountQuery = $connection->query("SELECT SUM(views) as count FROM post ");
$viewCount = $viewCountQuery->fetch_assoc();
$userQuery =$connection->query("SELECT COUNT(*) as count FROM user");
$userCount = $userQuery->fetch_assoc();
$messageQuery = $connection->query("SELECT * FROM contact");
$commentCountQuery = $connection->query("select COUNT(*) as count, post.id as postid, post.Title, post.Date from comment INNER JOIN post ON post.id = comment.post_id group by post_id ORDER BY count DESC;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/panelHome.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    

    <div class="content">
    <div class="banner">
        <h2>Dashboard</h2>
    </div>
        <div class="statisticsContainer">
                <div class="cardContainer">
                    <div class="cardIconItem">
                    <i class="fa-solid fa-eye"></i>
                        <div class="cardIconItemTitle">
                            <p>Görüntülenmeler</p>
                            <p><?php echo $viewCount["count"] == null ? 0 : $viewCount["count"]; ?></p>
                        </div>
                    </div>
                </div>
                <div class="cardContainer">
                    <div class="cardIconItem">
                    <i class="fa-solid fa-thumbs-up"></i>
                        <div class="cardIconItemTitle">
                            <p>Beğeni Sayısı</p>
                            <p><?php echo $likeCount["count"] ?></p>
                        </div>
                    </div>
                </div>
                <div class="cardContainer">
                    <div class="cardIconItem">
                    <i class="fa-solid fa-thumbs-down"></i>
                        <div class="cardIconItemTitle">
                            <p>Beğenmeme Sayısı</p>
                            <p><?php echo $dislikeCount["count"] ?></p>
                        </div>
                    </div>
                </div>
                <div class="cardContainer">
                    <div class="cardIconItem">
                    <i class="fa-solid fa-user"></i>
                        <div class="cardIconItemTitle">
                            <p>Kullanıcılar</p>
                            <p><?php echo $userCount["count"] == null ? 0 : $userCount["count"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="width:100%;height:1px;border-width:0;color:gray;background-color:#eee">
                <div class="tables">
                    <div class="item">
                            <h2>En Çok Beğenilen 5 Paylaşım</h2>
                            <table>
                            <tr>
                                <th>ID</th>
                                <th>Başlık</th>
                                <th>Tarih</th>
                                <th>Beğeni</th>
                                <th>Görüntüle</th>
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
                                            <td>
                                                '.$post['Date'].'
                                            </td>
                                            <td>
                                                '.$post['count'].'
                                            </td>
                                            <td>
                                                <i style="cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:22px; color:crimson" class="fa-solid fa-eye" onclick="location.href = \'postEdit.php?postId='.$post['id'].'\'"></i>
                                            </td>
                                        </tr>
                                    ';
                                }
                            ?>
                        </table>
                    </div>

                    <div class="item">
                            <h2>En Çok Görüntülenen 5 Paylaşım</h2>
                            <table>
                            <tr>
                                <th>ID</th>
                                <th>Başlık</th>
                                <th>Tarih</th>
                                <th>Görüntüleme</th>
                                <th>Görüntüle</th>
                            </tr>
                            <?php 
                                while($post = $post_viewQuery->fetch_assoc()){

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
                                            <td>
                                                '.$post['Date'].'
                                            </td>
                                            <td>
                                                '.$post['views'].'
                                            </td>
                                            <td>
                                                <i style="cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:22px; color:crimson" class="fa-solid fa-eye" onclick="location.href = \'postEdit.php?postId='.$post['id'].'\'"></i>
                                            </td>
                                        </tr>
                                    ';
                                }
                            ?>
                        </table>
                    </div>

                    <div class="item">
                        <h2>Mesajlar</h2>
                            <table>
                            <tr>
                                <th>Email</th>
                                <th>Konu</th>
                                <th>Görüntüle</th>
                            </tr>
                            <?php 
                                while($row = $messageQuery->fetch_assoc()){


                                    $description = $row['Description'];
                                    $description = (strlen($description) > 60) ? substr($description,0,60).'...' : $description;

                                    echo '
                                        <tr>
                                            <td>
                                                '.$row['Email'].'
                                            </td>
                                            <td>
                                                '.$row['Subject'].'
                                            </td>
                                            <td>
                                                <i style="cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:22px; color:crimson" class="fa-solid fa-eye" onclick="location.href = \'seeContactForm.php?contactId='.$row['id'].'\'"></i>
                                            </td>
                                        </tr>
                                    ';
                                }
                            ?>
                        </table>
                    </div>

                    <div class="item">
                        <h2>En çok yorum alan paylaşımlar</h2>
                            <table>
                            <tr>
                                <th>ID</th>
                                <th>Başlık</th>
                                <th>Tarih</th>
                                <th>Yorum</th>
                            </tr>
                            <?php 
                                while($row = $commentCountQuery->fetch_assoc()){
                                    echo '
                                        <tr>
                                            <td>
                                                '.$row['postid'].'
                                            </td>
                                            <td>
                                                '.$row['Title'].'
                                            </td>
                                            <td>
                                            '.$row['Date'].'
                                            </td>
                                            <td>
                                            '.$row['count'].'
                                            </td>
                                            <td>
                                                <i style="cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:22px; color:crimson" class="fa-solid fa-eye" onclick="location.href = \'postEdit.php?postId='.$row['postid'].'\'"></i>
                                            </td>
                                        </tr>
                                    ';
                                }
                            ?>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</body>
</html>