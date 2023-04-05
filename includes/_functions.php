<?php

// debug var and die
function dd($var = null)
{
    if (is_null($var)) {
        die();
    }
    echo "dd =>";
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die();
}

// debug var and continue
function dump($var)
{
    echo "dump =>";
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
