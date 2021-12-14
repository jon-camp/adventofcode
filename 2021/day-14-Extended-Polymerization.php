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

//print "Template: " . $template . PHP_EOL;

$steps = 10;

for ($step = 0; $step < $steps; $step++) {

    $newString = "";

    for ($i = 0; $i < strlen($template) - 1; $i++) {
        $pair = $template[$i] . $template[$i+1];


        $newString .= $pair[0];

        if (!array_key_exists($pair, $pairs)) {        
            continue;
        }


        $newString .= $pairs[$pair];
    }

    $newString .= $template[-1];

    //print "After step {$step}:" . $newString . PHP_EOL;

    $template = $newString;
}

$counts = count_chars($template, 1);

print max($counts) - min($counts);