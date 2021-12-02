<?php

function fgetsGenerator($file)
{
    $handle = fopen($file, "r");
    if (!$handle) {
        throw new \InvalidArgumentException($file);
    }

    while (($buffer = fgets($handle, 4096)) !== false) {
        yield $buffer;
    }

    fclose($handle);
}
