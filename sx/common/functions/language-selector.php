<?php
function languageSelector($pageName){
    include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/language/" . $pageName);
    if(isset($_SESSION['language'])){
        $userLanguage = $_SESSION['language'];
    } else {
        $userLanguage = 'BR_PORTUGUESE';
    }
    switch ($userLanguage) {
        case "BR_PORTUGUESE":
            $textPackage = $BR_PORTUGUESE;
            break;
        case "US_ENGLISH":
            $textPackage = $US_ENGLISH;
            break;
        case "ES_SPANISH":
            $textPackage = $ES_SPANISH;
            break;
        default:
            $textPackage = $BR_PORTUGUESE;
            break;
    }
    return $textPackage;
}