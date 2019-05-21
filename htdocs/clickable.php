<?php

namespace Malm18\MyTextFilter;

// Include essentials
require __DIR__ . "/../src/config.php";
require __DIR__ . "/../vendor/autoload.php";


$aFilter = new MyTextFilter();

$text = file_get_contents(__DIR__ . "/../text/bbcode.txt");
$html = $aFilter->makeClickable($text);


?><!doctype html>
<html>
<meta charset="utf-8">
<style>body {width: 700px;}</style>
<title>Show off Clickable</title>

<h1>Showing off Clickable</h1>

<h2>Source in clickable.txt</h2>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h2>Source formatted as HTML</h2>
<?= $text ?>

<h2>Filter Clickable applied, source</h2>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h2>Filter Clickable applied, HTML</h2>
<?= $html ?>
