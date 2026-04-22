<?php

namespace App\Services\LamTeknik\V2;

class Service4
{
    public function s4_2sub($I, $II)
    {
        return (($I + $II) / 2);
    }

    public function s4_3sub($I, $II)
    {
        return (($I + $II) / 2);
    }

    public function s4_4msub($I, $II, $III)
    {
        return (($I + (2 * $II) + (2 * $III)) / 5);
    }

    public function s4_5sub($I, $II)
    {
        return ($I + (2 * $II)) / 3;
    }

    public function s4_6sub($I, $II)
    {
        return (($I + $II) / 2);
    }

    public function s4_8($JP, $JB, $strata)
    {
        if ($strata == "D4") {
            $b1 = 0.5;
            $b2 = 0.7;
        } else {
            // S1
            $b1 = 0.2;
            $b2 = 0.5;
        }

        if ($JB > 0) {
            $PJP = $JP / $JB;
        } else {
            $PJP = 0;
        }

        if ($PJP >= 0 && $PJP < $b1) {
            if ($strata == "D4") {
                $skor = 1 + (6 * $PJP);
            } else {
                // S1
                $skor = 20 * $PJP;
            }
        } else if ($PJP <= $b2) {
            $skor = 4;
        } else if ($PJP > $b2) {
            if ($strata == "D4") {
                $skor = 4 - (((40 * $PJP) - 28) / 3);
            } else {
                // S1
                $skor = 8 - (8 * $PJP);
            }
        } else {
            $skor = 0;
        }

        return ($skor);
    }

    public function s4_9($NA, $strata)
    {

        if ($strata == "D4") {
            if ($NA >= 4) {
                $skor = 4;
            } else if ($NA == 3) {
                $skor = 3;
            } else if ($NA == 2) {
                $skor = 2;
            } else if ($NA > 0 && $NA <= 2) {
                $skor = 1;
            } else {
                $skor = 0;
            }
        } else {
            // S1
            if ($NA >= 25) {
                $skor = 4;
            } elseif ($NA >= 20 && $NA <= 24) {
                $skor = 3;
            } elseif ($NA >= 15 && $NA <= 19) {
                $skor = 2;
            } elseif ($NA >= 10 && $NA <= 14) {
                $skor = 1;
            } else {
                $skor = 0;
            }
        }

        return ($skor);
    }

    public function s4_11sub($I, $II)
    {
        return (($I + $II) / 2);
    }
}
