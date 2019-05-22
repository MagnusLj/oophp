<?php

namespace Malm18\MyTextFilter;

// Include essentials
require __DIR__ . "/../src/config.php";
require __DIR__ . "/../vendor/autoload.php";


$aFilter = new MyTextFilter();

$text = file_get_contents(__DIR__ . "/../text/nl2br.txt");
$html = $aFilter->nl2br($text);
$filter = "link";
$filter2 = $aFilter->showFilter($filter);


?><!doctype html>
<html>
<meta charset="utf-8">
<style>body {width: 700px;}</style>
<title>Show off nl2br</title>

<h2>Show filter</h2>
<pre><?= wordwrap(htmlentities($filter2)) ?></pre>

<h1>Showing off nl2br</h1>

<h2>Source in nl2br.txt</h2>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h2>Filter nl2br applied, source</h2>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h2>Filter nl2br applied, HTML (including nl2br())</h2>
<?= nl2br($html) ?>
