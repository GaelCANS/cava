<?php

namespace App\Libraries;

class Quarter
{

    public static function getQuarter($quarter)
    {
        $year = date('Y');
        switch ($quarter) {
            case 1:
                $carbon = new \Carbon\Carbon('first day of January '.$year);
                break;
            case 2:
                $carbon = new \Carbon\Carbon('first day of April '.$year);
                break;
            case 3:
                $carbon = new \Carbon\Carbon('first day of July '.$year);
                break;
            case 4:
                $carbon = new \Carbon\Carbon('first day of October '.$year);
                break;
        }
        return $carbon;
    }
}