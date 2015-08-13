<?php

// Change this with your Google calendar feed
$calendarURL = 'http://www.google.com/calendar/feeds/dhemian@gmail.com/private-dc75f64292569547e35189b22f95300b/basic';

// Nothing else to edit
$feed = file_get_contents($calendarURL);
header('Content-type: text/xml');
echo $feed;

?>