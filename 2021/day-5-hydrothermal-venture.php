<?php

$input = "0,9 -> 5,9
8,0 -> 0,8
9,4 -> 3,4
2,2 -> 2,1
7,0 -> 7,4
6,4 -> 2,0
0,9 -> 2,9
3,4 -> 1,4
0,0 -> 8,8
5,5 -> 8,2
";

$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-5-input.txt");

$vents = explode(PHP_EOL, $input);

$minX = 0;
$maxX = 0;

$minY = 0;
$maxY = 0;

$parsedVents = [];

foreach ($vents as $vent) {
    if (empty(trim($vent))) {
        continue;
    }

    $pieces = explode(" ", $vent);
    $start = $pieces[0];
    $end = $pieces[2];

    $pieces = explode(",", $start);
    $pieces = array_map('trim', $pieces);
    $x1 = $pieces[0];
    $y1 = $pieces[1];

    $pieces = explode(",", $end);
    $pieces = array_map('trim', $pieces);
    $x2 = $pieces[0];
    $y2 = $pieces[1];    

    $minX = min([$minX, $x1, $x2]);
    $maxX = max([$maxX, $x1, $x2]);

    $minY = min([$minY, $y1, $y2]);
    $maxY = max([$maxY, $y1, $y2]);

    $parsedVents[] = [['x' => $x1, 'y' => $y1], ['x' => $x2, 'y' => $y2]];
}

$grid = [];
foreach (range($minX, $maxX) as $x) {
    foreach (range($minY, $maxY) as $y) {
        $grid[$x][$y] = 0;
    }   
}

foreach ($parsedVents as $parsedVent) {
    $start = $parsedVent[0];
    $end = $parsedVent[1];

    if ($start['x'] == $end['x']) {
        $xChange = 0;
    } else if ($end['x'] < $start['x']) {
        $xChange = -1;
    } else {
        $xChange = 1;
    }
    
    if ($start['y'] == $end['y']) {
        $yChange = 0;
    } else if ($end['y'] < $start['y']) {
        $yChange = -1;
    } else {
        $yChange = 1;
    }

    $currentX = $start['x'];
    $currentY = $start['y'];

    while ($currentX != $end['x'] || $currentY != $end['y']) {
        $grid[$currentX][$currentY]++;

        $currentX += $xChange;
        $currentY += $yChange;
    }
        
    $grid[$end['x']][$end['y']]++;
}

$dangerousAreas = 0;

foreach ($grid as $row) {
    foreach ($row as $col) {
        if ($col > 1) {
            $dangerousAreas++;
        }
    }
}

print "Dangerous Areas: {$dangerousAreas}";