<?php

function convertCurrencyFormat($num)
{
    // ubah yang angka 0 kalau mau ada desimalnya
    return number_format($num, 0, ',', '.');
}


/**
 * Converts a date string into a human-readable format.
 *
 * @param string $date The date string in 'YYYY-MM-DD' format.
 * @param bool $show_days Whether to include the day of the week in the output. Default is true.
 *
 * @return string The formatted date string.
 *
 * @throws Exception If the input date string is not in the correct format.
 */
function convertDateFormat($date, $show_days = true)
{
    $days_name  = array(
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
    );
    $months_name = array(
        1 =>
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    // Extract year, month, and date from the input date string
    $years   = substr($date, 0, 4);
    $months   = $months_name[(int) substr($date, 5, 2)];
    $dates = substr($date, 8, 2);
    $text    = '';

    // If $show_days is true, include the day of the week in the output
    if ($show_days) {
        $format = date('w', mktime(0, 0, 0, substr($date, 5, 2), $dates, $years));
        $days = $days_name[$format];
        $text .= "$days, $dates $months $years";
    } else {
        $text .= "$dates $months $years";
    }

    // Validate the input date string format
    if (!checkdate((int) substr($date, 5, 2), (int) substr($date, 8, 2), (int) substr($date, 0, 4))) {
        throw new Exception("Invalid date format. Expected 'YYYY-MM-DD'.");
    }

    return $text;
}
