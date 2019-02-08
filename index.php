<?php

include 'Matches.php';
include 'Syllables.php';

$matches = new Matches();
$finalArr = $matches->getfinalArr();
$syllables = new Syllables($finalArr);
echo $syllables->getResult();