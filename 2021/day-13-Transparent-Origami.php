<?php

$input="6,10
0,14
9,10
0,3
10,4
4,11
6,0
6,12
4,1
0,13
10,12
3,4
3,0
8,4
1,10
2,14
8,10
9,0

fold along y=7
fold along x=5";
$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-13-input.txt");

$lines = explode(PHP_EOL, $input);

$dots = [];
$folds = [];


foreach ($lines as $line) {
    if (stristr($line, ",") !== false) {
        $pieces = explode(",", trim($line));
        $x = $pieces[0];
        $y = $pieces[1];

        if ($x > $maxX) {
            $maxX = $x;
        }

        if ($y > $maxY) {
            $maxY = $y;
        }

        $dots[] = ['x' => $x, 'y' => $y];
        continue;
    }

    if (empty(trim($line))) {
        continue;
    }

    if (stristr($line, "fold along") !== false) {
        $pieces = explode(" ", trim($line));
        $last = array_pop($pieces);
        $pieces = explode("=", $last);
        $folds[] = ['along' => $pieces[0], 'at' => $pieces[1]];
    }
}

foreach ($folds as $fold) {
    $dots = array_map(function (array $dot) use ($fold) {

        $x = $dot['x'];
        $y = $dot['y'];
        $at = $fold['at'];

        if ($fold['along'] == 'x' && $x > $at) {
            // fold left, y static.
            $distanceFromFold = $x - $at;
            $x = $at - $distanceFromFold;            
        } else if ($fold['along'] == 'y' && $y > $at) {
            // fold up, x static
            $distanceFromFold = $y - $at;
            $y = $at - $distanceFromFold;     
        }

        $out['in'] = $dot;
        $out['fold'] = $fold;
        $out['return'] = [$x, $y];

        return ['x' => $x, 'y' => $y];
    }, $dots);
}

$join = function (array $array) { return join(",", $array);};
$explode = function (string $str) { return explode(",", $str);};

$dots = array_map($join, $dots);
array_unique($dots, SORT_REGULAR);
sort($dots);
$dots = array_map($explode, $dots);

$maxX = max(array_column($dots, 0));
$maxY = max(array_column($dots, 1));

$dots = array_map($join, $dots);

for ($y = 0; $y <= $maxY; $y++) {
    for ($x = 0; $x <= $maxX; $x++) {    
        if (in_array("{$x},{$y}", $dots)) {
            print "#"; 
        } else {
            print ".";
        }
    }

    print PHP_EOL;
}



