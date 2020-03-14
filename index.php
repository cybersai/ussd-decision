<?php

include 'vendor/autoload.php';

use Cybersai\UssdDecision\UssdDecision;

echo UssdDecision::using('0241122331')
    ->integer('It an integer')
    ->equal('0241122442', 'It my Number')
    ->in(['05451111111', '05452222222'], 'It a schools line')
    ->length(6, 'Too short')
    ->phoneNumber('It a phone number')
    ->any('Did not match any')
    ->outcome();


