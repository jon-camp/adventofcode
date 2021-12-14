<?php

$input = "NNCB

CH -> B
HH -> N
CB -> H
NH -> C
HB -> C
HC -> B
HN -> C
NN -> C
BH -> H
NC -> B
NB -> B
BN -> B
BB -> N
BC -> B
CC -> N
CN -> C";
$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-14-input.txt");

$lines = explode(PHP_EOL, $input);

$template = array_shift($lines);
$template = trim($template);

$existingPairs = [];


function assertPair($thisPair, &$existingPairs) {

    if (!array_key_exists($thisPair, $existingPairs)) {
        $existingPairs[$thisPair] = 0;
    }

}

for ($i = 0; $i < strlen($template) - 1; $i++) {
    $thisPair = $template[$i] . $template[$i+1];
    assertPair($thisPair, $existingPairs);

    $existingPairs[$thisPair]++;
}

foreach ($lines as $line) {
    $line = trim($line);

    if (empty($line)) {
        continue;
    }

    $a = $line[0];
    $b = $line[1];
    $c = $line[-1];

    $pairs["{$a}{$b}"] = $c;
}


$steps = 40;

for ($step = 0; $step < $steps; $step++) {

    $clonedPairs = $existingPairs;

    foreach ($pairs as $pair => $add) {

        if (!array_key_exists($pair, $existingPairs)) {
            continue;
        }

        $existing = $existingPairs[$pair];

        $leftPair = $pair[0] . $add;
        $rightPair = $add . $pair[1];

        assertPair($leftPair, $clonedPairs);
        assertPair($rightPair, $clonedPairs);

        $clonedPairs[$leftPair] += $existing;
        $clonedPairs[$rightPair] += $existing;
        $clonedPairs[$pair] -= $existing;
    }

    $existingPairs = $clonedPairs;
}

$letters = [];

foreach ($existingPairs as $pair => $count) {
    $letters[$pair[0]] += $count;
    $letters[$pair[1]] += $count;
}

print ceil((max($letters) - min($letters)) / 2);

