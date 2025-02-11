<?php
    function check_format_date( string $date )
    {
        $date_arr = explode('.', $date);
        if ( count($date_arr) != 3 ) {
            return false;
        }
        $day   = intval($date_arr[0]);
        $month = intval($date_arr[1]);
        $year  = intval($date_arr[2]);
        $check = checkdate($month, $day, $year);
        return $check;
    }
    // function check_future_date ( string $date )
    // {
    //     $tomorrow_ts = strtotime("+1 day", date('Y-m-d'));
    //     $date_ts = strtotime($date);
    //     return $date_ts < $tomorrow_ts;
    // }
    function declension ( int $digit, array $expr, $onlyword = false ) {
        if ( !is_array($expr) ) {
            $expr = array_filter(explode(' ', $expr));
        }
        if ( empty($expr[2]) ) {
            $expr[2] = $expr[1];
        }
        $i = preg_replace('/[^0-9]+/s', '', $digit) % 100;
        if ( $onlyword ) {
            $digit = '';
        }
        if ( $i >= 5 && $i <= 20 ) {
            $res = $expr[2];
        } else {
            $i %= 10;
            if ($i == 1) {
                $res = $expr[0];
            } elseif ($i >= 2 && $i <= 4) {
                $res = $expr[1];
            } else {
                $res = $expr[2];
            }
        }
        $res = $digit . ' ' . $res;
        return trim($res);
    }
?>