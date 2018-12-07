<?php

include ('words.php');

function trans($word) {

    if (isset($GLOBALS["messages"][LANGUAGE][$word])) {
        return $GLOBALS["messages"][LANGUAGE][$word];
    }

    return $word;
}