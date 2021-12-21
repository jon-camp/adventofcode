<?php

$input="Player 1 starting position: 4
Player 2 starting position: 8";
$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "day-21-input.txt");

$lines = explode(PHP_EOL, $input);

$player1Position = trim(substr($lines[0], -2));
$player2Position = trim(substr($lines[1], -2));

$player1Score = 0;
$player2Score = 0;

$targetScore = 1000;

$nextRoll = 1;
$totalRolls = 0;


while ($player1Score < $targetScore && $player2Score < $targetScore) {

    
    $player1Roll = getPlayerRole();
    $player1Position = getNewPosition($player1Position, $player1Roll);
    $player1Score += $player1Position;

    if ($player1Score >= $targetScore) {
        break;
    }

    $player2Roll = getPlayerRole();
    $player2Position = getNewPosition($player2Position, $player2Roll);
    $player2Score += $player2Position;
}

$losingScore = min([$player1Score, $player2Score]);

print "Losing Score {$losingScore} * Total Rolls {$totalRolls} = " . ($losingScore * $totalRolls) . PHP_EOL;


function getNewPosition($current, $roll) 
{
    $newPosition = $current + $roll;
    while ($newPosition > 10) {
        $newPosition -= 10;
    }

    return $newPosition;
}



function getPlayerRole()
{
    global $nextRoll;
    global $totalRolls;

    $total = 0;

    for ($i = 0; $i < 3; $i++) {
        $roll = $nextRoll;
        $totalRolls++;

        $total += $roll;

        if ($roll == 100) {
            $nextRoll = 1;
        } else {
            $nextRoll++;
        }
    }

    return $total;
}
