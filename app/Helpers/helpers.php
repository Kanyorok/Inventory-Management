<?php

function format_money($money)
{
    if(!$money) {
        return "Ksh. 0.00";
    }

    $money = number_format($money, 2);

    if(strpos($money, '-') !== false) {
        $formatted = explode('-', $money);
        return "-Ksh. $formatted[1]";
    }

    return "Ksh. $money";
}