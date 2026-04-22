<?php

namespace App\Services\LamTeknik\V2;

class Service2
{
    public function s2_1sub($I, $II)
    {
        return (($I * 2) + $II) / 3;
    }

    public function s2_2sub($I, $II)
    {
        return ($I + (2 * $II)) / 3;
    }

    public function s2_3subkomI($N1, $N2, $N3, $NDTPS, $strata)
    {
        if ($strata == "D4") {
            $a = 3;
            $b = 2;
            $c = 1;
        } else if ($strata == "S1") {
            $a = 3;
            $b = 2;
            $c = 1;
        } else if ($strata == "S2") {
            $a = 3;
            $b = 2;
            $c = 1;
        } else {
            // S3 dsb
            $a = 3;
            $b = 2;
            $c = 1;
        }

        $bRK = 4;
        $RK = (($N1 + $N2 + $N3) / $NDTPS);

        if ($RK >= $bRK) {
            $skor = 4;
        } else {
            $skor = $RK;
        }

        return ($skor);
    }

    public function s2_3subkomII($NI, $NN, $NW, $strata)
    {
        if ($strata == "D4") {
            $a = 2;
            $b = 6;
            $c = 8;
        } else if ($strata == "S1") {
            $a = 2;
            $b = 6;
            $c = 8;
        } else if ($strata == "S2") {
            $a = 2;
            $b = 6;
            $c = 8;
        } else {
            // S3 dsb
            $a = 3;
            $b = 8;
            $c = 10;
        }

        $RI = ($NI >= $a && $NN < $b) ? $a : $NI;
        $RN = ($NN >= $b && $NI < $a) ? $b : $NN;
        $RL = ($NW >= $c) ? $c : $NW;

        $A = $RI / $a;
        $B = $RN / $b;
        $C = $RL / $c;

        $s1 = ($RI > $a && $RN > $b) ? "YES" : "NO";
        $s2 = (($RI > 0 && $RI <= $a) || ($RN > 0 && $RN <= $b) || ($RL > 0 && $RL <= $c)) ? "YES" : "NO";

        if ($s1 == "YES") {
            $skor = 4;
        } elseif ($s2 == "YES") {
            $skor = 3.75 *
                (($A + $B + ($C / 2)) -
                    ($A * $B) -
                    ($A * $C / 2) -
                    ($B * $C / 2) +
                    ($A * $B * $C / 2));
        } else {
            $skor = 0;
        }

        return ($skor);
    }

    public function s2_3sub($I, $II)
    {
        return ($I + (2 * $II)) / 3;
    }
}
