<?php

chdir(__DIR__);

require 'functions.php';

$input = "2-4,6-8
2-3,4-5
5-7,7-9
2-8,3-7
6-6,4-6
2-6,4-8";

$generator = inputGenerator($input);
$generator = fgetsGenerator("day-4-input.txt");

$fullyContained = 0;
$totalOverlaps = 0;

foreach ($generator as $combo) {
    $assignments = explode(",", $combo);

    $assignments = array_map(function ($value) { return explode("-", $value); }, $assignments);

    $ranges = [];
    foreach ($assignments as $assignment) {

        $ranges[] = range($assignment[0], $assignment[1]);

    }

    $overlap = array_intersect($ranges[0], $ranges[1]);

    if (sizeof($overlap)) {
        $totalOverlaps++;
    }

    if (sizeof($overlap) == sizeof($ranges[0])
        || sizeof($overlap) == sizeof($ranges[1])
    ) {
        $fullyContained++;
    }

}

print $fullyContained . " " . $totalOverlaps;
