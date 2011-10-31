<?php

$date1 = new DateTime('2011-10-14');
$date2 = new DateTime(date("Y-m-d"));
$long = $date1->getTimestamp()-$date2->getTimestamp();
$long = ($long/(60*60*24))+1;
?>
