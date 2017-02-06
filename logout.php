<?php

//    session_start();
//    unset($_SESSION['user']);
//    header("Location: index.php");
    ob_start();
    session_start();
    session_destroy();
    ob_end_flush();
    header("Location: index.php");
