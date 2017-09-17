<?php

//    Created on : Jul 11, 2017, 2:28:34 PM
//    Author     : Daniel Dias

$results = ["It's a Tie!", "You Win!", "Computer Wins!"];
$moves = ["Rock", "Paper", "Scissors","Lizard","Spock"];
$values = ["rock", "paper", "scissors","lizard","spock"];
$sel = ["rock" => "", "paper" => "", "scissors" => "", 
    "lizard" => "", "spock" => ""];

//Array created to match the winning combinations
$winner= ["rock" => ["scissors", "lizard"],"paper" => ["rock", "spock"],
    "scissors" => ["paper", "lizard"], "lizard" => ["paper", "spock"],
    "spock" => ["scissors", "rock"]];

//Array created to store Sheldon's line for each combination
$sheldonResult = ["rock" => ["Rock crushes Scissors", "Rock crushes Lizard"], 
    "paper" => ["Paper covers Rock","Paper disproves Spock"], 
    "scissors" => ["Scissors cuts Paper", "Scissors decapitates Lizard"], 
    "lizard" => ["Lizard eats Paper", "Lizard poisons Spock"], 
    "spock" => ["Spock smashes Scissors","Spock vaporizes Rock"]];

?>