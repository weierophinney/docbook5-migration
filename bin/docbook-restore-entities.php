<?php
// File: docbook-restore-entities.php
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

// Restore tokens with actual entities
$transformed = preg_replace('/\[amp\]([a-zA-Z][a-zA-Z0-9._-]+;)/', '&$1', $xml);

// Check if we have an entities file
$entitiesFile = $file . '.entities';
if (file_exists($entitiesFile)) {
    // If so, insert the entities
    $entities = file_get_contents($entitiesFile);
    if (preg_match('#^<\?xml[^?]*\?>#', $transformed)) {
        // If the file has an opening XML declaration, put the DOCTYPE/entities 
        // following it
        $transformed = preg_replace('#^(<\?xml[^?]*\?>)#', '$1' . "\n" . $entities, $transformed);
    } else {
        // Otherwise, just prepend them
        $transformed = $entities . "\n" . $transformed;
    }

    // Remove entities file when done
    unlink($entitiesFile);
}

// If no transformations have been made, we can simply exit
if ($transformed == $xml) {
    exit(0);
}

// Write changes to disk
file_put_contents($file, $transformed);
