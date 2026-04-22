<?php

namespace App\Services\LamTeknik\V2;

class Service7
{
    // S1 S2 S3
    public function s7_3($NDTPS, $NDT, $NDTT, $strata)
    {
        $PDTT = $NDTT / ($NDT + $NDTT);

        if ($strata == "S2") {
            $s1 = ($NDTPS >= 8 && $PDTT <= 0.1) ? "YES" : "NO";
            $s2 = ($NDTPS >= 5 && $NDTPS < 8 && $PDTT <= 0.4) ? "YES" : "NO";
            $s3 = ($NDTPS >= 8 && $PDTT > 0.1 && $PDTT <= 0.4) ? "YES" : "NO";
        } else {
            // D4 S1
            $s1 = ($NDTPS >= 12 && $PDTT <= 0.1) ? "YES" : "NO";
            $s2 = ($NDTPS >= 5 && $NDTPS < 12 && $PDTT <= 0.4) ? "YES" : "NO";
            $s3 = ($NDTPS >= 12 && $PDTT > 0.1 && $PDTT <= 0.4) ? "YES" : "NO";
        }
        $s4 = ($NDTPS >= 5 && $PDTT > 0.4) ? "YES" : "NO";
        $s5 = ($NDTPS < 5) ? "YES" : "NO";

        if ($strata == "D4" || $strata == "S1") {
            $A = ($NDTPS - 5) / 7;
        } else {
            // S2 S3
            $A = ($NDTPS - 5) / 3;
        }

        if ($s2 == "YES") {
            $B = (0.4 - $PDTT) / 0.4;
        } elseif ($s3 == "YES") {
            $B = (0.4 - $PDTT) / 0.3;
        } else {
            $B = 0;
        }

        if ($s1 == "YES") {
            $skor = 4;
        } elseif ($s2 == "YES") {
            $skor = 2 + (2 * $A * $B);
        } elseif ($s3 == "YES") {
            $skor = 2 + (2 * $B);
        } elseif ($s4 == "YES") {
            if ($strata == "S1") {
                $skor = 1;
            } else {
                // D4 S2
                $skor = 2;
            }
        } elseif ($s5 == "YES") {
            $skor = 0;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // S3
    public function s7_3d($NDGB, $NDTPS)
    {
        $PGB = ($NDGB / $NDTPS);

        $A = ($NDTPS - 3) / 5;
        $B = ($PGB - 0.4) / 0.1;

        $s1 = ($NDTPS >= 8 && $PGB >= 0.5) ? "YES" : "NO";
        $s2 = ($NDTPS > 5 && $NDTPS < 8 && $PGB >= 0.4 && $PGB < 0.5) ? "YES" : "NO";
        $s3 = ($NDTPS > 8 && $PGB > 0.4 && $PGB < 0.5) ? "YES" : "NO";
        $s4 = ($NDGB < 2) ? "YES" : "NO";

        if ($s1 === "YES") {
            $skor = 4;
        } elseif ($s2 === "YES") {
            $skor = 2 + (2 * $A * $B);
        } elseif ($s3 === "YES") {
            $skor = 2 + (2 * $B);
        } elseif ($s4 === "YES") {
            $skor = 0;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // D4 S1
    public function s7_2($NDS3, $NDTPS, $strata)
    {
        if ($strata == "D4") {
            $b = 0.2;
        } else {
            // S1 
            $b = 0.5;
        }

        if ($NDTPS > 0) {
            $PDS3 = ($NDS3 / $NDTPS);
        } else {
            $PDS3 = 0;
        }

        if ($PDS3 >= $b) {
            $skor = 4;
        } else {
            if ($strata == "D4") {
                $skor = 2 + (10 * $PDS3);
            } else {
                // S1 
                $skor = 2 + (4 * $PDS3);
            }
        }

        return $skor;
    }

    // D4 S1
    public function s7_1($NDGB, $NDLK, $NDL, $NDTPS, $strata)
    {
        if ($strata == "D4") {
            $b = 0.5;
        } else {
            // S1 
            $b = 0.7;
        }

        if ($NDTPS > 0) {
            $PGBLK = (($NDGB + $NDLK + $NDL) / $NDTPS);
        } else {
            $PGBLK = 0;
        }

        if ($PGBLK >= $b) {
            $skor = 4;
        } else {
            if ($strata == "D4") {
                $skor = 2 + (4 * $PGBLK);
            } else {
                // S1 
                $skor = 2 + ((20 * $PGBLK) / 7);
            }
        }

        return $skor;
    }

    // S2 S3
    public function s7_1m($NDGB, $NDLK, $NDTPS, $strata)
    {
        $b = 0.7;
        //not fix
        $NDL = 0;
        $PGB = ($NDGB / $NDTPS);

        if ($NDTPS > 0) {
            $PGBLK = (($NDGB + $NDLK) / $NDTPS);
        } else {
            $PGBLK = 0;
        }

        if ($strata == "S2") {
            if ($PGBLK >= $b) {
                $skor = 4;
            } else {
                $skor = 2 + ((20 * $PGBLK) / 7);
            }
        } else {
            // S3
            if (($PGB >= 0.5 && $NDTPS >= 8)) {
                $skor = 4;
            } elseif ($PGBLK < $b) {
                $skor = 2 + ((20 * $PGBLK) / 7);
            } else {
                $skor = 0;
            }
        }

        return $skor;
    }

    // D4
    public function s7_4v($NDTPS, $NDSK)
    {
        $b = 0.5;
        if ($NDTPS > 0) {
            $PDSK = $NDSK / $NDTPS;
        } else {
            $PDSK = 0;
        }

        if ($PDSK >= $b) {
            $skor = 4;
        } else {
            $skor = 1 + (6 * $PDSK);
        }

        return $skor;
    }

    // D4
    public function s7_5v($MKKI, $MKK)
    {
        $b = 0.2;
        if ($MKK > 0) {
            $PMKI = $MKKI / $MKK;
        } else {
            $PMKI = 0;
        }

        if ($PMKI >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (10 * $PMKI);
        }

        return $skor;
    }

    public function s7_7($RBK)
    {
        if ($RBK >= 12 && $RBK <= 16) {
            return 4;
        } elseif ($RBK > 16 && $RBK <= 20) {
            return (64 - (3 * $RBK)) / 4;
        } else {
            return 0;
        }
    }

    public function s7_8($NI, $NN, $NL, $NDTPS, $strata)
    {
        if ($strata == "D4") {
            $a = 0.05;
            $b = 0.3;
            $c = 1;
        } else if ($strata == "S1") {
            $a = 0.05;
            $b = 0.30;
            $c = 1.00;
        } else if ($strata == "S2") {
            $a = 0.07;
            $b = 0.50;
            $c = 1.50;
        } else {
            // S3
            $a = 0.10;
            $b = 1.00;
            $c = 2.00;
        }

        $RI = $NI / 3 /  $NDTPS;
        $RN = $NN / 3 /  $NDTPS;
        $RL = $NL / 3 /  $NDTPS;

        if ($RI >= $a && $RN < $b) {
            $RIb = $a;
        } else {
            $RIb = $RI;
        }

        if ($RI < $a && $RN >= $b) {
            $RNb = $b;
        } else {
            $RNb = $RN;
        }

        if ($RL >= $c) {
            $RLb = $c;
        } else {
            $RLb = $RL;
        }

        $A = $RIb / $a;
        $B = $RNb / $b;
        $C = $RLb / $c;

        $s1 = $RIb > $a && $RNb >= $b;
        $s2 = ($RIb > 0 && $RIb <= $a) || ($RNb > 0 && $RNb <= $b) || ($RLb > 0 && $RLb <= $c);

        if ($s1) {
            $skor = 4;
        } else if ($s2) {
            $skor = 3.75 * (($A + $B + ($C / 2))
                - ($A * $B)
                - ($A * $C / 2)
                - ($B * $C / 2)
                + ($A * $B * $C / 2));
        } else {
            $skor = 0;
        }

        return $skor;
    }

    public function s7_9($NI, $NN, $NL, $NDTPS, $strata)
    {
        if ($strata == "D4") {
            $a = 0.05;
            $b = 0.30;
            $c = 1.00;
        } else if ($strata == "S1") {
            // S1 dsb
            $a = 0.05;
            $b = 0.30;
            $c = 1.00;
        } else if ($strata == "S2") {
            $a = 0.07;
            $b = 0.50;
            $c = 1.50;
        } else {
            // S3
            $a = 0.10;
            $b = 1.00;
            $c = 2.00;
        }

        $RI = $NI / 3 /  $NDTPS;
        $RN = $NN / 3 /  $NDTPS;
        $RL = $NL / 3 /  $NDTPS;

        if ($RI >= $a && $RN < $b) {
            $RIb = $a;
        } else {
            $RIb = $RI;
        }

        if ($RI < $a && $RN >= $b) {
            $RNb = $b;
        } else {
            $RNb = $RN;
        }

        if ($RL >= $c) {
            $RLb = $c;
        } else {
            $RLb = $RL;
        }

        $A = $RIb / $a;
        $B = $RNb / $b;
        $C = $RLb / $c;

        $s1 = $RIb > $a && $RNb >= $b;
        $s2 = ($RIb > 0 && $RIb <= $a) || ($RNb > 0 && $RNb <= $b) || ($RLb > 0 && $RLb <= $c);

        if ($s1) {
            $skor = 4;
        } else if ($s2) {
            $skor = 3.75 * (($A + $B + ($C / 2))
                - ($A * $B)
                - ($A * $C / 2)
                - ($B * $C / 2)
                + ($A * $B * $C / 2));
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // D4
    public function s7_10v(array $data, $NDTPS)
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

        $a = 0.5;
        $b = 0.5;
        $c = 1.0;

        $RI = ($NA4 + $NB3 + $NC3) / $NDTPS;
        $RN = ($NA2 + $NA3 + $NB2 + $NC2) /  $NDTPS;
        $RW = ($NA1 + $NB1 + $NC1) / $NDTPS;

        if ($RI >= $a && $RN < $b) {
            $RIb = $a;
        } else {
            $RIb = $RI;
        }

        if ($RI < $a && $RN >= $b) {
            $RNb = $b;
        } else {
            $RNb = $RN;
        }

        if ($RW >= $c) {
            $RWb = $c;
        } else {
            $RWb = $RW;
        }

        $A = $RIb / $a;
        $B = $RNb / $b;
        $C = $RWb / $c;

        $s1 = $RIb > $a && $RNb >= $b;
        $s2 = ($RIb > 0 && $RIb <= $a) || ($RNb > 0 && $RNb <= $b) || ($RWb > 0 && $RWb <= $c);

        if ($s1) {
            $skor = 4;
        } else if ($s2) {
            $skor = 3.75 * (($A + $B + ($C / 2))
                - ($A * $B)
                - ($A * $C / 2)
                - ($B * $C / 2)
                + ($A * $B * $C / 2));
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // S1 S2 S3
    public function s7_10(array $data, $NDTPS, $strata)
    {
        $NA1 = $data['NA1'];
        $NA2 = $data['NA2'];
        $NA3 = $data['NA3'];
        $NA4 = $data['NA4'];
        $NB1 = $data['NB1'];
        $NB2 = $data['NB2'];
        $NB3 = $data['NB3'];

        if ($strata == "S1") {
            $a = 0.5;
            $b = 1.0;
            $c = 2.0;
        } else if ($strata == "S2") {
            $a = 0.50;
            $b = 4.00;
            $c = 4.00;
        } else if ($strata == "S3") {
            $a = 0.50;
            $b = 6.00;
            $c = 4.00;
        }

        $RI = ($NA4 + $NB3) / $NDTPS;
        $RN = ($NA2 + $NA3 + $NB2) /  $NDTPS;
        $RW = ($NA1 + $NB1) / $NDTPS;

        if ($RI >= $a && $RN < $b) {
            $RIb = $a;
        } else {
            $RIb = $RI;
        }

        if ($RI < $a && $RN >= $b) {
            $RNb = $b;
        } else {
            $RNb = $RN;
        }

        if ($RW >= $c) {
            $RWb = $c;
        } else {
            $RWb = $RW;
        }

        $A = $RIb / $a;
        $B = $RNb / $b;
        $C = $RWb / $c;

        $s1 = $RIb > $a && $RNb >= $b;
        $s2 = ($RIb > 0 && $RIb <= $a) || ($RNb > 0 && $RNb <= $b) || ($RWb > 0 && $RWb <= $c);

        if ($s1) {
            $skor = 4;
        } else if ($s2) {
            $skor = 3.75 * (($A + $B + ($C / 2))
                - ($A * $B)
                - ($A * $C / 2)
                - ($B * $C / 2)
                + ($A * $B * $C / 2));
        } else {
            $skor = 0;
        }

        return $skor;
    }

    public function s7_11($NPaten, $NHKI, $NTTG, $NBC, $NDTPS)
    {
        $RLP = ((3 * $NPaten) + 2 * ($NTTG + $NBC) + $NHKI) / $NDTPS;
        $b = 3;

        if ($RLP >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 * $RLP / 3);
        }

        return $skor;
    }

    // D4
    public function s7_12v($NAPJ)
    {
        if ($NAPJ >= 3) {
            $skor = 4;
        } elseif ($NAPJ >= 0 && $NAPJ < 3) {
            $skor = 1 + $NAPJ;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    public function s7_13($NKDTPS, $NDTPS, $strata)
    {
        $PKDTPS = ($NKDTPS / $NDTPS);

        if ($strata == "D4") {
            $b = 0.1;
        } else {
            // S1 S2 S3
            $b = 0.5;
        }

        if ($PKDTPS >= $b) {
            $skor = 4;
        } else {
            if ($strata == "D4") {
                $skor = 1 + (3 * $PKDTPS / 10);
            } else {
                // S1 S2 S3
                $skor = 1 + (6 * $PKDTPS);
            }
        }

        return $skor;
    }

    public function s7_14($KIB,  $NDTPS, $strata)
    {
        $PKIB = ($KIB / $NDTPS);

        if ($strata == "D4") {
            $b = 0.15;
        } else if ($strata == "S1") {
            $b = 0.25;
        } else {
            // S2 S3
            $b = 0.5;
        }

        if ($PKIB >= $b) {
            $skor = 4;
        } else {
            if ($strata == "D4") {
                $skor = 2 + (40 * $PKIB / 3);
            } else if ($strata == "S1") {
                $skor = 2 + (8 * $PKIB);
            } else {
                //S2 S3
                $skor = 2 + (4 * $PKIB);
            }
        }

        return $skor;
    }

    public function s7_15($NRDTPS, $NDTPS, $strata)
    {
        $PRDTPS = $NRDTPS / $NDTPS;

        if ($strata == "D4" || $strata == "S1") {
            $b = 0.5;
        } else if ($strata == "S2") {
            $b = 1.0;
        } else {
            //  S3
            $b = 2.0;
        }

        if ($PRDTPS >= $b) {
            $skor = 4;
        } else {
            if ($strata == "D4" || $strata == "S1") {
                $skor = 2 + (4 * $PRDTPS);
            } else if ($strata == "S2") {
                $skor = 2 + (2 * $PRDTPS);
            } else {
                //  S3
                $skor = (2 + $PRDTPS);
            }
        }

        return $skor;
    }

    public function s7_16($NRDTPS, $NDTPS, $strata)
    {
        $NRDTPSH = $NRDTPS / $NDTPS;

        $b = 2;

        if ($NRDTPSH >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + $NRDTPSH;
        }

        return $skor;
    }
}
