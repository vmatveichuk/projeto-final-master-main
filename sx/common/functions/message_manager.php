<?php
function managerMessage($message, $message_type){
    if(!isset($_SESSION['message'])) {
        $_SESSION['message'] = $message;
        $_SESSION['message_type'] = $message_type;
    }
    else {
        if($_SESSION['message'] !== $message) {
            if (!isset($_SESSION['message2'])) {
                $_SESSION['message2'] = $message;
                $_SESSION['message_type2'] = $message_type;
            } else {
                if($_SESSION['message2'] !== $message) {
                    if (!isset($_SESSION['message3'])) {
                        $_SESSION['message3'] = $message;
                        $_SESSION['message_type3'] = $message_type;
                    } else {
                        $_SESSION['message4'] = 'error_danger';
                        $_SESSION['message_type4'] = 'danger';
                    }
                }
            }
        }
    }
}