<?php

namespace App\Services;

class C4Service
{
    public function c44a1($NDTPS, $strata)
    {
        if($strata == "D4") {
            $b1 = 3; $b2 = 12;
        } else if($strata == "S2") {
            $b1 = 3; $b2 = 6;
        } else if($strata == "S3") {
            $b1 = 3; $b2 = 6;
        }else {
            // S1 dsb
            $b1 = 3; $b2 = 6;
        }
        if($NDTPS >= $b2) {
            $skor = 4;
        } else if($NDTPS >= $b1) {
            $skor = (2 / ($b2 - $b1) * ($NDTPS - $b1)) + 2;
        } else {
            $skor = 0;
        }
        return $skor;
    }

    public function c44a2($NDS3, $NDTPS)
    {
        $b = 0.5;
        if($NDTPS > 0 ) {
            $PDS3 = ($NDS3 / $NDTPS);
        } else {
            $PDS3 = 0;
        }

        if($PDS3 >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $PDS3);
        }
        return $skor;
    }

    public function c44a3($NDGB, $NDLK, $NDL, $NDTPS, $strata)
    {
        $b = 0.7;
        if($NDTPS > 0 ) {
            $PGBLKL = (($NDGB + $NDLK + $NDL) / $NDTPS) * 1;
            if($strata == "D4") {
                $PGBLKL = (($NDGB + $NDLK + $NDL) / $NDTPS) * 1;
            } else if($strata == "S2") {
                $PGBLKL = (($NDGB + $NDLK) / $NDTPS) * 1;
            } else if($strata == "S3") {
                $PGBLKL = (($NDGB) / $NDTPS) * 1;
            }else {
                // S1 dsb
                $PGBLKL = (($NDGB + $NDLK + $NDL) / $NDTPS) * 1;
            }
        } else {
            $PGBLKL = 0;
        }

        if($PGBLKL >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $PGBLKL);
        }

        return $skor;
    }

    /**
     * Kelompok
     * 1 : Saintek
     * 2 : Soshum
     * $pilihan : Pilihan lulusan dari C.3.4.a tinggi / rendah
     * $rendah : C.3.4.a ketika lulusannya rendah
     * Pilihan
     * 1 : Tinggi
     * 2 : Rendah
     */
    public function c44a4($kelompok, $NM, $NDTPS, $pilihan, $rendah )
    {

        // Saintek
        $b1saintek = 15;
        $b2saintek = 25;
        $b3saintek = 35;

        // Soshum
        $b1soshum = 25;
        $b2soshum = 35;
        $b3soshum = 50;

        if($NDTPS > 0 ) {
            $RMD = $NM / $NDTPS;
        } else {
            $RMD = 0;
        }

        // Tinggi
        if($pilihan == 1) {
            // Saintek
            if($kelompok == 1) {
                if($RMD > $b3saintek) {
                    $skorsaintek = 0;
                } else if($RMD > $b2saintek) {
                    $skorsaintek = (-4 / ($b3saintek - $b2saintek) * ($RMD - $b2saintek)) + 4;
                } else if($RMD >= $b1saintek) {
                    $skorsaintek = 4;
                } else {
                    $skorsaintek = 4 / $b1saintek * $RMD;
                }
                $skor = $skorsaintek;
            // Soshum
            } else if($kelompok == 2){
                if($RMD > $b3soshum) {
                    $skorsoshum = 0;
                } else if($RMD > $b2soshum) {
                    $skorsoshum = (-4 / ($b3soshum - $b2soshum) * ($RMD - $b2soshum)) + 4;
                } else if($RMD >= $b1soshum) {
                    $skorsoshum = 4;
                } else {
                    $skorsoshum = 4 / $b1soshum * $RMD;
                }
                $skor = $skorsoshum;
            }
        } else {
            $skor = $rendah;
        }
        return $skor;
    }

    public function c44a4v($kelompok, $NM, $NDTPS)
    {
        // Saintek
        $b1saintek = 15;
        $b2saintek = 25;
        $b3saintek = 35;

        // Soshum
        $b1soshum = 25;
        $b2soshum = 35;
        $b3soshum = 50;

        if($NDTPS > 0 ) {
            $RMD = $NM / $NDTPS;
        } else {
            $RMD = 0;
        }

        if($kelompok == 1) {
            if($RMD > $b3saintek) {
                $skorsaintek = 0;
            } else if($RMD > $b2saintek) {
                $skorsaintek = (-4 / ($b3saintek - $b2saintek) * ($RMD - $b2saintek)) + 4;
            } else if($RMD >= $b1saintek) {
                $skorsaintek = 4;
            } else {
                $skorsaintek = 4 / $b1saintek * $RMD;
            }
            $skor = $skorsaintek;
        // Soshum
        } else if($kelompok == 2){
            if($RMD > $b3soshum) {
                $skorsoshum = 0;
            } else if($RMD > $b2soshum) {
                $skorsoshum = (-4 / ($b3soshum - $b2soshum) * ($RMD - $b2soshum)) + 4;
            } else if($RMD >= $b1soshum) {
                $skorsoshum = 4;
            } else {
                $skorsoshum = 4 / $b1soshum * $RMD;
            }
            $skor = $skorsoshum;
        }
        return $skor;
    }

    public function c44a5($RDPUPS, $RDPUL)
    {
        $b1 = 6;
        $b2 = 10;

        $RDPU = ($RDPUPS + $RDPUL) / 2;

        if($RDPU > $b2) {
            $skor = 0;
        } else if($RDPU > $b1) {
            $skor = -2 / ($b2 - $b1) * ($RDPU - $b1) + 4;
        } else {
            $skor = 4;
        }

        return $skor;
    }

    public function c44a6($EWMPDT, $EWMPDTPS)
    {
        $b1 = 6;
        $b2 = 12;
        $b3 = 16;
        $b4 = 18;

        $EWMP = $EWMPDTPS;

        if($EWMP > $b4) {
            $skor = 0;
        } else if($EWMP >= $b3) {
            $skor = -4 / ($b4 - $b3) * ($EWMP - $b3) + 4;
        } else if($EWMP >= $b2){
            $skor = 4;
        } else if($EWMP >= $b1){
            $skor = 4 / ($b2 - $b1) * ($EWMP - $b1);
        } else {
            $skor = 0;
        }

        return $skor;
    }

    public function c44a6v($NDTPS, $NDSK)
    {
        $b = 0.5;
        if($NDTPS > 0 ) {
            $PDSK = $NDSK / $NDTPS / 100;
        } else {
            $PDSK = 0;
        }

        if($PDSK >= $b) {
            $skor = 4;
        } else {
            $skor = 1 + (3 / $b * $PDSK);
        }

        return $skor;
    }



    public function c44a7($NDTT, $NDT)
    {
        $b1 = 0.1;
        $b2 = 0.4;

        $PDTT = ($NDTT / ($NDTT + $NDT)) * 1;

        if($PDTT > $b2) {
            $skor = 0;
        } else if($PDTT > $b1) {
            $skor = -4 / ($b2 - $b1) * ($PDTT - $b1) + 4;
        } else {
            $skor = 4;
        }

        return $skor;
    }

    public function c44a7v($MKKI, $MKK)
    {
        $b = 0.2;
        if($MKK > 0 ) {
            $PMKI = $MKKI / $MKK / 100;
        } else {
            $PMKI = 0;
        }

        if($PMKI >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $PMKI);
        }
        return $skor;
    }

    public function c44b1($NRD, $NDTPS, $strata)
    {
        if($strata == "D4") {
            $b = 0;
        } else if($strata == "S2") {
            $b = 0;
        } else if($strata == "S3") {
            $b = 2.0;
        }else {
            // S1 dsb
            $b = 0.5;
        }

        if($NDTPS > 0 ) {
            $RRD = $NRD / $NDTPS;
        } else {
            $RRD = 0;
        }

        if($RRD >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $RRD);
        }

        return $skor;
    }

    public function c44b2($NI, $NN, $NL, $NDTPS, $strata)
    {

        if($strata == "D4") {
            $a = 0.05; $b = 0.3; $c = 1;
        } else if($strata == "S2") {
            $a = 0.07; $b = 0.50; $c = 1.50;
        } else if($strata == "S3") {
            $a = 0.10; $b = 1.00; $c = 2.00;
        }else {
            // S1 dsb
            $a = 0.05; $b = 0.30; $c = 1.00;
        }

        $RI = $NI / 3 /  $NDTPS;
        $RN = $NN / 3 /  $NDTPS;
        $RL = $NL / 3 /  $NDTPS;

        if($RI > $a ) {
            $skor = 4;
        } else if($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } else if(($RI > 0 && $RI < $a && $RN == 0) || ($RN > 0 && $RN < $b && $RI == 0) || ($RI > 0 && $RI < $a && $RN > 0 && $RN < $b)) {
            $skor = 2 + (2 * $RI / $a) + ($RN / $b) - ($RI * $RN) / ($a * $b);
        } else if($RI == 0 && $RN == 0 && $RL >= $c) {
            $skor = 2;
        } else {
            $skor = 2 * $RL / $c;
        }

        return $skor;
    }

    public function c44b3($NI, $NN, $NL, $NDTPS, $strata)
    {
        if($strata == "D4") {
            $a = 0.05; $b = 0.3; $c = 1;
        } else if($strata == "S2") {
            $a = 0.07; $b = 0.50; $c = 1.50;
        } else if($strata == "S3") {
            $a = 0.10; $b = 1.00; $c = 2.00;
        }else {
            // S1 dsb
            $a = 0.05; $b = 0.30; $c = 1.00;
        }

        $RI = $NI / 3 /  $NDTPS;
        $RN = $NN / 3 /  $NDTPS;
        $RL = $NL / 3 /  $NDTPS;

        if($RI > $a ) {
            $skor = 4;
        } else if($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } else if(($RI > 0 && $RI < $a && $RN == 0) || ($RN > 0 && $RN < $b && $RI == 0) || ($RI > 0 && $RI < $a && $RN > 0 && $RN < $b)) {
            $skor = 2 + (2 * $RI / $a) + ($RN / $b) - ($RI * $RN) / ($a * $b);
        } else if($RI == 0 && $RN == 0 && $RL >= $c) {
            $skor = 2;
        } else {
            $skor = 2 * $RL / $c;
        }

        return $skor;
    }

    public function c44b3v($NRD, $NDTPS)
    {
        $b = 0.5;

        if($NDTPS > 0 ) {
            $RRD = $NRD / $NDTPS;
        } else {
            $RRD = 0;
        }

        if($RRD >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $RRD);
        }

        return $skor;
    }

    public function c44b4(array $data, $NDTPS, $strata)
    {
        $NA1 = $data['NA1'];
        $NA2 = $data['NA2'];
        $NA3 = $data['NA3'];
        $NA4 = $data['NA4'];
        $NB1 = $data['NB1'];
        $NB2 = $data['NB2'];
        $NB3 = $data['NB3'];
        $NC1 = $data['NC1'];
        $NC2 = $data['NC2'];
        $NC3 = $data['NC3'];


        if($strata == "D4") {
            $a = 0.1; $b = 1.0; $c = 2.0;
        } else if($strata == "S2") {
            $a = 0.20; $b = 2.00; $c = 4.00;
        } else if($strata == "S3") {
            $a = 0.20; $b = 2.00; $c = 4.00;
        }else {
            // S1 dsb
            $a = 0.1; $b = 1.0; $c = 2.0;
        }

        $RI = ($NA4 + $NB3 + $NC3) / $NDTPS;
        $RN = ($NA2 + $NA3 + $NB2 + $NC2) /  $NDTPS;
        $RW = ($NA1 + $NB1 + $NC1) / $NDTPS;

        if($RI > $a ) {
            $skor = 4;
        } else if($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } else if(($RI > 0 && $RI < $a && $RN == 0) || ($RN > 0 && $RN < $b && $RI == 0) || ($RI > 0 && $RI < $a && $RN > 0 && $RN < $b)) {
            $skor = 2 + (2 * $RI / $a) + ($RN / $b) - ($RI * $RN) / ($a * $b);
        } else if($RI = 0 && $RN = 0 && $RW >= $c) {
            $skor = 2;
        } else {
            $skor = 2 * $RW / $c;
        }

        return $skor;
    }

    public function c44b5($NAS, $NDTPS, $strata)
    {

        if($strata == "D4") {
            $b = 0.5;
        } else if($strata == "S2") {
            $b = 1.0;
        } else if($strata == "S3") {
            $b = 1.0;
        }else {
            // S1 dsb
            $b = 0.5;
        }

        if($NDTPS > 0 ) {
            $RS = $NAS / $NDTPS;
        } else {
            $RS = 0;
        }

        if($RS >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $RS);
        }

        return $skor;
    }

    public function c44b6($NA, $NB, $NC, $ND, $NDTPS, $strata)
    {
        if($strata == "D4") {
            $b = 1.0;
        } else if($strata == "S2") {
            $b = 2.0;
        } else if($strata == "S3") {
            $b = 2.0;
        }else {
            // S1 dsb
            $b = 1.0;
        }

        if($NDTPS > 0 ) {
            $RLP = (2 * ($NA + $NB + $NC) + $ND) / $NDTPS;
        } else {
            $RLP = 0;
        }

        if($RLP >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $RLP);
        }

        return $skor;
    }

    public function c44b7v($NDTPS, $NAPJ)
    {
        $b = 1;
        if($NDTPS > 0 ) {
            $RS = $NAPJ / $NDTPS;
        } else {
            $RS = 0;
        }

        if($RS >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $RS);
        }
        return $skor;
    }

    public function c44b6m($NDTPS, $NAS)
    {
        $b = 1;
        if($NDTPS > 0 ) {
            $RS = $NAS / $NDTPS;
        } else {
            $RS = 0;
        }

        if($RS > $b ) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $RS);
        }
        return $skor;
    }

    // Not Fixed
    public function c44ckomp(array $data, $c44c)
    {
        $c44a1 = $data['c44a1'];
        $c44a2 = $data['c44a2'];
        $c44a3 = $data['c44a3'];
        $c44a4 = $data['c44a4'];
        $c44a5 = $data['c44a5'];
        $c44a6 = $data['c44a6'];
        $c44a7 = $data['c44a7'];

        $rata2butir = ($c44a1 + $c44a2 + $c44a3 + $c44a4 + $c44a5 + $c44a6 + $c44a7) / 7;

        if($rata2butir >= 3.5) {
            $skor = 4;
        } else {
            $skor = $c44c;
        }
        return $skor;
    }

    public function c44d($a, $b)
    {
        return ($a + (2 * $b)) / 3;
    }
}
