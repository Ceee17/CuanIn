<?php

/**
 * Generates a product code with leading zeros based on the given value and threshold.
 */
function generate_product_code($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}
