<?php

require_once __DIR__ . "/vendor/autoload.php";

$input = "1163751742
1381373672
2136511328
3694931569
7463417111
1319128137
1359912421
3125421639
1293138521
2311944581";
$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-15-input.txt");

$map = [];
$lines = explode(PHP_EOL, $input);

for ($a = 0; $a < 5; $a++) {

    foreach ($lines as $y => $line) {
        $line = trim($line);

        if (empty($line)) {
            continue;
        }

        $pieces = str_split($line);
        $thisBar = [];


        for ($b = 0; $b < 5; $b++) {
            foreach ($pieces as $piece) {
                $chitons = $piece + $a + $b;

                while ($chitons > 9) {
                    $chitons -= 9;
                }

                $thisBar[] = $chitons;
            }            
        }

        $maxX = sizeof($thisBar) - 1;

        $map[] = $thisBar;
    }
}

$maxY = sizeof($map) - 1;

$grid = new BlackScorp\Astar\Grid($map);

$startPosition = $grid->getPoint(0,0);
$endPosition = $grid->getPoint($maxX, $maxY);

$astar = new BlackScorp\Astar\Astar($grid);
$nodes = $astar->search($startPosition, $endPosition);

$cost = 0 - $map[0][0];

if (count($nodes) === 0) {
    echo "Path not found";
} else {
    foreach($nodes as $node){
        $cost += $map[$node->getY()][$node->getX()];
    }
}

print $cost;

