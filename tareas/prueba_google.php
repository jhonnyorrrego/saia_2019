 <body>
    <?php

    // build feed URL
    $feedURL = "http://www.google.com/calendar/feeds/dhemian@gmail.com/private-dc75f64292569547e35189b22f95300b/basic";

    // read feed into SimpleXML object
    $sxml = simplexml_load_file($feedURL);

    // get number of events
    /*$counts = $sxml->children('http://a9.com/-/spec/opensearchrss/1.0/');
    $total = $counts->totalResults;*/
    ?>
    <ol>
    <?php
    // iterate over entries in category
    // print each entry's details
    print_r($sxml);
    $arreglo=array();
    foreach ($sxml->entry as $entry) {
      $title = stripslashes($entry->title);
      $summary = stripslashes($entry->summary);
      $cadena='{"allDay":true,"className":"google","title":"'.$summary.'","url":"#"}';
      array_push($arreglo,$cadena);
    }
    print_r($arreglo);
    ?>
    </ol>
  </body>
</html>




