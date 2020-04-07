<?php

include 'vendor/autoload.php';

use Cybersai\UssdDecision\UssdDecision;

// if input is an integer
echo UssdDecision::input(0)
    ->isInteger('Input is an integer')
    ->default('No match')
    ->outcome();

// if input is equal to value
echo UssdDecision::input('0241122331')
    ->isEqual('0241122331', 'Input is equal to value')
    ->default('Not a match')
    ->outcome();

// if input exist in array
echo UssdDecision::input('0241122331')
    ->in(['0241122331', '05452222222'], 'Input exist in array')
    ->default('Not a match')
    ->outcome();

// if length is equal to value length
echo UssdDecision::input('024111')
    ->length(6, 'Input length is equal to value length')
    ->default('Not a match')
    ->outcome();

// if input is a phone number
echo UssdDecision::input('0241122331')
    ->isPhoneNumber('Input is a phone number')
    ->default('Not a match')
    ->outcome();