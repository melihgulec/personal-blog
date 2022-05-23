<?php

include("../scripts/connection.php");

$socialMediaData = $connection->query("SELECT * FROM socialmedia");

$data = $socialMediaData->fetch_all();

echo '

<div class="footer">
        <p>2022 Tüm hakları saklıdır. Melih GÜLEÇ ve Tolga Furkan KILINÇ tarafından oluşturulmuştur.</p>
        <div class="social-media-container">
            <div class="social-media-btn-container" onclick="window.open(\''.$data[0][2].'\')"><i class="fa-brands fa-facebook"></i></div>
            <div class="social-media-btn-container" onclick="window.open(\''.$data[1][2].'\')"><i class="fa-brands fa-youtube"></i></div>
            <div class="social-media-btn-container" onclick="window.open(\''.$data[2][2].'\')"><i class="fa-brands fa-pinterest"></i></div>
            <div class="social-media-btn-container" onclick="window.open(\''.$data[3][2].'\')"><i class="fa-brands fa-twitter"></i></div>
        </div>
    </div>
';
?>