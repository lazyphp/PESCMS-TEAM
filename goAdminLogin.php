<?php

@session_start();
$_SESSION['login'] = 1;
header('Location: index.php/Admin-Login-index');
