<?php

$loads = scandir(__DIR__);

if ($loads)
    foreach ($loads as $value) {
        $ext = explode('.', $value);

        if ($value !== 'autoload.php' && $ext[sizeof($ext)-1] === 'php')
            require __DIR__."/$value";
    }
