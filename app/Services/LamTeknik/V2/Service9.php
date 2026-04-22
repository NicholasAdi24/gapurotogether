<?php

namespace App\Services\LamTeknik\V2;

class Service9
{
    public function s9_1($NMUPPS, $NMAFT, $NMAPT)
    {
        $PMA = ($NMAFT + $NMAPT) / $NMUPPS;
        $a = 0.01;

        if ($PMA >= $a) {
            $skor = 4;
        } elseif ($PMA >= 0 && $PMA < $a) {
            $skor = 2 + (200 * $PMA);
        } else {
            $skor = 0;
        }

        return $skor;
    }

    public function s9_2(array $lulusan, array $ipk, $strata)
    {
        $lts2 = $lulusan['ts2'];
        $lts1 = $lulusan['ts1'];
        $lts = $lulusan['ts'];

        $ipk2 = $ipk['ts2'];
        $ipk1 = $ipk['ts1'];
        $ipk = $ipk['ts'];

        if ($strata == "D4") {
            $b1 = 2.00;
            $b2 = 3.25;
        } else if ($strata == "S1") {
            $b1 = 2.00;
            $b2 = 3.25;
        } else if ($strata == "S2") {
            $b1 = 3.00;
            $b2 = 3.50;
        } else {
            // S3
            $b1 = 3.00;
            $b2 = 3.50;
        }

        if (($lts2 + $lts1 + $lts) > 0) {
            $RIPK = (($lts2 * $ipk2) + ($lts1 * $ipk1) + ($lts * $ipk)) / ($lts2 + $lts1 + $lts);
        } else {
            $RIPK = 0;
        }

        if ($RIPK >= $b2) {
            $skor = 4;
        } else if ($RIPK >= $b1) {
            if ($strata == "D4" || $strata == "S1") {
                $skor = ((8 * $RIPK) - 6) / 5;
            } else {
                $skor = (4 * $RIPK) - 10;
            }
        } else {
            $skor = 0;
        }

        return $skor;
    }
}
