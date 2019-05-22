<?php

namespace Malm18\MyTextFilter;

// Include essentials
require __DIR__ . "../../../src/config.php";
require __DIR__ . "../../../vendor/autoload.php";


$aFilter = new MyTextFilter();

$text = file_get_contents(__DIR__ . "../../../text/clickable.txt");
$text2 = file_get_contents(__DIR__ . "../../../text/bbcode.txt");
$text3 = file_get_contents(__DIR__ . "../../../text/nl2br.txt");
$text4 = file_get_contents(__DIR__ . "../../../text/sample.md");

$html = $aFilter->parse($text, ["link"]);
$html2 = $aFilter->parse($text2, ["bbcode"]);
$html3 = $aFilter->parse($text3, ["nl2br"]);
$html4 = $aFilter->parse($text4, ["markdown"]);

?><!doctype html>
<html>
<meta charset="utf-8">
<!-- <style>body {width: 700px;}</style> -->
<title>Show off filters | oophp</title>

<h1>Showing off Clickable</h1>

<h2>Source in clickable.txt</h2>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h2>Source formatted as HTML</h2>
<?= $text ?>

<h2>Filter Clickable applied, source</h2>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h2>Filter Clickable applied, HTML</h2>
<?= $html ?>


<h1>Showing off BBCode</h1>

<h2>Source in bbcode.txt</h2>
<pre><?= wordwrap(htmlentities($text2)) ?></pre>

<h2>Filter BBCode applied, source</h2>
<pre><?= wordwrap(htmlentities($html2)) ?></pre>

<h2>Filter BBCode applied, HTML (including nl2br())</h2>
<?= nl2br($html2) ?>


<h1>Showing off nl2br</h1>

<h2>Source in nl2br.txt</h2>
<pre><?= wordwrap(htmlentities($text3)) ?></pre>

<h2>Filter nl2br applied, source</h2>
<pre><?= wordwrap(htmlentities($html3)) ?></pre>

<h2>Filter nl2br applied, HTML</h2>
<?= $html3 ?>


<h1>Showing off Markdown</h1>

<h2>Markdown source in sample.md</h2>
<pre><?= $text4 ?></pre>

<h2>Text formatted as HTML source</h2>
<pre><?= htmlentities($html4) ?></pre>

<h2>Text displayed as HTML</h2>
<?= $html4 ?>
