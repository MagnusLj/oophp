<?php

namespace Malm18\MyTextFilter;

// Include essentials
require __DIR__ . "/../src/config.php";
require __DIR__ . "/../vendor/autoload.php";


$aFilter = new MyTextFilter();

$text = file_get_contents(__DIR__ . "/../text/bbcode.txt");
$html = $aFilter->bbcode2html($text);


?><!doctype html>
<html>
<meta charset="utf-8">
<style>body {width: 700px;}</style>
<title>Show off BBCode</title>

<h1>Showing off BBCode</h1>

<h2>Source in bbcode.txt</h2>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h2>Filter BBCode applied, source</h2>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h2>Filter BBCode applied, HTML (including nl2br())</h2>
<?= nl2br($html) ?>
