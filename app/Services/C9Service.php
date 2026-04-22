<?php

namespace App\Services;

class C9Service
{

    public function c94a2(array $lulusan, array $ipk, $strata)
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
        } else if ($strata == "S2") {
            $b1 = 3.00;
            $b2 = 3.50;
        } else if ($strata == "S3") {
            $b1 = 3.00;
            $b2 = 3.50;
        } else {
            // S1 dsb
            $b1 = 2.00;
            $b2 = 3.25;
        }

        if (($lts2 + $lts1 + $lts) > 0) {
            $RIPK = (($lts2 * $ipk2) + ($lts1 * $ipk1) + ($lts * $ipk)) / ($lts2 + $lts1 + $lts);
        } else {
            $RIPK = 0;
        }

        if ($RIPK >= $b2) {
            $skor = 4;
        } else if ($RIPK >= $b1) {
            $skor = (2 / ($b2 - $b1) * ($RIPK - $b1)) + 2;
        } else {
            $skor = 0;
        }
        return $skor;
    }

    public function c94a3($NI, $NN, $NW, $NM, $strata)
    {
        if ($strata == "D4") {
            $a = 0.10;
            $b = 1.00;
            $c = 2.00;
        } else if ($strata == "S2") {
            $a = 0.50;
            $b = 2.00;
            $c = 4.00;
        } else if ($strata == "S3") {
            $a = 1.00;
            $b = 2.00;
            $c = 4.00;
        } else {
            // S1 dsb
            $a = 0.10;
            $b = 1.00;
            $c = 2.00;
        }
        if ($NM != 0) {
            $RI = $NI / $NM * 100;
            $RN = $NN / $NM * 100;
            $RW = $NW / $NM * 100;

            if ($RI > $a) {
                $skor = 4;
            } else if ($RI < $a && $RN >= $b) {
                $skor = 3 + ($RI / $a);
            } else if (($RI > 0 && $RI < $a && $RN == 0) || ($RN > 0 && $RN < $b && $RI == 0) || ($RI > 0 && $RI < $a && $RN > 0 && $RN < $b)) {
                $skor = 2 + (2 * $RI / $a) + ($RN / $b) - ($RI * $RN) / ($a * $b);
            } else if ($RI == 0 && $RN == 0 && $RW >= $c) {
                $skor = 2;
            } else {
                $skor = 2 * $RW / $c;
            }
        } else {
            $skor = 0;
        }

        return $skor;
    }

    public function c94a4($NI, $NN, $NW, $NM, $strata)
    {

        if ($strata == "D4") {
            $a = 0.20;
            $b = 2.00;
            $c = 4.00;
        } else if ($strata == "S2") {
            $a = 0.00;
            $b = 0.00;
            $c = 0.00;
        } else if ($strata == "S3") {
            $a = 0.00;
            $b = 0.00;
            $c = 0.00;
        } else {
            // S1 dsb
            $a = 0.20;
            $b = 2.00;
            $c = 4.00;
        }

        if ($NM != 0) {

            $RI = $NI / $NM * 100;
            $RN = $NN / $NM * 100;
            $RW = $NW / $NM * 100;

            if ($RI > $a) {
                $skor = 4;
            } else if ($RI < $a && $RN >= $b) {
                $skor = 3 + ($RI / $a);
            } else if (($RI > 0 && $RI < $a && $RN == 0) || ($RN > 0 && $RN < $b && $RI == 0) || ($RI > 0 && $RI < $a && $RN > 0 && $RN < $b)) {
                $skor = 2 + (2 * $RI / $a) + ($RN / $b) - ($RI * $RN) / ($a * $b);
            } else if ($RI == 0 && $RN == 0 && $RW >= $c) {
                $skor = 2;
            } else {
                $skor = 2 * $RW / $c;
            }
        } else {
            $skor = 0;
        }

        return $skor;
    }

    public function c94a5(array $lulusan, $strata)
    {
        if ($strata == "S2") {
            $b1 = 1.0;
            $b2 = 1.5;
            $b3 = 2.5;
            $b4 = 4.0;
        } else if ($strata == "S3") {
            $b1 = 2.0;
            $b2 = 2.5;
            $b3 = 3.5;
            $b4 = 7.0;
        } else {
            $b1 = 3.0;
            $b2 = 3.5;
            $b3 = 4.5;
            $b4 = 7.0;
        }

        $lts4 = @$lulusan['ts4'] ?? 0;
        $lts3 = @$lulusan['ts3'] ?? 0;
        $lts2 = $lulusan['ts2'];
        $lts1 = $lulusan['ts1'];
        $lts = $lulusan['ts'];

        if (($lts4 + $lts3 + $lts2 + $lts1 + $lts) > 0) {
            if ($strata == "S2") {
                $MS = ((2 * $lts2) + (3 * $lts1) + (4 * $lts)) / ($lts2 + $lts1 + $lts);
            } else if ($strata == "S3") {
                $MS = ((3 * $lts4) + (4 * $lts3) + (5 * $lts2) + (6 * $lts1) + (7 * $lts)) / ($lts4 + $lts3 + $lts2 + $lts1 + $lts);
            } else {
                $MS = ((4 * $lts3) + (5 * $lts2) + (6 * $lts1) + (7 * $lts)) / ($lts3 + $lts2 + $lts1 + $lts);
            }
        } else {
            $MS = 0;
        }

        if ($MS > $b4) {
            $skor = 0;
        } else if ($MS > $b3) {
            $skor = -4 / ($b4 - $b3) * ($MS - $b3) + 4;
        } else if ($MS > $b2) {
            $skor = 4;
        } else if ($MS > $b1) {
            $skor = 4 / ($b2 - $b1) * ($MS - $b1);
        } else {
            $skor = 0;
        }

        return $skor;
    }

    public function c94a6(array $diterima, array $lulusan, $strata)
    {
        $dts6 = @$diterima['ts6'] ?? 0;
        $dts5 = @$diterima['ts5'] ?? 0;
        $dts4 = @$diterima['ts4'] ?? 0;
        $dts3 = @$diterima['ts3'] ?? 0;
        $dts2 = @$diterima['ts2'] ?? 0;
        $dts1 = @$diterima['ts1'] ?? 0;

        $lts4 = @$lulusan['ts4'] ?? 0;
        $lts3 = @$lulusan['ts3'] ?? 0;
        $lts2 = $lulusan['ts2'];
        $lts1 = $lulusan['ts1'];
        $lts = $lulusan['ts'];

        $b = 0.5;

        if (($dts6 + $dts5 + $dts4 + $dts3 + $dts2 + $dts1) > 0) {
            if ($strata == "S2") {
                $PTW = ($lts2 + $lts1 + $lts) / ($dts1 + $dts2 + $dts3);
            } else if ($strata == "S3") {
                $PTW = ($lts4 + $lts3 + $lts2 + $lts1 + $lts) / ($dts6 + $dts5 + $dts4 + $dts3 + $dts2);
            } else {
                $PTW = ($lts3 + $lts2 + $lts1 + $lts) / ($dts6 + $dts5 + $dts4 + $dts3);
            }
        } else {
            $PTW = 0;
        }


        if ($PTW >= $b) {
            $skor = 4;
        } else {
            $skor = 1 + (3 / $b * $PTW);
        }

        return $skor;
    }

    public function c94a7(array $lulusan, $dt, $strata)
    {
        $b1 = 0.30;
        $b2 = 0.85;

        $lts4 = @$lulusan['ts4'] ?? 0;
        $lts3 = @$lulusan['ts3'] ?? 0;
        $lts2 = $lulusan['ts2'];
        $lts1 = $lulusan['ts1'];
        $lts = $lulusan['ts'];

        if ($dt > 0) {
            if ($strata == "S2") {
                $PPS = ($lts2 + $lts1 + $lts) / $dt;
            } else if ($strata == "S3") {
                $PPS = ($lts4  + $lts3 + $lts2 + $lts1 + $lts) / $dt;
            } else {
                $PPS = ($lts3 + $lts2 + $lts1 + $lts) / $dt;
            }
        } else {
            $PPS = 0;
        }

        if ($PPS >= $b2) {
            $skor = 4;
        } else if ($PPS >= $b1) {
            $skor = 4 / ($b2 - $b1) * ($PPS - $b1);
        } else {
            $skor = 0;
        }
        return $skor;
    }

    public function c94a9(array $lulusan, array $lulusanterlacak, array $tahunlulus)
    {

        $NL4 = $lulusan['ts4'];
        $NL3 = $lulusan['ts3'];
        $NL2 = $lulusan['ts2'];

        $NJ4 = $lulusanterlacak['ts4'];
        $NJ3 = $lulusanterlacak['ts3'];
        $NJ2 = $lulusanterlacak['ts2'];

        // Kategori jumlah lulusan dalam 3 tahun (1: NL ³ 300; 2: NL < 300)
        if (($NL4 + $NL3 + $NL2) >= 300) {
            $kl3tahun = 1;
        } else {
            $kl3tahun = 2;
        }

        // Persentase responden lulusan
        if (($NL4 + $NL3 + $NL2) > 0) {
            $Prl = ($NJ4 + $NJ3 + $NJ2) / ($NL4 + $NL3 + $NL2);
        } else {
            $Prl = 0;
        }

        // Prmin = Persentase responden minimum
        if ($kl3tahun == 1) {
            $Prmin = 0.3;
        } else {
            $Prmin = 0.5 - (($NL4 + $NL3 + $NL2) / 300 * 0.2);
        }

        // "Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2. Tabel 8.d.1) LKPS"

        $TLts4wt3 = $tahunlulus['tlts4wt3'];
        $TLts4wt36 = $tahunlulus['tlts4wt36'];
        $TLts4wt6 = $tahunlulus['tlts4wt6'];

        $TLts3wt3 = $tahunlulus['tlts3wt3'];
        $TLts3wt36 = $tahunlulus['tlts3wt36'];
        $TLts3wt6 = $tahunlulus['tlts3wt6'];

        $TLts2wt3 = $tahunlulus['tlts2wt3'];
        $TLts2wt36 = $tahunlulus['tlts2wt36'];
        $TLts2wt6 = $tahunlulus['tlts2wt6'];

        $b1 = 3;
        $b2 = 6;
        $b3 = 12;

        $mid1 = 1.5;
        $mid2 = 4.5;
        $mid3 = 9.0;

        if (($TLts4wt3 + $TLts4wt36 + $TLts4wt6) +
            ($TLts3wt3 + $TLts3wt36 + $TLts3wt6) +
            ($TLts2wt3 + $TLts2wt36 + $TLts2wt6) > 0
        ) {

            $WT = (($TLts4wt3 + $TLts3wt3 + $TLts2wt3) * $mid1 +
                ($TLts4wt36 + $TLts3wt36 + $TLts2wt36) * $mid2 +
                ($TLts4wt6 + $TLts3wt6 + $TLts2wt6) * $mid3) / (
                ($TLts4wt3 + $TLts4wt36 + $TLts4wt6) +
                ($TLts3wt3 + $TLts3wt36 + $TLts3wt6) +
                ($TLts2wt3 + $TLts2wt36 + $TLts2wt6));
        } else {
            $WT = 0;
        }

        if ($WT >= $b2) {
            $skorawal = 0;
        } else if ($WT > $b1) {
            $skorawal = (-4 / ($b2 - $b1) * ($WT - $b1)) + 4;
        } else {
            $skorawal = 4;
        }

        if ($Prl >= $Prmin) {
            $skor = $skorawal;
        } else {
            $skor = $Prl / $Prmin * $skorawal;
        }

        return $skor;
    }

    public function c94a10(array $lulusan, array $lulusanterlacak, array $kesesuaianlulusan)
    {

        $NL4 = $lulusan['ts4'];
        $NL3 = $lulusan['ts3'];
        $NL2 = $lulusan['ts2'];

        $NJ4 = $lulusanterlacak['ts4'];
        $NJ3 = $lulusanterlacak['ts3'];
        $NJ2 = $lulusanterlacak['ts2'];

        // Kategori jumlah lulusan dalam 3 tahun (1: NL ³ 300; 2: NL < 300)
        if (($NL4 + $NL3 + $NL2) >= 300) {
            $kl3tahun = 1;
        } else {
            $kl3tahun = 2;
        }

        // Persentase responden lulusan
        if (($NL4 + $NL3 + $NL2) > 0) {
            $Prl = ($NJ4 + $NJ3 + $NJ2) / ($NL4 + $NL3 + $NL2);
        } else {
            $Prl = 0;
        }

        // Prmin = Persentase responden minimum
        if ($kl3tahun == 1) {
            $Prmin = 0.3;
        } else {
            $Prmin = 0.5 - (($NL4 + $NL3 + $NL2) / 300 * 0.2);
        }

        // "Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2. Tabel 8.d.1) LKPS"

        $TLts4wt3 = $kesesuaianlulusan['tlts4wt3'];
        $TLts4wt36 = $kesesuaianlulusan['tlts4wt36'];
        $TLts4wt6 = $kesesuaianlulusan['tlts4wt6'];

        $TLts3wt3 = $kesesuaianlulusan['tlts3wt3'];
        $TLts3wt36 = $kesesuaianlulusan['tlts3wt36'];
        $TLts3wt6 = $kesesuaianlulusan['tlts3wt6'];

        $TLts2wt3 = $kesesuaianlulusan['tlts2wt3'];
        $TLts2wt36 = $kesesuaianlulusan['tlts2wt36'];
        $TLts2wt6 = $kesesuaianlulusan['tlts2wt6'];

        $b = 0.6;
        $b1 = 0.3;
        $b2 = 0.7;
        $b3 = 1;

        if (($TLts4wt3 + $TLts4wt36 + $TLts4wt6) +
            ($TLts3wt3 + $TLts3wt36 + $TLts3wt6) +
            ($TLts2wt3 + $TLts2wt36 + $TLts2wt6) > 0
        ) {

            $PBS = (($TLts4wt3 + $TLts3wt3 + $TLts2wt3) * $b1 +
                ($TLts4wt36 + $TLts3wt36 + $TLts2wt36) * $b2 +
                ($TLts4wt6 + $TLts3wt6 + $TLts2wt6) * $b3) / (
                ($TLts4wt3 + $TLts4wt36 + $TLts4wt6) +
                ($TLts3wt3 + $TLts3wt36 + $TLts3wt6) +
                ($TLts2wt3 + $TLts2wt36 + $TLts2wt6));
        } else {
            $PBS = 0;
        }

        if ($PBS >= 0.8) {
            $skorawal = 4;
        } else {
            $skorawal = 5 * $PBS;
        }

        if ($Prl >= $Prmin) {
            $skor = $skorawal;
        } else {
            $skor = $Prl / $Prmin * $skorawal;
        }

        return $skor;
    }

    public function c94a11(array $lulusan, array $lulusanterlacak, array $lulusantingkat)
    {

        $NL4 = $lulusan['ts4'];
        $NL3 = $lulusan['ts3'];
        $NL2 = $lulusan['ts2'];

        $NJ4 = $lulusanterlacak['ts4'];
        $NJ3 = $lulusanterlacak['ts3'];
        $NJ2 = $lulusanterlacak['ts2'];

        // Kategori jumlah lulusan dalam 3 tahun (1: NL ³ 300; 2: NL < 300)
        if (($NL4 + $NL3 + $NL2) >= 300) {
            $kl3tahun = 1;
        } else {
            $kl3tahun = 2;
        }

        // Persentase responden lulusan
        if (($NL4 + $NL3 + $NL2) > 0) {
            $Prl = ($NJ4 + $NJ3 + $NJ2) / ($NL4 + $NL3 + $NL2);
        } else {
            $Prl = 0;
        }

        // Prmin = Persentase responden minimum
        if ($kl3tahun == 1) {
            $Prmin = 0.3;
        } else {
            $Prmin = 0.5 - (($NL4 + $NL3 + $NL2) / 300 * 0.2);
        }

        // "Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2. Tabel 8.d.1) LKPS"

        $NIts4 = $lulusantingkat['NIts4'];
        $NNts4 = $lulusantingkat['NNts4'];
        $NWts4 = $lulusantingkat['NWts4'];

        $NIts3 = $lulusantingkat['NIts3'];
        $NNts3 = $lulusantingkat['NNts3'];
        $NWts3 = $lulusantingkat['NWts3'];

        $NIts2 = $lulusantingkat['NIts2'];
        $NNts2 = $lulusantingkat['NNts2'];
        $NWts2 = $lulusantingkat['NWts2'];



        $a = 0.05;
        $b = 0.2;
        $c = 0.9;

        if (($NIts4 + $NNts4 + $NWts4) +
            ($NIts3 + $NNts3 + $NWts3) +
            ($NIts2 + $NNts2 + $NWts2) > 0
        ) {

            $RI = ($NIts4 + $NIts3 + $NIts2) /
                (($NIts4 + $NNts4 + $NWts4) +
                    ($NIts3 + $NNts3 + $NWts3) +
                    ($NIts2 + $NNts2 + $NWts2));
        } else {
            $RI = 0;
        }

        if (($NIts4 + $NNts4 + $NWts4) +
            ($NIts3 + $NNts3 + $NWts3) +
            ($NIts2 + $NNts2 + $NWts2) > 0
        ) {

            $RN = ($NNts4 + $NNts3 + $NNts2) /
                (($NIts4 + $NNts4 + $NWts4) +
                    ($NIts3 + $NNts3 + $NWts3) +
                    ($NIts2 + $NNts2 + $NWts2));
        } else {
            $RN = 0;
        }

        if (($NIts4 + $NNts4 + $NWts4) +
            ($NIts3 + $NNts3 + $NWts3) +
            ($NIts2 + $NNts2 + $NWts2) > 0
        ) {

            $RW = ($NWts4 + $NWts3 + $NWts2) /
                (($NIts4 + $NNts4 + $NWts4) +
                    ($NIts3 + $NNts3 + $NWts3) +
                    ($NIts2 + $NNts2 + $NWts2));
        } else {
            $RW = 0;
        }
        if ($RI > $a) {
            $skor = 4;
        } else if ($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } else if (($RI > 0 && $RI < $a && $RN == 0) || ($RN > 0 && $RN < $b && $RI == 0) || ($RI > 0 && $RI < $a && $RN > 0 && $RN < $b)) {
            $skor = 2 + (2 * $RI / $a) + ($RN / $b) - ($RI * $RN) / ($a * $b);
        } else if ($RI = 0 && $RN = 0 && $RW >= $c) {
            $skor = 2;
        } else {
            $skor = 2 * $RW / $c;
        }

        return $skor;
    }

    public function c94a12(array $lulusan, array $lulusanterlacak, array $penggunalulusan)
    {

        $NL4 = $lulusan['ts4'];
        $NL3 = $lulusan['ts3'];
        $NL2 = $lulusan['ts2'];

        $NJ4 = $lulusanterlacak['ts4'];
        $NJ3 = $lulusanterlacak['ts3'];
        $NJ2 = $lulusanterlacak['ts2'];

        // Kategori jumlah lulusan dalam 3 tahun (1: NL ³ 300; 2: NL < 300)
        if (($NL4 + $NL3 + $NL2) >= 300) {
            $kl3tahun = 1;
        } else {
            $kl3tahun = 2;
        }

        // Persentase responden lulusan
        if (($NL4 + $NL3 + $NL2) > 0) {
            $Prl = ($NJ4 + $NJ3 + $NJ2) / ($NL4 + $NL3 + $NL2);
        } else {
            $Prl = 0;
        }

        // Prmin = Persentase responden minimum
        if ($kl3tahun == 1) {
            $Prmin = 0.3;
        } else {
            $Prmin = 0.5 - (($NL4 + $NL3 + $NL2) / 300 * 0.2);
        }


        // "Tingkat kepuasan pengguna lulusan. Tabel 8.e.2) LKPS"
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
        $skorawal = ($tk1 + $tk2 + $tk3 + $tk4 + $tk5 + $tk6 + $tk7) / 7;



        if ($Prl >= $Prmin) {
            $skor = $skorawal;
        } else {
            $skor = $Prl / $Prmin * $skorawal;
        }

        return $skor;
    }

    public function c94b1(array $data, $NM, $strata)
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

        if ($strata == "D4") {
            $a = 0.01;
            $b = 0.1;
            $c = 0.5;
        } else if ($strata == "S2") {
            $a = 0.02;
            $b = 0.2;
            $c = 0.7;
        } else if ($strata == "S3") {
            $a = 0.03;
            $b = 0.3;
            $c = 0.9;
        } else {
            // S1 dsb
            $a = 0.01;
            $b = 0.1;
            $c = 0.5;
        }

        $RI = ($NA4 + $NB3 + $NC3) / $NM;
        $RN = ($NA2 + $NA3 + $NB2 + $NC2) /  $NM;
        $RW = ($NA1 + $NB1 + $NC1) / $NM;

        if ($RI > $a) {
            $skor = 4;
        } else if ($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } else if (($RI > 0 && $RI < $a && $RN == 0) || ($RN > 0 && $RN < $b && $RI == 0) || ($RI > 0 && $RI < $a && $RN > 0 && $RN < $b)) {
            $skor = 2 + (2 * $RI / $a) + ($RN / $b) - ($RI * $RN) / ($a * $b);
        } else if ($RI == 0 && $RN == 0 && $RW >= $c) {
            $skor = 2;
        } else {
            $skor = 2 * $RW / $c;
        }


        return $skor;
    }

    public function c94b2($NA, $NB, $NC, $ND)
    {
        $b = 0.1;

        $NLP = (2 * ($NA + $NB + $NC)) + $ND;
        if ($NLP >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $NLP);
        }

        return $skor;
    }
    public function c94b3v($NAPJ)
    {
        $b = 2;

        if ($NAPJ >= $b) {
            $skor = 4;
        } else if ($NAPJ > 0 && $NAPJ < $b) {
            $skor = 3;
        } else {
            $skor = 2;
        }


        return $skor;
    }

    public function c94b3($NAS, $strata)
    {
        if ($strata == "S2" || $strata == "PROFESI") {
            $b = 2;
        } else if ($strata == "S3") {
            $b = 3;
        } else {
            $b = 0;
        }

        if ($NAS >= $b) {
            $skor = 4;
        } else if ($NAS > 0 && $NAS < $b) {
            $skor = 3;
        } else {
            $skor = 2;
        }


        return $skor;
    }

    public function c94b1d($NAS)
    {
        $b = 3;

        if ($NAS >= $b) {
            $skor = 4;
        } else if ($NAS > 0 && $NAS < $b) {
            $skor = 3;
        } else {
            $skor = 2;
        }


        return $skor;
    }
}
