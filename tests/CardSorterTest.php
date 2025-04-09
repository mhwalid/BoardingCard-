<?php

use App\CardSorter;
use PHPUnit\Framework\TestCase;

class CardSorterTest extends TestCase
{
    public function testSortingCardsInCorrectOrder()
    {
        $cards = [
            ['from' => 'Madrid', 'to' => 'Barcelona', 'transport' => 'train', 'number' => '78A', 'seat' => '45B'],
            ['from' => 'Stockholm', 'to' => 'New York JFK', 'transport' => 'flight', 'number' => 'SK22', 'seat' => '7B'],
            ['from' => 'Barcelona', 'to' => 'Gerona Airport', 'transport' => 'airport bus'],
            ['from' => 'Gerona Airport', 'to' => 'Stockholm', 'transport' => 'flight', 'number' => 'SK455', 'seat' => '3A'],
        ];

        $sorter = new CardSorter($cards);
        $sorted = $sorter->sort();

        $this->assertEquals('Madrid', $sorted[0]['from']);
        $this->assertEquals('Barcelona', $sorted[0]['to']);

        $this->assertEquals('Barcelona', $sorted[1]['from']);
        $this->assertEquals('Gerona Airport', $sorted[1]['to']);

        $this->assertEquals('Gerona Airport', $sorted[2]['from']);
        $this->assertEquals('Stockholm', $sorted[2]['to']);

        $this->assertEquals('Stockholm', $sorted[3]['from']);
        $this->assertEquals('New York JFK', $sorted[3]['to']);
    }
}
