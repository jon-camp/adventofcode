<?php

function fgetsGenerator($file)
{
    $handle = fopen($file, "r");
    if (!$handle) {
        throw new \InvalidArgumentException($file);
    }

    while (($buffer = fgets($handle, 4096)) !== false) {
        yield $buffer;
    }

    fclose($handle);
}

$depthGenerator = fgetsGenerator(__DIR__ . DIRECTORY_SEPARATOR . "day-1-input.txt");

$lastDepth = null;
$depthIncreases = 0;

foreach ($depthGenerator as $currentDepth) {
    if (!is_null($lastDepth) && $currentDepth > $lastDepth) {
        $depthIncreases++;
    }

    $lastDepth = $currentDepth;
}

echo $depthIncreases;