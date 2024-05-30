<?php

function convertCurrencyFormat($num) {
    // ubah yang angka 0 kalau mau ada desimalnya
    return number_format($num, 0, ',', '.');
}


function convertDateFormat($date, $show_days = true)
{
    $days_name  = array(
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
    );
    $months_name = array(1 =>
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $years   = substr($date, 0, 4);
    $months   = $months_name[(int) substr($date, 5, 2)];
    $dates = substr($date, 8, 2);
    $text    = '';

    if ($show_days) {
        $format = date('w', mktime(0,0,0, substr($date, 5, 2), $dates, $years));
        $days = $days_name[$format];
        $text .= "$days, $dates $months $years";
    } else {
        $text .= "$dates $months $years";
    }

    return $text;
}
