<?php
session_start();

$pageIndexes = array(
    'indexPage'      => 0,
    'categoriesPage' => 1,
    'contactPage'    => 2,
    'loginPage'      => 3,
    'registerPage'   => 4,
);

function includeHeader($pageIndex){

    $setArr = array(
        0 => '',
        1 => '',
        2 => '',
        3 => '',
    );

    $setArr[$pageIndex] = 'id = "active-page"';

    $loggedExpression = '<a href="/personalblog/pages/login.php" '.$setArr[3].'><li>Giriş</li></a>';
    $exitBtn = "";


    if(isset($_SESSION['loggedIn'])){
        $loggedExpression = $_SESSION['loggedIn'] === true ? '' : '';
        $exitBtn = '<a href="/personalblog/scripts/exit.php"><li>Çıkış Yap: '.$_SESSION['userName'].'</li></a>';
    }

    echo '
    <div class="header">
            <ul>
                <a href="/personalblog/pages/index.php" '.$setArr[0].'><li>Ana Sayfa</li></a>
                <a href="/personalblog/pages/categories.php" '.$setArr[1].'><li>Kategoriler</li></a>
                <a href="/personalblog/pages/contact.php" '.$setArr[2].'><li>İletişim</li></a>
                '.$loggedExpression.'
                '.$exitBtn.'
            </ul>
        </div>
    ';
}
?>