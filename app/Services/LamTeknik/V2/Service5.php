<?php

namespace App\Services\LamTeknik\V2;

class Service5
{
    public function s5_2($NPMhs, $NPD, $strata)
    {
        if ($strata == "D4") {
            $b = 0.25;
        } else if ($strata == "S1") {
            $b = 0.50;
        } else if ($strata == "S2") {
            $b = 0.75;
        } else {
            // S3 
            $b = 1;
        }

        if ($NPD > 0) {
            $PPDMhs = $NPMhs / $NPD;
        } else {
            $PPDMhs = 0;
        }

        if ($PPDMhs >= $b) {
            $skor = 4;
        } else {
            if ($strata == "D4") {
                $skor = 2 + (8 * $PPDMhs);
            } else if ($strata == "S1") {
                $skor = 1 + (6 * $PPDMhs);
            } else if ($strata == "S2") {
                $skor = 1 + (4 * $PPDMhs);
            } else {
                // S3 
                $skor = 1 + (3 * $PPDMhs);
            }
        }

        return $skor;
    }

    public function s5_3m($NTM, $NPD, $strata)
    {
        if ($strata == "S2") {
            $b = 0.25;
        } else {
            // S3
            $b = 0.50;
        }

        if ($NPD > 0) {
            $PPTMhs = ($NTM / $NPD);
        } else {
            $PPTMhs = 0;
        }

        if ($PPTMhs >= $b) {
            $skor = 4;
        } else {
            if ($strata == "S2") {
                $skor = 1 + (12 * $PPTMhs);
            } else {
                // S3
                $skor = 1 + (6 * $PPTMhs);
            }
        }

        return $skor;
    }
}
