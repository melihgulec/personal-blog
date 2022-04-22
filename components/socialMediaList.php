<?php
include('../scripts/connection.php');

$socialMediaQuery = $connection->query("SELECT * FROM socialmedia");
$socialMediaData = $socialMediaQuery->fetch_all();

echo '

    <div class="menu-item-head">
        <h3>Sosyal Medya</h3>
    </div>
    <div class="menu-item-content">
        <div class="social-media-container">
            <div class="social-media-btn-container" onclick="window.open(\''.$socialMediaData[0][2].'\')"><i class="fa-brands fa-facebook-square" style="color:blue"></i></div>
            <div class="social-media-btn-container" onclick="window.open(\''.$socialMediaData[1][2].'\')"><i class="fa-brands fa-youtube" style="color:red"></i></div>
            <div class="social-media-btn-container" onclick="window.open(\''.$socialMediaData[2][2].'\')"><i class="fa-brands fa-pinterest" style="color:red"></i></div>
            <div class="social-media-btn-container" onclick="window.open(\''.$socialMediaData[3][2].'\')"><i class="fa-brands fa-twitter" style="color:cornflowerblue;"></i></div>
        </div>
    </div>

';
?>