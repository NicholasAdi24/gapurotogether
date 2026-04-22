<?php

namespace App\Services\LamTeknik\V2;

class Service10
{
    public function s10_1subkomI($NI, $NN, $NW, $NM)
    {
        $a = 0.002;
        $b = 0.02;
        $c = 0.04;

        $RI = $NI / $NM;
        $RN = $NN / $NM;
        $RW = $NW / $NM;

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

    public function s10_1subkomII($NI, $NN, $NW, $NM)
    {
        $a = 0.002;
        $b = 0.02;
        $c = 0.04;

        $RI = $NI / $NM;
        $RN = $NN / $NM;
        $RW = $NW / $NM;

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

    //S1 D4
    public function s10_1sub($I, $II)
    {
        return (($I * 3) + $II) / 4;
    }

    // S2 S3 
    public function s10_1m($NI, $NN, $NW, $NM)
    {
        $a = 0.002;
        $b = 0.02;
        $c = 0.04;

        $RI = $NI / $NM;
        $RN = $NN / $NM;
        $RW = $NW / $NM;

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

    // D4
    public function s10_2v($NAPJ)
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

    // S1 D4
    public function s10_3(array $lulusan)
    {
        $b1 = 3.0;
        $b2 = 3.5;
        $b3 = 4.5;
        $b4 = 8.0;

        // TS 7
        $lts7a = $lulusan['ts7a'];
        $lts7b = $lulusan['ts7b'];
        $lts7c = $lulusan['ts7c'];
        $lts7d = $lulusan['ts7d'];

        $lts7 = $lts7a + $lts7b + $lts7c + $lts7d;

        if ($lts7 <= 0) {
            $rms7 = 0;
        } else {
            $rms7 = (
                (4 * $lts7a) +
                (5 * $lts7b) +
                (6 * $lts7c) +
                (7 * $lts7d)
            ) / $lts7;
        }

        // TS 6
        $lts6a = $lulusan['ts6a'];
        $lts6b = $lulusan['ts6b'];
        $lts6c = $lulusan['ts6c'];
        $lts6d = $lulusan['ts6d'];

        $lts6 = $lts6a + $lts6b + $lts6c + $lts6d;

        if ($lts6 <= 0) {
            $rms6 = 0;
        } else {
            $rms6 = (
                (4 * $lts6a) +
                (5 * $lts6b) +
                (6 * $lts6c) +
                (7 * $lts6d)
            ) / $lts6;
        }

        $MS = ($rms7 + $rms6) / 2;

        if (($MS > $b3) && ($MS <= $b4)) {
            $skor = (55 - (6 * $MS)) / 7;
        } elseif (($MS > $b2) && ($MS <= $b3)) {
            $skor = 4;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // S2
    public function s10_3m(array $lulusan)
    {
        $b1 = 0.0;
        $b2 = 1.5;
        $b3 = 2.5;
        $b4 = 4.0;

        // TS 3
        $lts3a = $lulusan['ts3a'];
        $lts3b = $lulusan['ts3b'];
        $lts3c = $lulusan['ts3c'];

        $lts3 = $lts3a + $lts3b + $lts3c;

        if ($lts3 <= 0) {
            $MS = 0;
        } else {
            $MS = (
                (2 * $lts3a) +
                (3 * $lts3b) +
                (4 * $lts3c)
            ) / $lts3;
        }

        if (($MS > $b3) && ($MS <= $b4)) {
            $skor = 9 - (2 * $MS);
        } elseif (($MS > $b2) && ($MS <= $b3)) {
            $skor = 4;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // S3
    public function s10_3d(array $lulusan)
    {
        $b1 = 0.0;
        $b2 = 2.5;
        $b3 = 3.5;
        $b4 = 6.0;

        // TS 5
        $lts5a = $lulusan['ts5a'];
        $lts5b = $lulusan['ts5b'];
        $lts5c = $lulusan['ts5c'];

        $lts5 = $lts5a + $lts5b + $lts5c;

        if ($lts5 <= 0) {
            $rms5 = 0;
        } else {
            $rms5 = (
                (3 * $lts5a) +
                (4 * $lts5b) +
                (5 * $lts5c)
            ) / $lts5;
        }

        // TS 4
        $lts4a = $lulusan['ts4a'];
        $lts4b = $lulusan['ts4b'];
        $lts4c = $lulusan['ts4c'];

        $lts4 = $lts4a + $lts4b + $lts4c;

        if ($lts4 <= 0) {
            $rms4 = 0;
        } else {
            $rms4 = (
                (3 * $lts4a) +
                (4 * $lts4b) +
                (5 * $lts4c)
            ) / $lts4;
        }

        $MS = ($rms5 + $rms4) / 2;

        if (($MS > $b3) && ($MS <= $b4)) {
            $skor = (199 / 25) - (29 / 25 * $MS);
        } elseif (($MS > $b2) && ($MS <= $b3)) {
            $skor = 4;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // S1 D4
    public function s10_4($diterima, $lulusan, $strata)
    {
        $PTW =  $lulusan / $diterima;

        if ($strata == "D4") {
            $a = 0;
            $b = 0.8;
        } else {
            $a = 0;
            $b = 0.5;
        }

        if ($strata == "D4") {
            if (($PTW > $a) && ($PTW < $b)) {
                $skor = 1 + (30 * $PTW / 8);
            } elseif ($PTW >= $b) {
                $skor = 4;
            } else {
                $skor = 0;
            }
        } else {
            if (($PTW > $a) && ($PTW < $b)) {
                $skor = 1 + (6 * $PTW);
            } elseif ($PTW >= $b) {
                $skor = 4;
            } else {
                $skor = 0;
            }
        }

        return $skor;
    }

    // S2
    public function s10_4m($diterima, $lulusan, $strata)
    {
        $PTW =  $lulusan / $diterima;

        $a = 0.2;
        $b = 0.6;

        if (($PTW >= $a) && ($PTW < $b)) {
            $skor = 1 + ((30 * $PTW) - 6) / 4;
        } elseif ($PTW >= $b) {
            $skor = 4;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // S3
    public function s10_4d($diterima, $lulusan, $strata)
    {
        $PTW =  $lulusan / $diterima;

        $a = 0.1;
        $b = 0.6;

        if (($PTW >= $a) && ($PTW < $b)) {
            $skor = 1 + ((30 * $PTW) - 3) / 5;
        } elseif ($PTW >= $b) {
            $skor = 4;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // S1 S2 S3 
    public function s10_5(array $data, $NM, $strata)
    {

        $NA1 = $data['NA1'];
        $NA2 = $data['NA2'];
        $NA3 = $data['NA3'];
        $NA4 = $data['NA4'];
        $NB1 = $data['NB1'];
        $NB2 = $data['NB2'];
        $NB3 = $data['NB3'];

        if ($strata == "S1") {
            $a = 0.01;
            $b = 0.1;
            $c = 0.5;
        } else if ($strata == "S2") {
            $a = 0.1;
            $b = 0.3;
            $c = 0.9;
        } else if ($strata == "S3") {
            $a = 0.25;
            $b = 0.3;
            $c = 0.9;
        }

        $RI = ($NA4 + $NB3) / $NM;
        $RN = ($NA2 + $NA3 + $NB2) /  $NM;
        $RW = ($NA1 + $NB1) / $NM;

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

    // D4
    public function s10_5v(array $data, $NM)
    {
        $NA1 = $data['NA1'];
        $NA2 = $data['NA2'];
        $NA3 = $data['NA3'];
        $NA4 = $data['NA4'];
        $NB1 = $data['NB1'];
        $NB2 = $data['NB2'];
        $NB3 = $data['NB3'];

        $a = 0.01;
        $b = 0.1;
        $c = 0.5;

        $RI = ($NA4 + $NB3) / $NM;
        $RN = ($NA2 + $NA3 + $NB2) /  $NM;
        $RW = ($NA1 + $NB1) / $NM;

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

    // D4 S1
    public function s10_6($NPaten, $NHKI, $NTTG, $NBC)
    {
        $NLP = ((3 * $NPaten) + 2 * ($NTTG + $NBC) + $NHKI);
        $b = 10;

        if ($NLP >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (0.2 * $NLP);
        }
        // dd($NLP, $skor);
        return $skor;
    }

    // S2 S3
    public function s10_6m($NPaten, $NHKI, $NTTG, $NBC, $NM, $strata)
    {
        $NLP = ((3 * $NPaten) + 2 * ($NTTG + $NBC) + $NHKI) / $NM;

        if ($strata == "S2") {
            $b = 2;
        } else if ($strata == "S3") {
            $b = 3;
        }

        if ($NLP >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 * $NLP / 3);
        }

        return $skor;
    }

    // D4 S1 S2
    public function s10_8(array $lulusan, array $lulusanterlacak, array $tahunlulus)
    {
        $NL2 = $lulusan['ts2'];
        $NL1 = $lulusan['ts1'];

        $NJ2 = $lulusanterlacak['ts2'];
        $NJ1 = $lulusanterlacak['ts1'];

        $JumR = $NL2 + $NL1 > 0;
        $PJ = ($JumR > 0) ? ($NJ2 + $NJ1) / $JumR : 0;

        $TL2WT1 = $tahunlulus['tl2wt1'];
        $TL2WT2 = $tahunlulus['tl2wt2'];
        $TL2WT3 = $tahunlulus['tl2wt3'];

        $TL1WT1 = $tahunlulus['tl1wt1'];
        $TL1WT2 = $tahunlulus['tl1wt2'];
        $TL1WT3 = $tahunlulus['tl1wt3'];

        $b = 0.6;
        $b1 = 0.3;
        $b2 = 0.5;
        $b3 = 1;

        $JumTL = $TL2WT1 + $TL2WT2 + $TL2WT3 + $TL1WT1 + $TL1WT2 + $TL1WT3;

        if ($JumTL > 0) {
            $KBK = (($TL2WT1 + $TL1WT1) * $b1 + ($TL2WT2 + $TL1WT2) * $b2 + ($TL2WT3 + $TL1WT3) * $b3) / $JumTL;
        } else {
            $KBK = 0;
        }

        if ($PJ < 0.3) {
            $skor = 0;
        } else if ($KBK >= $b) {
            $skor = 4;
        } else if ($KBK < $b) {
            $skor = (20 * $KBK) / 3;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // S1 D4
    public function s10_9(array $lulusan, array $lulusanterlacak, array $tahunlulus)
    {
        $NL2 = $lulusan['ts2'];
        $NL1 = $lulusan['ts1'];

        $NJ2 = $lulusanterlacak['ts2'];
        $NJ1 = $lulusanterlacak['ts1'];

        $JumR = $NL2 + $NL1 > 0;
        $PJ = ($JumR > 0) ? ($NJ2 + $NJ1) / $JumR : 0;

        $TL2WT1 = $tahunlulus['tl2wt1'];
        $TL2WT2 = $tahunlulus['tl2wt2'];
        $TL2WT3 = $tahunlulus['tl2wt3'];

        $TL1WT1 = $tahunlulus['tl1wt1'];
        $TL1WT2 = $tahunlulus['tl1wt2'];
        $TL1WT3 = $tahunlulus['tl1wt3'];

        $b1 = 3;
        $b2 = 6;
        $b3 = 12;

        $mid1 = (0 + $b1) / 2;
        $mid2 = ($b1 + $b2) / 2;
        $mid3 = ($b2 + $b3) / 2;

        $JumTL = $TL2WT1 + $TL2WT2 + $TL2WT3 + $TL1WT1 + $TL1WT2 + $TL1WT3;

        if ($JumTL > 0) {
            $WT = (($TL2WT1 + $TL1WT1) * $mid1 + ($TL2WT2 + $TL1WT2) * $mid2 + ($TL2WT3 + $TL1WT3) * $mid3) / $JumTL;
        } else {
            $WT = 0;
        }

        if ($PJ < 0.3) {
            $skor = 0;
        } else if ($WT >= 0 && $WT <= 3) {
            $skor = 4;
        } else if ($WT > 3 && $WT <= 18) {
            $skor = (23 - $WT) / 5;
        } else {
            $skor = 0;
        }

        return $skor;
    }

    // D4 S1
    public function s10_10(array $lulusan, array $lulusanterlacak, array $tahunlulus)
    {
        $NL2 = $lulusan['ts2'];
        $NL1 = $lulusan['ts1'];

        $NJ2 = $lulusanterlacak['ts2'];
        $NJ1 = $lulusanterlacak['ts1'];

        $JumR = $NL2 + $NL1;
        $PJ = ($JumR > 0) ? ($NJ2 + $NJ1) / $JumR : 0;

        $TL2NI = $tahunlulus['tl2ni'];
        $TL2NN = $tahunlulus['tl2nn'];
        $TL2NW = $tahunlulus['tl2nw'];

        $TL1NI = $tahunlulus['tl1ni'];
        $TL1NN = $tahunlulus['tl1nn'];
        $TL1NW = $tahunlulus['tl1nw'];

        $RI = ($JumR > 0) ? ($TL2NI + $TL1NI) / $JumR : 0;
        $RN = ($JumR > 0) ? ($TL2NN + $TL1NN) / $JumR : 0;
        $RW = ($JumR > 0) ? ($TL2NW + $TL1NW) / $JumR : 0;

        $a = 0.05;
        $b = 0.2;
        $c = 0.9;

        $RIb = ($RI >= $a && $RN < $b) ? $a : $RI;
        $RNb = ($RI < $a && $RN >= $b) ? $b : $RN;
        $RWb = ($RW >= $c) ? $c : $RW;

        $A = $RIb / $a;
        $B = $RNb / $b;
        $C = $RWb / $c;

        $s1 = $RIb > $a && $RNb > $b;
        $s2 = ($RIb > 0 && $RIb <= $a) || ($RNb > 0 && $RNb <= $b) || ($RWb > 0 && $RWb <= $c);

        if ($PJ < 0.3) {
            $hasil = 0;
        } else if ($s1) {
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

    // D4 S1 S2
    public function s10_11(array $lulusan, array $lulusanterlacak, array $penggunalulusan)
    {
        $NL2 = $lulusan['ts2'];
        $NL1 = $lulusan['ts1'];

        $NJ2 = $lulusanterlacak['ts2'];
        $NJ1 = $lulusanterlacak['ts1'];

        $JumR = $NL2 + $NL1 > 0;
        $PJ = ($JumR > 0) ? ($NJ2 + $NJ1) / $JumR : 0;

        $etikasb = $penggunalulusan['etika_sangatbaik'] / 100;
        $etikab = $penggunalulusan['etika_baik'] / 100;
        $etikac = $penggunalulusan['etika_cukup'] / 100;
        $etikak = $penggunalulusan['etika_kurang'] / 100;

        if ((4 * $etikasb + 3 * $etikab + 2 * $etikac + $etikak) > 4) {
            $tk1 = 0;
        } else {
            $tk1 = (4 * $etikasb + 3 * $etikab + 2 * $etikac + $etikak);
        }

        $keahliansb = $penggunalulusan['keahlian_sangatbaik'] / 100;
        $keahlianb = $penggunalulusan['keahlian_baik'] / 100;
        $keahlianc = $penggunalulusan['keahlian_cukup'] / 100;
        $keahliank = $penggunalulusan['keahlian_kurang'] / 100;

        if ((4 * $keahliansb + 3 * $keahlianb + 2 * $keahlianc + $keahliank) > 4) {
            $tk2 = 0;
        } else {
            $tk2 = (4 * $keahliansb + 3 * $keahlianb + 2 * $keahlianc + $keahliank);
        }

        $bahasasb = $penggunalulusan['bahasa_sangatbaik'] / 100;
        $bahasab = $penggunalulusan['bahasa_baik'] / 100;
        $bahasac = $penggunalulusan['bahasa_cukup'] / 100;
        $bahasak = $penggunalulusan['bahasa_kurang'] / 100;

        if ((4 * $bahasasb + 3 * $bahasab + 2 * $bahasac + $bahasak) > 4) {
            $tk3 = 0;
        } else {
            $tk3 = (4 * $bahasasb + 3 * $bahasab + 2 * $bahasac + $bahasak);
        }

        $tekinfosb = $penggunalulusan['teknologiinformasi_sangatbaik'] / 100;
        $tekinfob = $penggunalulusan['teknologiinformasi_baik'] / 100;
        $tekinfoc = $penggunalulusan['teknologiinformasi_cukup'] / 100;
        $tekinfok = $penggunalulusan['teknologiinformasi_kurang'] / 100;

        if ((4 * $tekinfosb + 3 * $tekinfob + 2 * $tekinfoc + $tekinfok) > 4) {
            $tk4 = 0;
        } else {
            $tk4 = (4 * $tekinfosb + 3 * $tekinfob + 2 * $tekinfoc + $tekinfok);
        }

        $komunikasisb = $penggunalulusan['komunikasi_sangatbaik'] / 100;
        $komunikasib = $penggunalulusan['komunikasi_baik'] / 100;
        $komunikasic = $penggunalulusan['komunikasi_cukup'] / 100;
        $komunikasik = $penggunalulusan['komunikasi_kurang'] / 100;

        if ((4 * $komunikasisb + 3 * $komunikasib + 2 * $komunikasic + $komunikasik) > 4) {
            $tk5 = 0;
        } else {
            $tk5 = (4 * $komunikasisb + 3 * $komunikasib + 2 * $komunikasic + $komunikasik);
        }

        $kerjasamasb = $penggunalulusan['kerjasama_sangatbaik'] / 100;
        $kerjasamab = $penggunalulusan['kerjasama_baik'] / 100;
        $kerjasamac = $penggunalulusan['kerjasama_cukup'] / 100;
        $kerjasamak = $penggunalulusan['kerjasama_kurang'] / 100;

        if ((4 * $kerjasamasb + 3 * $kerjasamab + 2 * $kerjasamac + $kerjasamak) > 4) {
            $tk6 = 0;
        } else {
            $tk6 = (4 * $kerjasamasb + 3 * $kerjasamab + 2 * $kerjasamac + $kerjasamak);
        }

        $pengdirisb = $penggunalulusan['pengembangandiri_sangatbaik'] / 100;
        $pengdirib = $penggunalulusan['pengembangandiri_baik'] / 100;
        $pengdiric = $penggunalulusan['pengembangandiri_cukup'] / 100;
        $pengdirik = $penggunalulusan['pengembangandiri_kurang'] / 100;

        if ((4 * $pengdirisb + 3 * $pengdirib + 2 * $pengdiric + $pengdirik) > 4) {
            $tk7 = 0;
        } else {
            $tk7 = (4 * $pengdirisb + 3 * $pengdirib + 2 * $pengdiric + $pengdirik);
        }

        if ($PJ < 0.3) {
            $skor = 0;
        } else {
            $skor = ($tk1 + $tk2 + $tk3 + $tk4 + $tk5 + $tk6 + $tk7) / 7;
        }

        return $skor;
    }
}
