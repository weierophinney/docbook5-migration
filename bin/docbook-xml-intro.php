<?php
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
if (0 !== strpos($xml, '<?xml')) {
    $xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n" . $xml;
    // echo "Writing file " . $file . "\n";
    file_put_contents($file, $xml);
}
