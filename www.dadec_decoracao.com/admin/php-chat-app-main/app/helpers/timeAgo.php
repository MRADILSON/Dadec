<?php
// app/ajax/update_last_seen.php

// setting up the time Zone
// It Depends on your location or your P.c settings
define('TIMEZONE', 'Africa/Luanda');
date_default_timezone_set(TIMEZONE);

function last_seen($timestamp) {
    $time_ago = strtotime($timestamp);
    $current_time = time();
    $time_difference = $current_time - $time_ago;

    if ($time_difference < 60) {
        return "Active";
    } else if ($time_difference >= 60 && $time_difference < 3600) {
        $minutes = round($time_difference / 60);
        return "há $minutes minutos";
    } else if ($time_difference >= 3600 && $time_difference < 86400) {
        $hours = round($time_difference / 3600);
        return "há $hours horas";
    } else {
        return date("d/m/Y H:i", $time_ago);
    }
}


