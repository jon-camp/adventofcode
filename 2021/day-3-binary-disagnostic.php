<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "functions.php";

$diagnosticReport = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-3-input.txt");

$diagnosticReport = trim($diagnosticReport);

function getRating(string $diagnosticReport, bool $seekMostCommonBit = true, int $tieBreakerWinValue = 1)
{
    $tieBreakerLoserValue = ($tieBreakerWinValue == 1 ? 0 : 1);

    $reportLines = explode(PHP_EOL, $diagnosticReport);
    $reportLines = array_map('trim', $reportLines);

    $mask = "";
    $rating = "";

    for ($i = 0; $i < strlen($reportLines[0]); $i++) {

        $reportCharacters = array_map('str_split', $reportLines);
    
        $positionValues = array_column($reportCharacters, $i);
        $countValues = array_count_values($positionValues);

        if ($countValues[$tieBreakerWinValue] == $countValues[$tieBreakerLoserValue]) {
            $mask .= $tieBreakerWinValue;
        } else if ($seekMostCommonBit) {
            $mask .= array_search(max($countValues), $countValues, true);
        } else {
            $mask .= array_search(min($countValues), $countValues, true);
        }
    
        $matches = [];
        preg_match_all("/\b{$mask}.*\b/i", $diagnosticReport, $matches);
    
        $reportLines = $matches[0];
    
        if (sizeof($reportLines) == 1) {
            $rating = $reportLines[0];
            break;
        }    
    }

    return $rating;
}

$oxygenRating = getRating($diagnosticReport, true, 1);
$co2rating = getRating($diagnosticReport, false, 0);


print "Oxygen: " . $oxygenRating . " CO2: " . $co2rating . PHP_EOL;
print "Oxygen: " . bindec($oxygenRating) . " CO2: " . bindec($co2rating) . " (" . bindec($oxygenRating) * bindec($co2rating) . ")";