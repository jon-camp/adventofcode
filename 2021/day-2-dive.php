<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "functions.php";

$courseGenerator = fgetsGenerator(__DIR__ . DIRECTORY_SEPARATOR . "day-2-input.txt");

$horizontal = 0;
$depth = 0;

foreach ($courseGenerator as $movement) {
    list($direction, $increment) = explode(" ", trim($movement));

    switch ($direction) {
        case "forward":
            $horizontal += $increment;
            break;
        case "up": 
            $depth -= $increment;
            break;
        case "down":
            $depth += $increment;
            break;
        default:
            throw new \ErrorException();            
    }

}

echo "Horizontal: {$horizontal}, Depth: {$depth} (" . ($horizontal * $depth) . ")";