<?php

function fgetsGenerator($file)
{
    $handle = fopen($file, "r");
    if (!$handle) {
        throw new \InvalidArgumentException($file);
    }

    while (($buffer = fgets($handle, 4096)) !== false) {
        yield trim($buffer);
    }

    fclose($handle);
}


function inputGenerator($lines)
{
    $lines = explode(PHP_EOL, $lines);

    foreach ($lines as $line) {
        yield trim($line);
    }
}
