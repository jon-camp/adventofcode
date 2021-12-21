<?php

$input="Player 1 starting position: 4
Player 2 starting position: 8";
//$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-21-input.txt");

$lines = explode(PHP_EOL, $input);

$player1Position = trim(substr($lines[0], -2));
$player2Position = trim(substr($lines[1], -2));

$player1Score = 0;
$player2Score = 0;

$targetScore = 1000;

$rollSequences = [[]];

$player1Wins = 0;
$player2Wins = 0;


do {

    $rollSequences = addThreeRolls($rollSequences);

    foreach ($rollSequences as $r => $rollSequence) {
        list($player1Score, $player2Score) = getPlayerScoresFromSequence($rollSequence);

        //print "Player 1: {$player1Score} Player 2: {$player2Score}" . PHP_EOL;


        if ($player1Score >= $targetScore) {
            $player1Wins++;

            unset($rollSequences[$r]);
        }
    }

    $rollSequences = addThreeRolls($rollSequences);

    foreach ($rollSequences as $r => $rollSequence) {
        list($player1Score, $player2Score) = getPlayerScoresFromSequence($rollSequence);

        if ($player2Score >= $targetScore) {
            $player2Wins++;
            unset($rollSequences[$r]);
        }
    }

} while (sizeof($rollSequences));

print "Player 1: {$player1Wins}" . PHP_EOL;
print "Player 2: {$player2Wins}" . PHP_EOL;


function getPlayerScoresFromSequence(array $rollSequence) {
    
    global $player1Position, $player2Position;
    global $targetScore;

    // Don't change the global values.
    $player1 = $player1Position;
    $player2 = $player2Position;

    $player1Score = 0;
    $player2Score = 0;

    while (true) {

        $nextRoll = array_shift($rollSequence);
        $nextRoll += array_shift($rollSequence);
        $nextRoll += array_shift($rollSequence);

        $player1 = getNewPosition($player1, $nextRoll);
        $player1Score += $player1;


        if (empty($rollSequence) || $player1Score >= $targetScore) {
            return [$player1Score, $player2Score];
        }

        $nextRoll = array_shift($rollSequence);
        $nextRoll += array_shift($rollSequence);
        $nextRoll += array_shift($rollSequence);    

        $player2 = getNewPosition($player2, $nextRoll);
        $player2Score += $player2;

        if (empty($rollSequence) || $player2Score >= $targetScore) {
            return [$player1Score, $player2Score];
        }    
    }
}

function getNewPosition($current, $roll) 
{
    $newPosition = $current + $roll;
    while ($newPosition > 10) {
        $newPosition -= 10;
    }

    return $newPosition;
}



function addThreeRolls(array $rollSequences)
{
    foreach ($rollSequences as $r => $rollSequence) {

        if (empty($rollSequence)) {
            $lastRoll = 0;
        } else {
            $lastRoll = array_pop($rollSequence);
            array_push($rollSequence, $lastRoll);
        }
    
        for ($i = 1; $i <= 3; $i++) {
            $roll = $lastRoll + $i;
    
            if ($roll > 100) {
                $roll -= 100;
            }
    
            array_push($rollSequence, $roll);
        }
    
        $rollSequences[$r] = $rollSequence;
    }

    return $rollSequences;
}
