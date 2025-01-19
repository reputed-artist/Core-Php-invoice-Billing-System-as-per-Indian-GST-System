<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'];
    $state = $_POST['state'] === 'true' ? true : false;
    $_SESSION[$key] = $state;
}
?>