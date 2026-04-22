<?php

namespace App\Services;

class C3Service
{
    public function c34asub1($NA, $NB)
    {
        if($NB > 0) {
            $rasio = $NA / $NB;
        } else {
            $rasio = 0;
        }

        $b = 5;
        if($rasio >= $b) {
            $skor = 4;
        } else {
            $skor = 4 / $b * $rasio;
        }
        return $skor;
    }


    public function c34a($pilihan, $rasio, $judge)
    {
        /**
         * Pilihan
         * 1 : Tinggi
         * 2 : Rendah
         */
        if($pilihan == 1) {
            $skor = $rasio;
        } else if($pilihan == 2){
            $skor = $judge;
        } else {
            $skor = 0;
        }
        return $skor;
    }

    public function c34av($NA, $NB, $a)
    {
        if($NB > 0) {
            $rasio = $NA / $NB;
        } else {
            $rasio = 0;
        }
        $b = 5;
        if($rasio >= $b) {
            $skor = 4;
        } else {
            $skor = 4 / $b * $rasio;
        }

        $skorfinal = ($a + $skor) / 2;
        return $skorfinal;
    }

    public function c34bsubb($NMUPPS, $NMAFT, $NMAPT, $strata)
    {

        if($strata == "D4") {
            $b = 0.01;
        } else if($strata == "S2") {
            $b = 0.02;
        } else if($strata == "S3") {
            $b = 0.05;
        }else {
            // S1 dsb
            $b = 0.01;
        }
        if($NMUPPS > 0) {
            $PMA = ($NMAFT + $NMAPT) / $NMUPPS;
        } else {
            $PMA = 0;
        }

        if($PMA >= $b) {
            $skor = 4;
        } else {
            $skor = 2 + (2 / $b * $PMA);
        }
        return $skor;
    }

    public function c34b($a, $b)
    {
        return ((2 * $a) + $b) / 3;
    }

    public function c34c($a, $b)
    {
        return ($a + (2 * $b)) / 3;
    }

    public function c34d($a, $b, $c)
    {
        return ($a + (2 * $b) + (2 * $c)) / 5;
    }

    public function c34e($a, $b)
    {
        return ($a + (2 * $b)) / 3;
    }
}
