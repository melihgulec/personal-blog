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
    <h2>Panel</h2>
      <div class="headItem">
        <label class="headLabel">İncele</label>
        <div class="itemGroup">
          <i class="fa-solid fa-house"></i>
          <a class="current" href="../pages/panel.php">Ana Sayfa</a>
        </div>
        <div class="itemGroup">
          <i class="fa-solid fa-pen"></i>
          <a href="../pages/postList.php">Yazı Listesi</a>
        </div>
        <div class="itemGroup">
          <i class="fa-solid fa-user"></i>
          <a href="../pages/userList.php">Kullanıcı Listesi</a>
        </div>
        <div class="itemGroup">
          <i class="fa-solid fa-book"></i>
          <a href="../pages/categoriesList.php">Kategoriler</a>
        </div>
      </div>
      <div class="headItem">
        <label class="headLabel">Ekle</label>
        <div class="itemGroup">
          <i class="fa-solid fa-plus"></i>
          <a href="../pages/postAdd.php">Yazı Ekle</a>
        </div>
        <div class="itemGroup">
          <i class="fa-solid fa-plus"></i>
          <a href="../pages/categoryAdd.php">Kategori ekle</a>
        </div>
        <div class="itemGroup">
          <i class="fa-solid fa-plus"></i>
          <a href="../pages/roleAdd.php">Roller</a>
        </div>
        <div class="itemGroup">
          <i class="fa-solid fa-gear"></i>
          <a href="../pages/settings.php">Ayarlar</a>
        </div>
      </div>
    </aside>
';


?>