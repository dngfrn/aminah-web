<?php

if (!function_exists('format_number')) {
    /**
     * Format number with dots as thousand separators and remove decimal places.
     *
     * @param float|int $number
     * @return string
     */
    function format_number($number) {
        // Convert to number format with no decimal places and comma as thousand separator
        return number_format($number, 0, ',', '.');
    }
}


function remove_trailing_zeros($number) {
    // Convert number to string
    $numberStr = (string)$number;

    // Check if the number ends with ".00" and remove it
    if (strpos($numberStr, '.00') !== false) {
        $numberStr = str_replace('.00', '', $numberStr);
    }

    return $numberStr;
}
