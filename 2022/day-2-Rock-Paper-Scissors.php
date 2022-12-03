<?php

chdir(__DIR__);

require 'functions.php';

$input = "A Y
B X
C Z";

$generator = inputGenerator($input);
$generator = fgetsGenerator("day-2-input.txt");

$scoreLost = 0;
$scoreDraw = 3;
$scoreWon = 6;

const oRock = 'A';
const oPaper = 'B';
const oScissors = 'C';

const meRock = 'J';
const mePaper = 'K';
const meScissors = 'L';

$combos[oRock . " " . meRock] = $scoreDraw;
$combos[oRock . " " . mePaper] = $scoreWon;
$combos[oRock . " " . meScissors] = $scoreLost;

$combos[oPaper . " " . meRock] = $scoreLost;
$combos[oPaper . " " . mePaper] = $scoreDraw;
$combos[oPaper . " " . meScissors] = $scoreWon;

$combos[oScissors . " " . meRock] = $scoreWon;
$combos[oScissors . " " . mePaper] = $scoreLost;
$combos[oScissors . " " . meScissors] = $scoreDraw;

const meWin = 'Z';
const meTie = 'Y';
const meLose = 'X';

$combos[oRock . " " . meWin] = mePaper;
$combos[oRock . " " . meTie] = meRock;
$combos[oRock . " " . meLose] = meScissors;

$combos[oPaper . " " . meWin] = meScissors;
$combos[oPaper . " " . meTie] = mePaper;
$combos[oPaper . " " . meLose] = meRock;

$combos[oScissors . " " . meWin] = meRock;
$combos[oScissors . " " . meTie] = meScissors;
$combos[oScissors . " " . meLose] = mePaper;

$playScore[meRock]= 1;
$playScore[mePaper] = 2;
$playScore[meScissors] = 3;


$score = 0;

foreach ($generator as $line) {

    $myPlay = $combos[$line];

    $theirPlay = substr($line, 0, 1);

    $score += $combos[$theirPlay . " " . $myPlay];
    $score += $playScore[$myPlay];

}

print $score;