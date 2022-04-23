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
    <div id="sideBarContainer">
      <div class="barMenu" id="barMenu">
          <i class="fa-solid fa-bars"></i>
      </div>    
      <aside id="sideBar">
      <h2>Panel</h2>
        <div class="headItem">
          <label class="headLabel">İncele</label>
          <div class="itemGroup">
            <i class="fa-solid fa-house"></i>
            <a class="current" href="../pages/panel.php">Ana Sayfa</a>
          </div>
          <div class="itemGroup">
            <i class="fa-solid fa-message"></i>
            <a class="current" href="../pages/contactForms.php">Mesajlar</a>
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
          <div class="itemGroup">
            <i class="fa-solid fa-id-card"></i>
            <a href="../pages/rolesList.php">Roller</a>
          </div>
        </div>
        <div class="headItem">
          <label class="headLabel">Ekle</label>
          <div class="itemGroup">
            <i class="fa-solid fa-plus"></i>
            <a href="../pages/userAdd.php">Kullanıcı Ekle</a>
          </div>
          <div class="itemGroup">
            <i class="fa-solid fa-plus"></i>
            <a href="../pages/postAdd.php">Yazı Ekle</a>
          </div>
          <div class="itemGroup">
            <i class="fa-solid fa-plus"></i>
            <a href="../pages/categoryAdd.php">Kategori Ekle</a>
          </div>
          <div class="itemGroup">
            <i class="fa-solid fa-plus"></i>
            <a href="../pages/roleAdd.php">Rol Ekle</a>
          </div>
          <div class="itemGroup">
            <i class="fa-solid fa-gear"></i>
            <a href="../pages/panelSettings.php">Ayarlar</a>
          </div>
        </div>
        <button class="logoutButton" onclick="location.href = \'../scripts/exit.php?fromPanel=1\'">Çıkış</button>
      </aside>
    </div>
';


?>