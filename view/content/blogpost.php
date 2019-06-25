<?php

namespace Malm18\Content;

$xContent = new Content();

?>

<article>
    <header>
        <h1><?= $xContent->esc($resultset->title) ?></h1>
        <p><i>Published: <time datetime="<?= $xContent->esc($resultset->published_iso8601) ?>" pubdate><?= $xContent->esc($resultset->published) ?></time></i></p>
    </header>
    <?= $xContent->esc($resultset->data) ?>
</article>
