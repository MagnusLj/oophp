<?php

namespace Malm18\Content;

$xContent = new Content();

$xFilter = new MyTextFilter();

$data = $xContent->esc($resultset->data);

if ($resultset->filter ?? null) {
    $filterarray = explode(",",$resultset->filter);
    // print_r($filterarray);
    foreach ($filterarray as $filter) {
        // echo ("<br>" . $filter . "<br>");
        $data = $xFilter->parse($data, [$filter]);
    }
}

// else {
//     $data = $xContent->esc($resultset->data);
// }

// print_r($data);

?>

<article>
    <header>
        <h1><?= $xContent->esc($resultset->title) ?></h1>
        <p><i>Published: <time datetime="<?= $xContent->esc($resultset->published_iso8601) ?>" pubdate><?= $xContent->esc($resultset->published) ?></time></i></p>
    </header>
    <?= $data ?>
</article>

<!-- $html = $aFilter->parse($text, ["link"]); -->
