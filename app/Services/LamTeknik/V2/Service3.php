<?php

namespace App\Services\LamTeknik\V2;

class Service3
{
    public function s3_2($BOP, $NM, $strata)
    {
        if ($strata == "D4") {
            $b = 20000000;
        } else if ($strata == "S1") {
            $b = 20000000;
        } else if ($strata == "S2") {
            $b = 28000000;
        } else {
            // S3 dsb
            $b = 40000000;
        }

        if ($NM > 0) {
            $DOP = $BOP / $NM;
        } else {
            $DOP = 0;
        }

        if ($DOP >= $b) {
            $skor = 4;
        } else {
            if ($strata == "S2") {
                $skor = $DOP / 7000000;
            } else if ($strata == "S3") {
                $skor = $DOP / 10000000;
            } else {
                // S1 D4
                $skor = $DOP / 5000000;
            }
        }

        return ($skor);
    }

    public function s3_3($DP, $NDTPS, $strata)
    {
        if ($strata == "D4") {
            $b = 10000000;
        } else if ($strata == "S1") {
            $b = 10000000;
        } else if ($strata == "S2") {
            $b = 20000000;
        } else {
            // S3 dsb
            $b = 30000000;
        }

        if ($NDTPS > 0) {
            $DPD = $DP / $NDTPS;
        } else {
            $DPD = 0;
        }

        if ($DPD >= $b) {
            $skor = 4;
        } else {
            // Akses properti 
            if ($strata == "D4") {
                $skor = (2 * $DPD) / 5000000;
            } else if ($strata == "S1") {
                $skor = (2 * $DPD) / 5000000;
            } else if ($strata == "S2") {
                $skor = (2 * $DPD) / 10000000;
            } else {
                $skor = (2 * $DPD) / 15000000;
            }
        }



        return ($skor);
    }

    public function s3_4($DPKM, $NDTPS)
    {
        $b = 5000000;

        if ($NDTPS > 0) {
            $DPKMD = $DPKM / $NDTPS;
        } else {
            $DPKMD = 0;
        }

        if ($DPKMD >= $b) {
            $skor = 4;
        } else {
            $skor = 4 * $DPKMD / $b;
        }

        return ($skor);
    }
}
