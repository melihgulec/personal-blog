<?php

function makeSuccessAlert($text){
    makeAlert("Başarılı!", $text, "success");
}

function makeErrorAlert($text){
    makeAlert("Hata!", $text, "error");
}

function makeAlert($title, $text, $icon){
    echo '
        <script>
            Swal.fire({
                heightAuto: false,
                title: "'.$title.'",
                text: "'.$text.'",
                icon: "'.$icon.'"
            });
        </script>
    ';
}

?>