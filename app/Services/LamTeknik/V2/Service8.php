<?php

namespace App\Services\LamTeknik\V2;

class Service8
{
    public function s8_1sub($I, $II)
    {
        return ($I +  $II) / 2;
    }

    public function s8_3($NM, $NDTPS, $strata)
    {
        $RMD = $NM / $NDTPS;
        $s1 = ($RMD < 15) ? "YES" : "NO";
        $s2 = ($RMD >= 15 && $RMD <= 25) ? "YES" : "NO";

        if ($strata == "D4") {
            $s3 = ($RMD > 25 && $RMD < 35) ? "YES" : "NO";
        } else if ($strata == "S1") {
            $s3 = ($RMD > 25 && $RMD <= 35) ? "YES" : "NO";
        }

        $A = ($NDTPS - 5) / 7;
        if ($s1 === "YES") {
            $B = $RMD / 15;
        } elseif ($s2 === "YES") {
            $B = 1;
        } elseif ($s3 === "YES") {
            $B = (35 - $RMD) / 10;
        } else {
            $B = 0;
        }

        $s4 = ($RMD >= 15 && $RMD <= 25 && $NDTPS >= 12) ? "YES" : "NO";
        $s5 = ($NDTPS >= 5 && $NDTPS < 12 && $RMD <= 35) ? "YES" : "NO";
        $s6 = ($NDTPS >= 12 && ($RMD < 15 || ($RMD > 25 && $RMD <= 35))) ? "YES" : "NO";
        $s7 = ($RMD >= 35) ? "YES" : "NO";

        if ($strata == "D4") {
            if ($s2 === "YES") {
                $skor = 4;
            } elseif ($s1 === "YES") {
                $skor = (4 * $RMD) / 15;
            } elseif ($s3 === "YES") {
                $skor = (70 - (2 * $RMD)) / 5;
            } elseif ($s7 === "YES") {
                $skor = 0;
            } else {
                $skor = 0;
            }
        } else if ($strata == "S1") {
            if ($s4 === "YES") {
                $skor = 4;
            } elseif ($s5 === "YES") {
                $skor = 1 + (3 * $A * $B);
            } elseif ($s6 === "YES") {
                $skor = 1 + (3 * $B);
            } elseif ($s7 === "YES") {
                $skor = 0;
            } else {
                $skor = 0;
            }
        }


        return $skor;
    }
}
