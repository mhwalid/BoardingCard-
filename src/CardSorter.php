<?php
namespace App;

class CardSorter
{
    private $cards;

    public function __construct($cards)
    {
        $this->cards = $cards;
    }

    public function sort()
    {
        $map = [];
        $destinations = [];

        foreach ($this->cards as $card) {
            $map[$card['from']] = $card;
            $destinations[] = $card['to'];
        }

        // Trouver le point de départ (ville qui n’est jamais une destination)
        foreach ($map as $from => $card) {
            if (!in_array($from, $destinations)) {
                $start = $from;
                break;
            }
        }

        $sorted = [];

        while (isset($map[$start])) {
            $sorted[] = $map[$start];
            $start = $map[$start]['to'];
        }

        return $sorted;
    }

    public function describe()
    {
        $steps = $this->sort();

        foreach ($steps as $card) {
            $line = "Take {$card['transport']}";

            if (!empty($card['number'])) {
                $line .= " {$card['number']}";
            }

            $line .= " from {$card['from']} to {$card['to']}.";

            if (!empty($card['seat'])) {
                $line .= " Sit in seat {$card['seat']}.";
            } else {
                $line .= " No seat assignment.";
            }

            if (!empty($card['gate'])) {
                $line .= " Gate {$card['gate']}.";
            }

            if (!empty($card['baggage'])) {
                $line .= " {$card['baggage']}.";
            }

            echo $line . PHP_EOL;
        }

        echo "You have arrived at your final destination." . PHP_EOL;
    }
}
