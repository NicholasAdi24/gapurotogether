<?php

namespace App\Services;

class C5Service
{
    public function c54a1($BOP, $NM, $strata)
    {

        if ($strata == "D4") {
            $b = 20000000;
        } else if ($strata == "S2") {
            $b = 28000000;
        } else if ($strata == "S3") {
            $b = 40000000;
        } else {
            // S1 dsb
            $b = 20000000;
        }
        if ($NM > 0) {
            $DOP = $BOP / 3 / $NM;
        } else {
            $DOP = 0;
        }

        if ($DOP >= $b) {
            $skor = 4;
        } else {
            $skor = 4 / $b * $DOP;
        }
        return $skor;
    }

    public function c54a2($DP, $NDTPS, $strata)
    {
        if ($strata == "D4") {
            $b = 10000000;
        } else if ($strata == "S2") {
            $b = 20000000;
        } else if ($strata == "S3") {
            $b = 30000000;
        } else {
            // S1 dsb
            $b = 10000000;
        }
        if ($NDTPS > 0) {
            $DPD = $DP / 3 / $NDTPS;
        } else {
            $DPD = 0;
        }

        if ($DPD >= $b) {
            $skor = 4;
        } else {
            $skor = 4 / $b * $DPD;
        }
        return $skor;
    }

    public function c54a3($DPKM, $NDTPS)
    {
        $b = 5000000;

        if ($NDTPS > 0) {
            $DPKMD = $DPKM / 3 / $NDTPS;
        } else {
            $DPKMD = 0;
        }

        if ($DPKMD >= $b) {
            $skor = 4;
        } else {
            $skor = 4 / $b * $DPKMD;
        }
        return $skor;
    }

    // Not Fixed
    public function c54a4ckomp(array $data, $c54a4, $strata)
    {
        $c44a1 = $data['c44a1'];
        $c44a2 = $data['c44a2'];
        $c44a3 = $data['c44a3'];
        $c44a4 = $data['c44a4'];
        $c44a5 = $data['c44a5'];
        $c44a6 = $data['c44a6'];
        $c44a7 = $data['c44a7'];
        if ($strata == "S2" || $strata == "S3" || $strata == "PROFESI") {
            $b = 5;
        } else {
            $b = 7;
        }

        $calculate = ($c44a1 + $c44a2 + $c44a3 + $c44a4 + $c44a5 + $c44a6 + $c44a7) / $b;
        if ($calculate >= 3.5) {
            $skor = 4;
        } else {
            $skor = $c54a4;
        }
        return $skor;
    }
}
