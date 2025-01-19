<?php
    
    function separator($str) {
    // Explode the string by semicolon followed by space
       // Explode the string by semicolon followed by space
    $sentences = explode('; ', $str);

    // Remove any empty strings that may result from explosion
    $sentences = array_filter($sentences, fn($sentence) => !empty($sentence));

    return $sentences;
}

?>