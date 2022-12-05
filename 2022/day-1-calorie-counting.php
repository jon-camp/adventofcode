<?php

chdir(__DIR__);

require 'functions.php';

$input = "1000
2000
3000

4000

5000
6000

7000
8000
9000

10000";

$thisElf = 0;
$maxElf = [0, 0, 0];

$generator = inputGenerator($input);
$generator = fgetsGenerator("day-1-input-a.txt");

foreach ($generator as $value) {

    if (empty($value)) {
        $minElf = min($maxElf);
        if ($thisElf > $minElf) {
            unset($maxElf[array_search($minElf, $maxElf)]);
            $maxElf[] = $thisElf;
        }

        $thisElf = 0;
        continue;
    }

    $thisElf += (int)$value;
}

if ($thisElf) {
    $minElf = min($maxElf);
    if ($thisElf > $minElf) {
        unset($maxElf[array_search($minElf, $maxElf)]);
        $maxElf[] = $thisElf;
    }

    $thisElf = 0;    
}

print array_sum($maxElf);