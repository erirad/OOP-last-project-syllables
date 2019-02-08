<?php
include 'File.php';
include 'matches.php';
include 'syllables.php';
$file = new File("text.txt");
$matches = new Matches();
//$matches = new Matches($arr, $inputValue);
$finalArr = $matches->getfinalArr();
$syllables = new Syllables($finalArr);
echo $syllables->getResult();
