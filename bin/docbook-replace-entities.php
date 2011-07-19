<?php
// File: docbook-replace-entities.php
if ($argc < 2) {
    fwrite(STDERR, "Missing file argument\n");
    exit(1);
}

$file = $argv[1];
if (!file_exists($file)) {
    fwrite(STDERR, "Argument passed is not a file\n");
    exit(1);
}

$xml = file_get_contents($file);

// Check if we have a doctype, and, if so, place it in a separate file and 
// strip it from this one
$transformed = preg_replace_callback(
    '#(<!(DOCTYPE .*?)(]>))#s', 
    function ($matches) use ($file) {
        $content = $matches[1];
        $filename = $file . '.entities';
        file_put_contents($filename, $content);
        return '';
    },  
    $xml
);

// Replace all entities with tokenized versions
$transformed = preg_replace('/\&([a-zA-Z][a-zA-Z0-9._-]+;)/', '[amp]$1', $transformed);

// If no transformations have been made, exit early
if ($transformed == $xml) {
    exit(0);
}

// Write the changes back to the file
file_put_contents($file, $transformed);
