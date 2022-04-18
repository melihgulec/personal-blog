<?php

$pageIndexes = array(
    'indexPage'      => 0,
    'categoriesPage' => 1,
    'contactPage'    => 2,
    'loginPage'      => 3,
);

function includeHeader($pageIndex){
    switch ($pageIndex) {
        case 0:
            echo '
            <div class="header">
                    <ul>
                        <a href="/personalblog/pages/index.php" id="active-page"><li>Ana Sayfa</li></a>
                        <a href="/personalblog/pages/categories.php"><li>Kategoriler</li></a>
                        <a href="/personalblog/pages/contact.php"><li>İletişim</li></a>
                        <a href="/personalblog/pages/login.php"><li>Kullanıcı</li></a>
                    </ul>
                </div>
            ';
            break;

        case 1:
            echo '
            <div class="header">
                    <ul>
                        <a href="/personalblog/pages/index.php"><li>Ana Sayfa</li></a>
                        <a href="/personalblog/pages/categories.php" id="active-page"><li>Kategoriler</li></a>
                        <a href="/personalblog/pages/contact.php"><li>İletişim</li></a>
                        <a href="/personalblog/pages/login.php"><li>Kullanıcı</li></a>
                    </ul>
                </div>
            ';
            break;

        case 2:
            echo '
            <div class="header">
                    <ul>
                        <a href="/personalblog/pages/index.php"><li>Ana Sayfa</li></a>
                        <a href="/personalblog/pages/categories.php"><li>Kategoriler</li></a>
                        <a href="/personalblog/pages/contact.php" id="active-page"><li>İletişim</li></a>
                        <a href="/personalblog/pages/login.php"><li>Kullanıcı</li></a>
                    </ul>
                </div>
            ';
            break;

        case 3:
            echo '
            <div class="header">
                    <ul>
                        <a href="/personalblog/pages/index.php"><li>Ana Sayfa</li></a>
                        <a href="/personalblog/pages/categories.php"><li>Kategoriler</li></a>
                        <a href="/personalblog/pages/contact.php"><li>İletişim</li></a>
                        <a href="/personalblog/pages/login.php" id="active-page"><li>Kullanıcı</li></a>
                    </ul>
                </div>
            ';
            break;
        
        default:
            # code...
            break;
    }
}
?>