<?php

namespace Malm18\Content;

$xContent = new Content();

?>

<article>
    <header>
        <h1><?= $xContent->esc($resultset->title) ?></h1>
        <p><i>Latest update: <time datetime="<?= $xContent->esc($resultset->modified_iso8601) ?>" pubdate><?= $xContent->esc($resultset->modified) ?></time></i></p>
    </header>
    <?= $xContent->esc($resultset->data) ?>
</article>
