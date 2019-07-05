<?php

namespace Malm18\Content;

$xContent = new Content();

if (!$resultset) {
    echo ("No resultset");
    return;
}
?>

<article>
<h1>Blogg</h1>

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="?route=<?= $xContent->esc($row->slug) ?>"><?= $xContent->esc($row->title) ?></a></h1>
        <p><i>Publicerad: <time datetime="<?= $xContent->esc($row->published_iso8601) ?>" pubdate><?= $xContent->esc($row->published) ?></time></i></p>
    </header>
    <?= $xContent->esc($row->data) ?>
</section>
<?php endforeach; ?>

</article>
