<?php
function SistemMessage(){
    if(isset($_SESSION['message'])) {
        $message_type = $_SESSION['message_type'];
        $message = $_SESSION['message'];
        echo '<div class="container"><div class="alert alert-' . $message_type . ' alert-dismissible fade show" role="alert">';
        echo $message;
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    if(isset($_SESSION['message2'])) {
            echo "<br />";
            $message_type = $_SESSION['message_type2'];
            $message = $_SESSION['message2'];
            echo '<div class="container"><div class="alert alert-' . $message_type . ' alert-dismissible fade show" role="alert">';
            echo $message;
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
            unset($_SESSION['message2']);
            unset($_SESSION['message_type2']);
        }
            if(isset($_SESSION['message3'])){
                echo "<br />";
                $message_type = $_SESSION['message_type3'];
                $message = $_SESSION['message3'];
                echo '<div class="container"><div class="alert alert-' . $message_type . ' alert-dismissible fade show" role="alert">';
                echo $message;
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
                unset($_SESSION['message3']);
                unset($_SESSION['message_type3']);
            }
    if(isset($_SESSION['message4'])){
        echo "<br />";
        $message_type = $_SESSION['message_type4'];
        $message = $_SESSION['message4'];
        echo '<div class="container"><div class="alert alert-' . $message_type . ' alert-dismissible fade show" role="alert">';
        echo $message;
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
        unset($_SESSION['message4']);
        unset($_SESSION['message_type4']);
    }
}
function messageBox(){
    if(isset($_SESSION['message_sx'])) {
        echo '<div class="alert alert-' .$_SESSION['message_sx_type']. '" role="alert">
        '. $_SESSION['message_sx'].'
        </div>';
        unset($_SESSION['message_sx']);
        unset($_SESSION['message_sx_type']);
    }
}
function messageBoxPrint($message, $type){
        echo '<div class="container"><div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
        echo $message;
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
}