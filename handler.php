<?php
    if ( !empty( $_POST['date'] ) ) {
        setcookie('date', $_POST['date']);
    }
    if ( !empty( $_POST['event'] ) ) {
        setcookie('event', $_POST['event']);
    }
    header('location: /');
?>