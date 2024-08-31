<?php
session_start();


function authentication()
{
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {

        $message = 'Please login to access this page!';

        $_SESSION['unauthorized'] = $message;
        header('Location:login.php');
    }
}

authentication();
