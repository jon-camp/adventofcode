<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "functions.php";

$diagnosticReport = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-3-input.txt");

$diagnosticReport = trim($diagnosticReport);

$reportLines = explode(PHP_EOL, $diagnosticReport);
$reportLines = array_map('trim', $reportLines);

$reportCharacters = array_map('str_split', $reportLines);

$gammaRateBinary = "";
$epsilonRateBinary = "";


for ($i = 0; $i < strlen($reportLines[0]); $i++) {

    $positionValues = array_column($reportCharacters, $i);

    $countValues = array_count_values($positionValues);

    if ($countValues[1] > $countValues[0]) {
        $gammaRateBinary .= 1;
        $epsilonRateBinary .= 0;
    } else {
        $gammaRateBinary .= 0;
        $epsilonRateBinary .= 1;
    }

}

print "Gamma: " . bindec($gammaRateBinary) . " Epsilon: " . bindec($epsilonRateBinary) . " (" . bindec($gammaRateBinary) * bindec($epsilonRateBinary) . ")";
