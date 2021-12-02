<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "functions.php";

$depthGenerator = fgetsGenerator(__DIR__ . DIRECTORY_SEPARATOR . "day-1-input.txt");

$trailingDepths = [];
$lastTrailingDepth = null;

$depthIncreases = 0;

$measurementWindow = 3;

foreach ($depthGenerator as $currentDepth) {
    $trailingDepths[] = $currentDepth;

    if (!is_null($lastTrailingDepth)) {
        array_shift($trailingDepths);
    }

    if (sizeof($trailingDepths) != $measurementWindow) {
        continue;
    }

    $trailingDepth = array_sum($trailingDepths);

    if (!is_null($lastTrailingDepth) 
        && $trailingDepth > $lastTrailingDepth
    ) {
        $depthIncreases++;
    }

    $lastTrailingDepth = $trailingDepth;
}

echo $depthIncreases;