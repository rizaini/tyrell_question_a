<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
// special function to return special request as in question
function getCardFace($number) {
    switch ($number) {
        case 1: return 'A';
        case 10: return 'X'; //special request as in the question. 10 cards represented as X
        case 11: return 'J'; //usual J as JACK
        case 12: return 'Q'; //usual J as Queen
        case 13: return 'K'; //usual J as King
        default: return $number;
    }
}

// function to distribute / shuffle card
function distributeCards($n) {
    $suits = ['S', 'H', 'D', 'C'];
    $deck = [];

    // set 52 cards
    foreach ($suits as $suit) {
        for ($i = 1; $i <= 13; $i++) {
            $deck[] = $suit . getCardFace($i);
        }
    }

    shuffle($deck);

    // assign cards to number of players
    $distribution = array_fill(0, $n, []);
    for ($i = 0; $i < count($deck); $i++) {
        $distribution[$i % $n][] = $deck[$i];
    }

    return $distribution;
}

// main function
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['people']) && is_numeric($_GET['people'])) {
        $n = intval($_GET['people']);
        if ($n < 0) {
            echo "Input value does not exist or value is invalid";
            exit;
        }

        $distribution = distributeCards($n);

        // display output after card has been distributed
        foreach ($distribution as $personCards) {
            echo implode(',', $personCards) . "\n";
        }
    } else {
        echo "Input value does not exist or value is invalid";
    }
}
?>