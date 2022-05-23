<?php 
session_start();
include("../scripts/panelAdminCheck.php");

include('../scripts/connection.php');
$contact_query = $connection->query("SELECT * FROM contact");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesajlar</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/contactForms.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteContact(contactId) {
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
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.post("../scripts/panelContactFormActions.php", {contactId: contactId, actionId: 2},
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
            <h3>Mesaj Listesi.</h3>
        </div>
        <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Adı</th>
                        <th>Başlık</th>
                        <th>İleti</th>
                        <th>E-Mail</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    while($row = $contact_query->fetch_assoc()){

                        $description = $row['Description'];
                        $description = (strlen($description) > 180) ? substr($description,0,180).'...' : $description;

                        echo '
                            <tr>
                                <td>
                                    '.$row['id'].'
                                </td>
                                <td>
                                    '.$row['Name'].'
                                </td>
                                <td>
                                    '.$row['Subject'].'
                                </td>
                                <td width="700px">
                                    '.$description.'
                                </td>
                                <td>
                                    '.$row['Email'].'
                                </td>
                                <td>
                                    <div class="iconGroup">
                                        <i class="fa-solid fa-search" onclick="location.href = \'seeContactForm.php?contactId='.$row['id'].'\'"></i>
                                        <i class="fa-solid fa-trash" onclick="deleteContact('.$row['id'].')"></i>
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
