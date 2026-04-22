<?php

namespace App\Services\LamTeknik\V1;

class C6Service
{
    public function c64a($a, $b, $c)
    {
        return ($a + (2 * $b) + (2 * $c)) / 5;
    }

    public function c64c($a, $b)
    {
        return ($a + (2 * $b)) / 3;
    }

    public function c64d1($a, $b, $c, $d, $e)
    {
        return ($a + (2 * $b) + (2 * $c) + (2 * $d) + (2 * $e)) / 9;
    }

    public function c64d2($JP, $JB, $strata)
    {
        if ($strata == "D4") {
            $b1 = 0.2;
            $b2 = 0.3;
        } else {
            // S1
            $b1 = 0.2; // ditambah menjadi 2 variabel menyesuaikan excel
            $b2 = 0.5; // ditambah menjadi 2 variabel menyesuaikan excel
        }

        if ($JB > 0) {
            $PJP = ($JP / $JB) * 1;
        } else {
            $PJP = 0;
        }

        // if ($PJP >= $b) {
        //     $skor = 4;
        // } else {
        //     $skor = 4 / $b * $PJP;
        // }
        //
        if ($PJP >= 0 && $PJP < $b1) {
            $skor = 15 * $PJP;
        } else if ($PJP <= $b2) {
            $skor = 4;
        } else {
            $skor = 3 - (6 * ($PJP - $b2));
        }

        if ($skor < 0) $skor = 0;
    }

    public function c64f($a, $b, $c)
    {
        return ($a + (2 * $b) + (2 * $c)) / 5;
    }

    // S3
    public function c64fd($a, $b, $c, $d, $e)
    {
        return ($a + $b + $c + $d + (2 * $e)) / 6;
    }

    // rev: butuh NA nukan MK
    public function c64g($NA)
    {
        if ($NA >= 25) {
            $skor = 4;
        } else if ($NA >= 20) {
            $skor = 3;
        } else if ($NA >= 15) {
            $skor = 2;
        } else if ($NA >= 10) {
            $skor = 1;
        } else {
            $skor = 0;
        }
        return $skor;
    }

    // S1 D4
    public function c64j($NMKI)
    {
        if ($NMKI > 3) {
            $skor = 4;
        } else if ($NMKI >= 2) {
            $skor = 3;
        } else if ($NMKI = 1) {
            $skor = 2;
        } else {
            $skor = 1;
        }

        return $skor;
    }

    //  S2 S3
    // $NMK di seed mungkin $MK
    public function c64jm($NMKI, $NMK)
    {
        $b1 = 0.25;
        $b2 = 0.50;
        if ($NMK > 0) {
            $PMKI = $NMKI / $NMK;
        } else {
            $PMKI = 0;
        }

        if ($PMKI >= $b2) {
            $skor = 4;
        } else if ($PMKI > $b1) {
            $skor = 8 * $b1;
        } elseif ($PMKI > 0) {
            $skor = 2;
        } else {
            $skor = 0;
        }
        return $skor;
    }

    public function c64ltkm(array $kepuasan)
    {
        $reliabilitysb = $kepuasan['reliability_sangatbaik'] / 100;
        $reliabilityb = $kepuasan['reliability_baik'] / 100;
        $reliabilityc = $kepuasan['reliability_cukup'] / 100;
        $reliabilityk = $kepuasan['reliability_kurang'] / 100;

        if ((4 * $reliabilitysb + 3 * $reliabilityb + 2 * $reliabilityc + $reliabilityk) / 4 > 100) {
            $tk1 = 0;
        } else {
            $tk1 = (4 * $reliabilitysb + 3 * $reliabilityb + 2 * $reliabilityc + $reliabilityk) / 4;
        }

        $responsivenesssb = $kepuasan['responsiveness_sangatbaik'] / 100;
        $responsivenessb = $kepuasan['responsiveness_baik'] / 100;
        $responsivenessc = $kepuasan['responsiveness_cukup'] / 100;
        $responsivenessk = $kepuasan['responsiveness_kurang'] / 100;

        if ((4 * $responsivenesssb + 3 * $responsivenessb + 2 * $responsivenessc + $responsivenessk) / 4 > 100) {
            $tk2 = 0;
        } else {
            $tk2 = (4 * $responsivenesssb + 3 * $responsivenessb + 2 * $responsivenessc + $responsivenessk) / 4;
        }

        $assurancesb = $kepuasan['assurance_sangatbaik'] / 100;
        $assuranceb = $kepuasan['assurance_baik'] / 100;
        $assurancec = $kepuasan['assurance_cukup'] / 100;
        $assurancek = $kepuasan['assurance_kurang'] / 100;

        if ((4 * $assurancesb + 3 * $assuranceb + 2 * $assurancec + $assurancek) / 4 > 100) {
            $tk3 = 0;
        } else {
            $tk3 = (4 * $assurancesb + 3 * $assuranceb + 2 * $assurancec + $assurancek) / 4;
        }

        $empathysb = $kepuasan['empathy_sangatbaik'] / 100;
        $empathyb = $kepuasan['empathy_baik'] / 100;
        $empathyc = $kepuasan['empathy_cukup'] / 100;
        $empathyk = $kepuasan['empathy_kurang'] / 100;

        if ((4 * $empathysb + 3 * $empathyb + 2 * $empathyc + $empathyk) / 4 > 100) {
            $tk4 = 0;
        } else {
            $tk4 = (4 * $empathysb + 3 * $empathyb + 2 * $empathyc + $empathyk) / 4;
        }


        $tangiblesb = $kepuasan['tangible_sangatbaik'] / 100;
        $tangibleb = $kepuasan['tangible_baik'] / 100;
        $tangiblec = $kepuasan['tangible_cukup'] / 100;
        $tangiblek = $kepuasan['tangible_kurang'] / 100;

        if ((4 * $tangiblesb + 3 * $tangibleb + 2 * $tangiblec + $tangiblek) / 4 > 100) {
            $tk5 = 0;
        } else {
            $tk5 = (4 * $tangiblesb + 3 * $tangibleb + 2 * $tangiblec + $tangiblek) / 4;
        }
        $skorawal = ($tk1 + $tk2 + $tk3 + $tk4 + $tk5) / 5;

        $b1 = 0.25;
        $b2 = 0.75;
        if ($skorawal >= $b2) {
            $skor = 4;
        } else if ($skorawal >= $b1) {
            $skor = 4 / ($b2 - $b1) * ($skorawal - $b1);
        } else {
            $skor = 0;
        }
        return $skor;
    }

    public function c64l($a, $b)
    {
        return ($a + (2 * $b)) / 3;
    }
}
