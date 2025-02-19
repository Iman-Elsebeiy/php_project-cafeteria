<?php

function dd($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";

    die();
}