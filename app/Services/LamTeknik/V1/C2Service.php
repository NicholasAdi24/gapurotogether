<?php

namespace App\Services\LamTeknik\V1;

class C2Service
{
    public function c24asub($a, $b)
    {
        return ($a + (2 * $b)) / 3;
    }

    public function c24bsub($a, $b)
    {
        return ($a + (2 * $b)) / 3;
    }

    public function c24dsubkoma($N1, $N2, $N3, $NDTPS, $strata)
    {
        if ($strata == "D4") {
            $a = 3;
            $b = 1;
            $c = 2;
        } else if ($strata == "S2") {
            $a = 3;
            $b = 2;
            $c = 1;
        } else if ($strata == "S3") {
            $a = 3;
            $b = 2;
            $c = 1;
        } else {
            // S1 dsb
            $a = 3;
            $b = 2;
            $c = 1;
        }

        $brk = 4;
        if ($NDTPS > 0) {
            $KK = (($a * $N1) + ($b * $N2) + ($c * $N3)) / $NDTPS; // ga tau kenapa pakai $RK padahal dirumus excel KK
        } else {
            $KK = 0;
        }

        if ($KK > $brk) {
            $skor = 4;
        } else {
            $skor = $KK;
        }
        return $skor;
    }

    public function c24dsubkomb($NI, $NN, $NW, $strata)
    {
        if ($strata == "D4") {
            $a = 2;
            $b = 6;
            $c = 8;
        } else if ($strata == "S2") {
            $a = 2;
            $b = 6;
            $c = 8;
        } else if ($strata == "S3") {
            $a = 3;
            $b = 8;
            $c = 10;
        } else {
            // S1 dsb
            $a = 2;
            $b = 6;
            $c = 8;
        }
        if ($NI >= $a) {
            $skor = 4;
        } else if ($NI < $a && $NN >= $b) {
            $skor = 3 + ($NI / $a);
        } else if ((0 < $NI && $NI < $a) && (0 < $NN && $NN < $b)) {
            $skor = 2 + (2 * $NI / $a) + ($NN / $b) - (($NI * $NN) / ($a * $b));
        } else if ($NI == 0 && $NN == 0 && $NW >= $c) {
            $skor = 2;
        } else {
            $skor = 2 * $NW / $c;
        }
        return $skor;
    }
    public function c24d($a, $b)
    {
        return ((2 * $a) + $b) / 3;
    }
}
