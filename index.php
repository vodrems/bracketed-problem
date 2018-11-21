<?php

$input = "(()()()()))((((()()()))(()()()(((()))))))";
$matchedSymbols = [
    "(" => 0,
    ")" => 0,
    " " => 0,
    "\n" => 0,
    "\t" => 0,
    "\r" => 0,
];
$output = null;

for ($i = 0; $i < strlen($input); $i++) {

    // check if symbol is allowed
    if (!isset($matchedSymbols[$input[$i]])) {
        $output = false;
        break;
    }

    // check correct numbers of brackets
    $matchedSymbols[$input[$i]] += 1;

    if (!checkCountBrackets($matchedSymbols, true)) {
        echo $i;
        $output = false;
        break;
    }
}

print_r($matchedSymbols);
var_dump($output);

function checkCountBrackets(array $symbols, bool $checkingInProgress = false): bool {
    $bracket = [
        'open' => "(",
        'close' => ")",
    ];

    if ($checkingInProgress) {
        if ($symbols[$bracket['open']] < $symbols[$bracket['close']]) {
            return false;
        } else {
            return true;
        }
    } else {
        if ($symbols[$bracket['close']] === $symbols[$bracket['open']]) {
            return true;
        } else {
            return false;
        }
    }
}
