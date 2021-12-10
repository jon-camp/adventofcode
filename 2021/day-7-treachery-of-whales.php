<?php

$input = "16,1,2,0,4,2,7,1,2,14";
$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-7-input.txt");


$crabPositions = explode(",", $input);
$crabPositions = array_map('trim', $crabPositions);

$minPosition = min($crabPositions);
$maxPosition = max($crabPositions);

$crabsByPosition = array_fill($minPosition, $maxPosition + 1, 0);
$fuelByPositon = array_fill($minPosition, $maxPosition + 1, 0);

foreach ($crabPositions as $position) {
    $crabsByPosition[$position]++;
}

foreach ($fuelByPositon as $targetPositon => $fuel) {

    $fuel = 0;

    foreach ($crabsByPosition as $fromPosition => $crabs) {
        $distance = abs($targetPositon - $fromPosition);
        $fuel += sumOfFirstNIntegers($distance)  * $crabs;
    }

    $fuelByPositon[$targetPositon] = $fuel;
}

print_r($fuelByPositon);
$minFuel = min($fuelByPositon);

print "Min: {$minFuel} at Position: " . array_search($minFuel, $fuelByPositon) . PHP_EOL;

/**
 * @see https://www.cuemath.com/sum-of-integers-formula/
 */
function sumOfFirstNIntegers($n)
{    
    return ($n * ($n + 1)) / 2;
}