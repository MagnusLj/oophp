<?php

namespace Malm18\Content;

$xContent = new Content();

if (!$resultset) {
    echo ("No resultset");
    return;
}
?>


<form method="post">
    <fieldset>
    <legend>Redigera</legend>
    <input type="hidden" name="contentId" value="<?= $xContent->esc($resultset->id) ?>"/>

    <p>
        <label>Titel:<br>
        <input type="text" name="contentTitle" value="<?= $xContent->esc($resultset->title) ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br>
        <input type="text" name="contentPath" value="<?= $xContent->esc($resultset->path) ?>"/>
    </p>

    <p>
        <label>Slug:<br>
        <input type="text" name="contentSlug" value="<?= $xContent->esc($resultset->slug) ?>"/>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="contentData"><?= $xContent->esc($resultset->data) ?></textarea>
     </p>

     <p>
         <label>Typ:<br>
         <input type="text" name="contentType" value="<?= $xContent->esc($resultset->type) ?>"/>
     </p>

     <p>
         <label>Filter:<br>
         <input type="text" name="contentFilter" value="<?= $xContent->esc($resultset->filter) ?>"/>
     </p>

     <p>
         <label>Publicera:<br>
         <input type="datetime" name="contentPublish" value="<?= $xContent->esc($resultset->published) ?>"/>
     </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Spara</button>
        <!-- <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button> -->
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Ta bort</button>
    </p>
    </fieldset>
</form>
