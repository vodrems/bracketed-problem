<?php

namespace BracketedProblem;

use InvalidArgumentException;

class CloseBrackets
{
    /**
     * @var string
     */
    private $input;

    /**
     * @var array
     */
    private $matchedSymbols = [
        "(" => 0,
        ")" => 0,
        " " => 0,
        "\n" => 0,
        "\t" => 0,
        "\r" => 0,
    ];

    /**
     * CloseBrackets constructor.
     * @param string $inputString
     */
    public function __construct(string $inputString)
    {
        $this->input = $inputString;
    }

    /**
     * @return bool
     */
    public function check(): bool
    {
        $result = true;

        for ($i = 0; $i < strlen($this->input); $i++) {

            // check if symbol is allowed
            if (!isset($this->matchedSymbols[$this->input[$i]])) {
                throw new InvalidArgumentException("Wrong symbol on ${i}\n");
                break;
            }

            // check correct numbers of brackets
            $this->matchedSymbols[$this->input[$i]] += 1;

            if (!$this->checkCountBrackets($this->matchedSymbols, true)) {
                $result = false;
                break;
            }
        }

        $result = $this->checkCountBrackets($this->matchedSymbols);

        return $result;
    }

    /**
     * @param array $symbols
     * @param bool $checkingInProgress
     * @return bool
     */
    private function checkCountBrackets(array $symbols, bool $checkingInProgress = false): bool
    {
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
}