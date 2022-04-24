<?php 
session_start();
include("../scripts/panelAdminCheck.php");

include('../scripts/connection.php');
$socialMediaQuery = $connection->query("SELECT * FROM socialmedia");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../styles/panelSettings.css">
    <script>
        function editSettings(socialMediaName, socialMediaId) {
            var socialMediaLink = document.getElementById(socialMediaName).value;
            $.post("../scripts/panelSettingsActions.php", {
                socialMediaId: socialMediaId, 
                socialMediaLink: socialMediaLink, 
                actionId: 1,}
                ,
                function(data) {
                    $('#results').html(data);
            });
        }

        function editInfo(infoId, description) {
            var description = document.getElementById("aboutme").value;
            $.post("../scripts/panelSettingsActions.php", {
                infoId: infoId, 
                description: description, 
                actionId: 3,}
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
        <div class="contentHead">
            <h3>Ayarlar</h3>
        </div>
        <?php
            $adminInfoQuery = $connection->query("SELECT * FROM admininfo");
            $data = $adminInfoQuery->fetch_assoc();
            echo '
                <label class="inputLabel">Hakkımda Yazısı</label>
                <input type="text" name="aboutme" id="aboutme" value ="'.$data['Description'].'">
                <button class="editButton" onclick="editInfo(\''.$data['id'].'\')">Düzenle</button>
            ';

            while($socialMedia = $socialMediaQuery->fetch_assoc()){
                echo '
                    <label class="inputLabel">'.$socialMedia['Name'].' Link</label>
                    <input type="text" name="'.$socialMedia['Name'].'Link" id="'.$socialMedia['Name'].'Link" value ="'.$socialMedia['Link'].'">
                    <button class="editButton" onclick="editSettings(\''.$socialMedia['Name'].'Link'.'\', '.$socialMedia['id'].')">Düzenle</button>
                ';
            }
        ?>
    </div>
    <div id="results"></div>
</body>
</html>
