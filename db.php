<?php

    include 'php/Population/Populate.php';

    $awe = new Populate('csv/random-name.csv', 'csv/random-surname.csv');
    $awe->getRandomAlias();