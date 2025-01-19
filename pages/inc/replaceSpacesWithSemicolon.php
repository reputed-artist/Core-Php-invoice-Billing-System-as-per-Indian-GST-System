<?php

    function replaceSpacesWithSemicolon($str) {
    // Replace two or more spaces with a semicolon followed by a space
    $result = preg_replace('/\s{2,}/', '; ', $str);

    // Ensure there's exactly one space after a semicolon
    $result = preg_replace('/;\s*/', '; ', $result);

    // Add a semicolon at the end of each line
    $result = preg_replace('/(\n\s*)/', '; $1', $result);

    // Handle cases where a semicolon should not be placed before &
    $result = preg_replace('/;\s*&/', ' &', $result);

    // Remove any accidental trailing semicolons and extra spaces
    $result = trim($result);
    $result = rtrim($result, '; ');

    return $result;
}

?>