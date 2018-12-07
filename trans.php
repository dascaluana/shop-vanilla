<?php

include ('words.php');

/**
 *
 *
 * @param $word
 * @return trabs
 */
function trans($word)
{

    if (isset($GLOBALS["messages"][LANGUAGE][$word])) {
        return $GLOBALS["messages"][LANGUAGE][$word];
    }

    return $word;
}

/**
 * @param $word
 * @return string
 */
function protect($word)
{

    $word = trans($word);

    return htmlspecialchars($word, ENT_QUOTES);
}

function stripTags($word)
{

    return strip_tags($word);
}