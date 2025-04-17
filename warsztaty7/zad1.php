<?php
$Countries = array("Italy"=>"Rome",
    "Luxembourg"=>"Luxembourg",
    "Belgium"=> "Brussels",
    "Denmark"=>"Copenhagen",
    "Finland"=>"Helsinki",
    "France" => "Paris",
    "Slovakia"=>"Bratislava",
    "Slovenia"=>"Ljubljana",
    "Germany" => "Berlin",
    "Greece" => "Athens",
    "Ireland"=>"Dublin",
    "Netherlands"=>"Amsterdam",
    "Portugal"=>"Lisbon",
    "Spain"=>"Madrid",
    "Sweden"=>"Stockholm",
    "United Kingdom"=>"London",
    "Cyprus"=>"Nicosia",
    "Lithuania"=>"Vilnius",
    "Czech Republic"=>"Prague",
    "Estonia"=>"Tallin",
    "Hungary"=>"Budapest",
    "Latvia"=>"Riga","Malta"=>"Valetta",
    "Austria" => "Vienna",
    "Poland"=>"Warsaw");

$Capitals = array();
foreach ($Countries as $key => $value) {
    $Capitals[$key] = $value;
}
array_multisort($Capitals, SORT_ASC, $Countries);

foreach ($Countries as $key => $value) {
    sort($Countries);
    echo "The capital of " . $key . " is " . $value . "<br>";
}


