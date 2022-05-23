<?php

$username = "root";
$password = "";

$sunucu = "localhost";

$database = "personalblog";

$connection = mysqli_connect($sunucu, $username, $password);
$connection->query("SET NAMES UTF8");

if(!$connection){
    echo "Bağlantı hatası.";
    exit();
}

$db = $connection->select_db($database);

if(!$db){
    echo "Veri tabanı hatası.".mysqli_error($connection);
    echo "<br>";
}

?>