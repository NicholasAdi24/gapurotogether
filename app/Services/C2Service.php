<?php

namespace App\Services;

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

    public function c24dsubkoma($N1, $N2, $N3, $NDT, $strata)
    {
        if($strata == "D4") {
            $a = 3; $b = 1; $c = 2;
        } else if($strata == "S2") {
            $a = 2; $b = 4; $c = 0;
        } else if($strata == "S3") {
            $a = 2; $b = 4; $c = 0;
        }else {
            // S1 dsb
            $a = 3; $b = 2; $c = 1;
        }

        $brk = 4;
        if ($NDT > 0) {
            $RK = (($a * $N1) + ($b * $N2) + ($c * $N3)) / $NDT;
        } else {
            $RK = 0;
        }

        if ($RK > $brk) {
            $skor = 4;
        } else {
            $skor = $RK;
        }
        return $skor;
    }

    public function c24dsubkomb($NI, $NN, $NW, $strata)
    {
        if($strata == "D4") {
            $a = 2; $b = 6; $c = 9;
        } else if($strata == "S2") {
            $a = 3; $b = 9; $c = 12;
        } else if($strata == "S3") {
            $a = 4; $b = 9; $c = 12;
        }else {
            // S1 dsb
            $a = 2; $b = 6; $c = 9;
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
