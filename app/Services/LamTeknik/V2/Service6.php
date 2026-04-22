<?php

namespace App\Services\LamTeknik\V2;

class Service6
{
    // S1 D4
    public function s6_2($NPkMhm, $NPkD, $strata)
    {
        if ($strata == "D4") {
            $b = 0.25;
        } else if ($strata == "S1") {
            $b = 0.5;
        } else if ($strata == "S2") {
            $b = 0.25;
        } else {
            // S3 
            $b = 0.5;
        }

        if ($NPkD > 0) {
            $PKDMhs = $NPkMhm / $NPkD;
        } else {
            $PKDMhs = 0.00;
        }

        if ($PKDMhs >= $b) {
            $skor = 4;
        } else {
            if ($strata == "D4") {
                $skor = 2 + (8 * $PKDMhs);
            } else if ($strata == "S1") {
                $skor = 1 + (6 * $PKDMhs);
            } else if ($strata == "S2") {
                $skor = 1 + (6 * $PKDMhs);
            } else {
                // S3 
                $skor = 1 + (6 * $PKDMhs);
            }
        }

        return $skor;
    }
}
