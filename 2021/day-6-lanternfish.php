<?php

$input = "3,4,3,1,2";
$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-6-input.txt");

$initialValue = 8;
$resetValue = 6;
$minValue = 0;

$fishes = explode(",", $input);

$fishesAtDay = [
    0 => 0,
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0 
];

foreach ($fishes as $day) {
    $day = trim($day);
    $fishesAtDay[$day]++;
}

for ($i = 0; $i < 256; $i++) {

    $spawningFish = $fishesAtDay[0];
    $fishesAtDay[0] = $fishesAtDay[1];
    $fishesAtDay[1] = $fishesAtDay[2];
    $fishesAtDay[2] = $fishesAtDay[3];
    $fishesAtDay[3] = $fishesAtDay[4];
    $fishesAtDay[4] = $fishesAtDay[5];
    $fishesAtDay[5] = $fishesAtDay[6];
    $fishesAtDay[6] = $fishesAtDay[7] + $spawningFish;
    $fishesAtDay[7] = $fishesAtDay[8];
    $fishesAtDay[8] = $spawningFish;
}

print array_sum($fishesAtDay);