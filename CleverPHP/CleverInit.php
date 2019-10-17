<?php
    if(!isset($_COOKIE['Clever.lang'])){
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if ($lang != 'fr') $lang = 'en';
        setcookie('Clever.lang', $lang, time()+10800);
    }
?>