<?php
// File: docbook-programlistings.php

// DOM notices are normal; report only warnings and above
ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);

if ($argc < 2) {
    fwrite(STDERR, "Missing file argument\n");
    exit(1);
}

$file = $argv[1];
if (!file_exists($file)) {
    fwrite(STDERR, "Argument passed is not a file\n");
    exit(1);
}

$doc                     = new DOMDocument();
$doc->xmlVersion         = "1.0";
$doc->encoding           = "utf-8";
$doc->preserveWhitespace = true;
$doc->formatOutput       = true;

if (!$doc->load($file)) {
    fwrite(STDERR, "$file: UNABLE TO LOAD FILE!\n");
    exit(1);
}

$changed = false;
foreach ($doc->getElementsByTagName('programlisting') as $node) {
    $content = $node->textContent;
    $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
    $node->textContent = '';
    $node->nodeValue   = '';
    $cdata = $doc->createCDATASection($content);
    $node->appendChild($cdata);
    $changed = true;
}

if (!$changed) {
    exit(0);
}

$doc->save($file);
