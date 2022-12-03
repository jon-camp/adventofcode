<?php

chdir(__DIR__);

require 'functions.php';

$input = "vJrwpWtwJgWrhcsFMMfFFhFp
jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL
PmmdzqPrVvPwwTWBwg
wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn
ttgJtRGJQctTZtZT
CrZsJsPPZsGzwwsLwLmpwMDw";

$generator = inputGenerator($input);
$generator = fgetsGenerator("day-3-input.txt");

$priority = '0abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$totalPriority = 0;

$thisGroup = [];

foreach ($generator as $contents) {

    /*
    $compartment1 = substr($contents, 0, strlen($contents) / 2);
    $compartment2 = substr($contents, 0 - (strlen($contents) / 2));

    $compartment1 = str_split($compartment1);
    $compartment2 = str_split($compartment2);
    */

    $thisGroup[] = str_split($contents);

    if (sizeof($thisGroup) == 3) {
        $matchingItems = array_intersect($thisGroup[0], $thisGroup[1], $thisGroup[2]);

        $exampleItem = array_pop($matchingItems);

        $totalPriority += strpos($priority, $exampleItem);

        $thisGroup = [];
    }




}

print $totalPriority;