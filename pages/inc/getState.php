<?php 
function getState($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
}
?>