<?php

function generate_product_code($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}
