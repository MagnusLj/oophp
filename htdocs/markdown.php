<?php

// use Michelf\MarkdownExtra;
namespace Malm18\MyTextFilter;


// Include essentials
require __DIR__ . "/../src/config.php";
require __DIR__ . "/../vendor/autoload.php";
// include(__DIR__ . "/../src/MyTextFilter/MyTextFilter.php");

//use Michelf\MarkdownExtra;

$aFilter = new MyTextFilter();

$text = file_get_contents(__DIR__ . "/../text/sample.md");
$html = $aFilter->markdown($text);


?><!doctype html>
<html>
<meta charset="utf-8">
<title>Show off Markdown</title>

<h1>Showing off Markdown</h1>

<h2>Markdown source in sample.md</h2>
<pre><?= $text ?></pre>

<h2>Text formatted as HTML source</h2>
<pre><?= htmlentities($html) ?></pre>

<h2>Text displayed as HTML</h2>
<?= $html ?>
