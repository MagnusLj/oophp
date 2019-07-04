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

// print_r($filterarray);

?>

<article>
    <header>
        <h1><?= $xContent->esc($resultset->title) ?></h1>
        <p><i>Latest update: <time datetime="<?= $xContent->esc($resultset->modified_iso8601) ?>" pubdate><?= $xContent->esc($resultset->modified) ?></time></i></p>
    </header>
    <?= $data ?>
</article>
