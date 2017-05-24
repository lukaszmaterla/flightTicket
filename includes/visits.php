<?php
    if(isset($_COOKIE['visits'])){
        setcookie('visits', $_COOKIE['visits']+=1);
        $cookieUpdate = $_COOKIE['visits'];
        echo 'Witaj odwiedziłeś nas już '.$cookieUpdate.' '.'razy !';
        
    }else{
        setcookie('visits',1, time()+(3600*24*365));
        echo 'Witaj pierwszy raz na stronie !';
    }
