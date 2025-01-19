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

// Example usage
$input = "Max.Print Height : 12.7 mm;Max. Speed : 30-40 per/min.
LCD Display with print head
Comes along pen drive , HP original Seal Pack Black ink Cartridge , charger,SS Frame & Battery
1 year warranty
Along with PC Software Support
NO Courier Charges";

$output = replaceSpacesWithSemicolon($input);
echo $output;
?>