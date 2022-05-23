<?php 
session_start();
include("../scripts/panelAdminCheck.php");

include('../scripts/connection.php');
$categories_query = $connection->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategoriler</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/categoriesList.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteCategory(categoryId) {
            Swal.fire({
                title: 'Emin misin?',
                text: "Bu durum geri alınamaz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("../scripts/panelCategoryActions.php", {categoryId: categoryId, actionId: 2},
                    function(data) {
                        $('#results').html(data);
                    });
                }
            })
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#table_id').DataTable(
                {
                    "order": [0, "desc"],
                },
            );
        } );
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <div class="contentHead">
            <h3>Kategori Listesi.</h3>
            <button onclick="location.href = 'categoryAdd.php'">Kategori Ekle</button>
        </div>
        <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori Adı</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while($category = $categories_query->fetch_assoc()){
                        echo '
                            <tr>
                                <td>
                                    '.$category['id'].'
                                </td>
                                <td width="90%">
                                    '.$category['Name'].'
                                </td>
                                <td>
                                    <div class="iconGroup">
                                        <i class="fa-solid fa-pen-to-square" onclick="location.href = \'categoryEdit.php?categoryId='.$category['id'].'\'"></i>
                                        <i class="fa-solid fa-trash" onclick="deleteCategory('.$category['id'].')"></i>
                                    </div>
                                </td>
                            </tr>
                        ';
                    }
                ?>
                </tbody>
        </table>
    </div>
    <div id="results"></div>
</body>
</html>
