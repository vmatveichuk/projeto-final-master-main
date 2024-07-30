<?php
function randon_pass()
{
    $seed = str_split('abcdefghijkmnopqrstuvwxyz'
        . 'ABCDEFGHJKLMNOPQRSTUVWXYZ'
        . '0123456789'); // and any other characters
    shuffle($seed); // probably optional since array_is randomized; this may be redundant
    $rand = '';
    foreach (array_rand($seed, 10) as $k) $rand .= $seed[$k];
    return $rand;
}