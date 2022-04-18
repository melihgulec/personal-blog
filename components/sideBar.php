<?php

$sideBarPageIndexes = array(
  'home'       => 0,
  'addPost'    => 1,
  'postList'   => 2,
  'userList'   => 3,
  'categories' => 4,
  'settings'   => 5,
);

echo '
    <aside>
      <a class="current" href="../pages/panel.php">Ana Sayfa</a>
      <a href="../pages/panel.php">Yazı Ekle</a>
      <a href="../pages/postList.php">Yazı Listesi</a>
      <a href="../pages/userList.php">Kullanıcı Listesi</a>
      <a href="../pages/categoriesList.php">Kategoriler</a>
      <a href="../pages/panel.php">Ayarlar</a>
    </aside>
';


?>