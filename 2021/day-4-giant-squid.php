<?php

$input = "7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1

22 13 17 11  0
 8  2 23  4 24
21  9 14 16  7
 6 10  3 18  5
 1 12 20 15 19

 3 15  0  2 22
 9 18 13 17  5
19  8  7 25 23
20 11 10 24  4
14 21 16 12  6

14 21 17 24  4
10 16 15  9 19
18  8 23 26 20
22 11 13  6  5
 2  0 12  3  7
 ";

$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-4-input.txt");
$input = explode(PHP_EOL, $input);

$calledNumbers = array_shift($input);

$board = [];
$boards = [];

foreach ($input as $line) {
    if (empty(trim($line))) {
        if (sizeof($board)) { 

            $board['col'][] = array_column($board['row'], 0);
            $board['col'][] = array_column($board['row'], 1);
            $board['col'][] = array_column($board['row'], 2);
            $board['col'][] = array_column($board['row'], 3);
            $board['col'][] = array_column($board['row'], 4);

            $boards[] = $board;
            $board = [];
        }
        continue;
    }

    $board['raw'][] = $line;

    

    $line = preg_replace('/\s+/', ' ', $line);
    $numbers = explode(" ", trim($line));
    
    if (!array_key_exists('numbers', $board)) {
        $board['numbers'] = [];
    }
    $board['numbers'] = array_merge($board['numbers'], $numbers);
    
    $board['row'][] = $numbers;

}

$calledNumbers = explode(",", $calledNumbers);

$calledSoFar = [];

foreach ($calledNumbers as $calledNumber) {
    $calledSoFar[] = $calledNumber;

    if (sizeof($calledSoFar) < 5) {
        continue;
    }

    foreach ($boards as $i => $board) {

        foreach ($board['col'] as $col) {
            $diff = array_diff($col, $calledSoFar);
            if (empty($diff)) {

                if (sizeof($boards) == 1) {
                    declareWinner($board, $calledSoFar, $calledNumber);
                    break 3;
                } else {
                    unset($boards[$i]);
                    continue 2;
                }
            }
        }

        foreach ($board['row'] as $row) {
            $diff = array_diff($row, $calledSoFar);
            if (empty($diff)) {
                if (sizeof($boards) == 1) {
                    declareWinner($board, $calledSoFar, $calledNumber);
                    break 3;
                } else {
                    unset($boards[$i]);
                    continue 2;
                }
            }
        }        
    }
}

function declareWinner(array $board, array $calledSoFar, int $justCalled) {
    $uncalled = array_diff($board['numbers'], $calledSoFar);

    $sum = array_sum($uncalled);

    print "{$sum} * {$justCalled} = " . $sum * $justCalled . PHP_EOL;

}
